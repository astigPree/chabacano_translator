<?php

include dirname(__DIR__) . '/config/DBConnector.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check for "Up" or "Down" actions (no changes here)
        if (isset($_POST['section_id'], $_POST['direction'])) {
            $section_id = (int) $_POST['section_id'];
            $direction = $_POST['direction'];

            // Fetch the current section
            $stmt = $conn->prepare("SELECT * FROM story_headers_tb WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $section_id]);
            $currentSection = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($currentSection) {
                $currentOrder = (int) $currentSection['section_order'];

                // If moving up
                if ($direction === 'up') {
                    $stmt = $conn->prepare("SELECT * FROM story_headers_tb WHERE section_order < :section_order ORDER BY section_order DESC LIMIT 1");
                    $stmt->execute([':section_order' => $currentOrder]);
                }
                // If moving down
                elseif ($direction === 'down') {
                    $stmt = $conn->prepare("SELECT * FROM story_headers_tb WHERE section_order > :section_order ORDER BY section_order ASC LIMIT 1");
                    $stmt->execute([':section_order' => $currentOrder]);
                }

                $otherSection = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($otherSection) {
                    $otherSectionOrder = (int) $otherSection['section_order'];

                    // Swap the section_order values
                    $updateCurrent = $conn->prepare("UPDATE story_headers_tb SET section_order = :new_order WHERE id = :id");
                    $updateCurrent->execute([':new_order' => $otherSectionOrder, ':id' => $section_id]);

                    $updateOther = $conn->prepare("UPDATE story_headers_tb SET section_order = :new_order WHERE id = :id");
                    $updateOther->execute([':new_order' => $currentOrder, ':id' => $otherSection['id']]);
                }
            }

            // Redirect back to the story page
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Check if it's an update action by checking for header_id
        if (isset($_POST['section_id']) && !empty($_POST['section_id'])) {
            $headerId = (int) $_POST['section_id'];

            // Validate input
            if (empty($_POST['header-title']) || empty($_POST['header-content'])) {
                $_SESSION['message'] = ['type' => 'warning', 'content' => 'Fields are empty!'];
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            // Update the existing header
            $stmt = $conn->prepare("UPDATE story_headers_tb SET heading_title = :title, heading_content = :content WHERE id = :id");
            $stmt->execute([
                ":title" => $_POST['header-title'],
                ":content" => $_POST['header-content'],
                ":id" => $headerId
            ]);

            // Handle subheaders update
            $subheaders = [];

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'subheader-title') !== false || strpos($key, 'subheader-content') !== false) {
                    $index = explode('-', $key)[2];

                    if (!isset($subheaders[$index])) {
                        $subheaders[$index] = ['title' => '', 'content' => ''];
                    }

                    if (strpos($key, 'subheader-title') !== false) {
                        $subheaders[$index]['title'] = $value;
                    } else {
                        $subheaders[$index]['content'] = $value;
                    }
                }
            }

            // Delete old subheaders
            $stmt = $conn->prepare("DELETE FROM story_subheaders_tb WHERE heading_id = :headerId");
            $stmt->execute([':headerId' => $headerId]);

            // Insert updated subheaders
            foreach ($subheaders as $subheader) {
                if (!empty($subheader['title']) && !empty($subheader['content'])) {
                    $stmt = $conn->prepare("INSERT INTO story_subheaders_tb (heading_id, subheading_title, subheading_content) VALUES (:headerId, :title, :content)");
                    $stmt->execute([
                        ':headerId' => $headerId,
                        ':title' => $subheader['title'],
                        ':content' => $subheader['content']
                    ]);
                }
            }

            $_SESSION['message'] = ['type' => 'success', 'content' => 'Header and Subheaders successfully updated!'];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // If no header_id is present, it's a new section (insert logic)
        if (!isset($_POST['section_id']) || empty($_POST['section_id'])) {
            // Regular content addition (if no "up", "down" or "edit" actions)
            if (empty($_POST['header-title']) || empty($_POST['header-content'])) {
                $_SESSION['message'] = ['type' => 'warning', 'content' => 'Fields are empty!'];
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            $latestSectionOrder = (int) $conn->query('SELECT MAX(section_order) FROM story_headers_tb')->fetchColumn();
            $latestSectionOrder += 1;

            // Insert the new header
            $stmt = $conn->prepare("INSERT INTO story_headers_tb (heading_title, heading_content, section_order) VALUES (:title, :content, :section_order)");
            $stmt->execute([
                ":title" => $_POST['header-title'],
                ":content" => $_POST['header-content'],
                ":section_order" => $latestSectionOrder
            ]);

            $headerId = $conn->lastInsertId();

            // Process subheaders
            $subheaders = [];

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'subheader-title') !== false || strpos($key, 'subheader-content') !== false) {
                    $index = explode('-', $key)[2];

                    if (!isset($subheaders[$index])) {
                        $subheaders[$index] = ['title' => '', 'content' => ''];
                    }

                    if (strpos($key, 'subheader-title') !== false) {
                        $subheaders[$index]['title'] = $value;
                    } else {
                        $subheaders[$index]['content'] = $value;
                    }
                }
            }

            foreach ($subheaders as $subheader) {
                if (!empty($subheader['title']) && !empty($subheader['content'])) {
                    $stmt = $conn->prepare("INSERT INTO story_subheaders_tb (heading_id, subheading_title, subheading_content) VALUES (:headerId, :title, :content)");
                    $stmt->execute([
                        ':headerId' => $headerId,
                        ':title' => $subheader['title'],
                        ':content' => $subheader['content']
                    ]);
                }
            }

            $_SESSION['message'] = ['type' => 'success', 'content' => 'Header and Subheader successfully added!'];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } catch (PDOException $e) {
        // Set an error message in session if an exception occurs
        $_SESSION['message'] = ['type' => 'error', 'content' => 'An error occurred while processing: ' . $e->getMessage()];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
