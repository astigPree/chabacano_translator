<?php

include dirname(__DIR__) . '/../config/DBConnector.php';

session_start();

if (!$_SESSION['isLoggedIn']) {
    session_destroy();
    header('Location: ../login.php');
    exit;
}

// Display success/error message if set
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo '<div class="mb-0 alert alert-' . $message['type'] . ' alert-dismissible fade show" role="alert">';
    echo htmlspecialchars($message['content']);
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';

    // Clear the session message after displaying it
    unset($_SESSION['message']);
}

$stmt = $conn->prepare("SELECT * FROM home_page_content_tb WHERE id = 1 LIMIT 1");
$stmt->execute();
$homeContent = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM story_headers_tb ORDER BY section_order ASC");
$stmt->execute();

$sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
$storyPageSections = [];

foreach ($sections as $section) {
    $stmt = $conn->prepare("SELECT * FROM story_subheaders_tb WHERE heading_id = :heading_id");
    $stmt->execute([':heading_id' => $section['id']]);
    $subheaders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $storyPageSections[] = [
        'id' => $section['id'],
        'heading_title' => $section['heading_title'],
        'heading_content' => $section['heading_content'],
        'created_at' => $section['created_at'],
        'updated_at' => $section['updated_at'],
        'subheaders' => $subheaders
    ];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,0" />
    <link rel="stylesheet" href="../../styles/index.css">
    <style>
        body {
            background-image: none;
            background: #F7F7F7;
        }

        body::after {
            display: none;
        }
    </style>
    <title>Admin Panel - Pages</title>
</head>

<body>
    <main class="main d-flex gap-2">
        <!-- Sidebar -->
        <aside class="sidebar d-flex flex-column justify-content-between align-items-center py-2 px-3 bg-secondary">
            <div class="sidebar__content d-flex flex-column gap-3">
                <div class="sidebar__logo-container">
                    <img src="../../assets/images/chabacano_translator_v2.png" alt="Chabacano Translator Logo" width="300">
                </div>
                <div class="sidebar__menus">
                    <ul class="sidebar__menus__list d-flex flex-column gap-2">
                        <li class="sidebar__menus__list__item py-3">
                            <a href="./index.php" class="sidebar__menus__list__item__link text-light fs-body-text-semibold">Pages</a>
                        </li>
                        <li class="sidebar__menus__list__item py-3">
                            <a href="./chabacanoDictionary.php" class="sidebar__menus__list__item__link text-light fs-body-text-semibold">Dictionary</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main__sidebar__logout-btn">
                <a href="../../scripts/logout.php" class="button button--light fs-body-text-semibold">Logout</a>
            </div>
        </aside>

        <!-- Heading -->
        <div class="main__content p-5">
            <div class="main__content__heading py-3 px-4 bg-white-fff">
                <h1 class="fs-heading-3">Welcome, Admin</h1>
            </div>

            <div class="main__content__editor py-3 px-4 mt-3 bg-white-fff">
                <div class="main__content__editor__section">
                    <h2 class="fs-heading-5 mb-3">Edit Home Page</h2>
                    <form class="main__content__editor__section__form" action="../../scripts/updateHomeContent.php" method="POST">
                        <div class="main__content__editor__section__form__input">
                            <input type="text" value="<?php echo htmlspecialchars($homeContent['hero_title']); ?>" name="hero-title" id="hero-title" class="ct-input">
                        </div>
                        <div class="main__content__editor__section__form__input">
                            <textarea name="hero-content" id="hero-content" class="ct-textarea" cols="30" rows="5"><?php echo htmlspecialchars($homeContent['hero_content']); ?></textarea>
                        </div>

                        <h2 class="fs-heading-5 mb-3">About Us Content</h2>
                        <!-- About Us -->
                        <div class="main__content__editor__section__form__input">
                            <input type="text" value="<?php echo htmlspecialchars($homeContent['about_us_title']); ?>" name="about-us-title" id="about-us-title" class="ct-input">
                        </div>
                        <div class="main__content__editor__section__form__input">
                            <textarea name="about-us-content" id="about-us-content" class="ct-textarea" cols="30" rows="5"><?php echo htmlspecialchars($homeContent['about_us_content']); ?></textarea>
                        </div>

                        <!-- Our Mission -->
                        <div class="main__content__editor__section__form__input">
                            <input type="text" value="<?php echo htmlspecialchars($homeContent['our_mission_title']); ?>" name="our-mission-title" id="our-mission-title" class="ct-input">
                        </div>
                        <div class="main__content__editor__section__form__input">
                            <textarea name="our-mission-content" id="our-mission-content" class="ct-textarea" cols="30" rows="5"><?php echo htmlspecialchars($homeContent['our_mission_content']); ?></textarea>
                        </div>

                        <!-- Our Vision -->
                        <div class="main__content__editor__section__form__input">
                            <input type="text" value="<?php echo htmlspecialchars($homeContent['our_vision_title']); ?>" name="our-vision-title" id="our-vision-title" class="ct-input">
                        </div>
                        <div class="main__content__editor__section__form__input">
                            <textarea name="our-vision-content" id="our-vision-content" class="ct-textarea" cols="30" rows="5"><?php echo htmlspecialchars($homeContent['our_vision_content']); ?></textarea>
                        </div>

                        <!-- Why Chabacano -->
                        <div class="main__content__editor__section__form__input">
                            <input type="text" value="<?php echo htmlspecialchars($homeContent['why_chabacano_title']); ?>" name="why-chabacano-title" id="why-chabacano-title" class="ct-input">
                        </div>
                        <div class="main__content__editor__section__form__input">
                            <textarea name="why-chabacano-content" id="why-chabacano-content" class="ct-textarea" cols="30" rows="5"><?php echo htmlspecialchars($homeContent['why_chabacano_content']); ?></textarea>
                        </div>

                        <div class="main__content__editor__section__form__btn">
                            <button type="submit" class="button button--secondary" id="homepage-btn">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>

                <div class="main__content__editor__section">
                    <h2 class="fs-heading-5 mt-5 mb-3">Edit Story Page</h2>
                    <form class="main__content__editor__section__form" action="../../scripts/updateStoryContent.php" method="POST">
                        <div class="main__content__edit-hompage__form__input">
                            <input type="text" class="ct-input" name="header-title" id="header-title" placeholder="New Section Header">
                        </div>
                        <div class="main__content__editor__section__form__input">
                            <textarea name="header-content" id="header-content" class="ct-textarea" cols="30" rows="5" placeholder="New Section Content"></textarea>
                        </div>

                        <div id="subheader-container">
                            <!-- Can be add multiple times -->
                            <div class="subheader-container-form">
                                <div class="main__content__editor__section__form__input">
                                    <input type="text" class="ct-input" name="subheader-title-1" id="subheader-title-1" placeholder="New Section Subheader (optional)">
                                </div>
                                <div class="main__content__editor__section__form__input">
                                    <textarea name="subheader-content-1" id="subheader-content-1" class="ct-textarea" cols="30" rows="5" placeholder="New Section Subheader Content"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="main__content__editor__section__form__btn">
                            <button type="submit" class="button button--primary" id="add-subheader-btn">
                                Add Subheader
                            </button>
                            <button type="submit" class="button button--secondary" id="add-section-btn">
                                Add Section
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="main__content__sections py-3 px-4 mt-3 bg-white-fff d-flex flex-column gap-2">
                <h2 class="fs-heading-5 my-3">Existing Sections</h2>
                <?php foreach ($storyPageSections as $section): ?>
                    <div class="sections__section py-3 px-4">
                        <div class="sections__section__header">
                            <div class="header d-flex justify-content-between align-items-center mb-2">
                                <h3 class="fs-heading-6-bold">
                                    <?php echo htmlspecialchars($section['heading_title']); ?>
                                </h3>
                                <div class="header--buttons d-flex align-items-center gap-1">
                                    <button class="button button--xsm button--secondary edit-section-btn"
                                        data-id="<?php echo $section['id']; ?>"
                                        data-title="<?php echo htmlspecialchars($section['heading_title']); ?>"
                                        data-content="<?php echo htmlspecialchars($section['heading_content']); ?>"
                                        data-subheaders='<?php echo json_encode($section['subheaders']); ?>'
                                        data-bs-toggle="modal"
                                        data-bs-target="#editSectionModal">
                                        Edit
                                    </button>
                                    <form action="../../scripts/deleteStorySection.php" method="POST" class="d-inline-block">
                                        <input type="hidden" name="section_id" value="<?php echo $section['id']; ?>">
                                        <button type="submit" class="button button--xsm button--secondary">
                                            Delete
                                        </button>
                                    </form>
                                    <form action="../../scripts/updateStoryContent.php" method="POST">
                                        <input type="hidden" name="section_id" value="<?php echo $section['id']; ?>">
                                        <input type="hidden" name="direction" value="up">
                                        <button type="submit" class="button button--xsm button--secondary fs-xsmall-text">
                                            <span class="material-symbols-outlined text-light">
                                                arrow_upward
                                            </span>
                                        </button>
                                    </form>
                                    <form action="../../scripts/updateStoryContent.php" method="POST">
                                        <input type="hidden" name="section_id" value="<?php echo $section['id']; ?>">
                                        <input type="hidden" name="direction" value="down">
                                        <button type="submit" class="button button--xsm button--secondary fs-xsmall-text">
                                            <span class="material-symbols-outlined text-light">
                                                arrow_downward
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="fs-body-text">
                                <?php echo htmlspecialchars($section['heading_content']); ?>
                            </p>
                        </div>

                        <div class="sections__section__subheaders">
                            <?php if (!empty($section['subheaders'])): ?>
                                <?php foreach ($section['subheaders'] as $subheader): ?>
                                    <div class="sections__section__subheaders__subheader">
                                        <h4 class="fs-heading-6">
                                            <?php echo htmlspecialchars($subheader['subheading_title']); ?>
                                        </h4>
                                        <p class="fs-body-text">
                                            <?php echo htmlspecialchars($subheader['subheading_content']); ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="fs-body-text">No subheaders available for this section.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Modal for Edit Section -->
    <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../scripts/updateStoryContent.php" method="POST">
                        <input type="hidden" name="section_id" value="">
                        <div class="main__content__editor__section__form__input">
                            <input type="text" name="header-title" class="ct-input" value="" placeholder="New Section Header">
                        </div>
                        <div class="main__content__editor__section__form__input">
                            <textarea name="header-content" class="ct-textarea" placeholder="New Section Content"></textarea>
                        </div>

                        <div id="edit-subheader-container">
                            <!-- Subheaders will be dynamically added here -->
                        </div>

                        <div class="main__content__editor__section__form__btn">
                            <button type="submit" class="button button--sm button--primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>

    <script defer>
        document.getElementById('add-subheader-btn').addEventListener('click', function(e) {
            e.preventDefault();

            const subheaderContainer = document.getElementById('subheader-container');
            const index = subheaderContainer.children.length + 1;

            const subheaderHTML = `
            <div class="subheader-container-form">
                <div class="main__content__editor__section__form__input">
                    <input type="text" class="ct-input" name="subheader-title-${index}" placeholder="New Section Subheader (optional)">
                </div>
                <div class="main__content__editor__section__form__input">
                    <textarea name="subheader-content-${index}" class="ct-textarea" placeholder="New Section Subheader Content"></textarea>
                </div>
            </div>
        `;
            subheaderContainer.insertAdjacentHTML('beforeend', subheaderHTML);
        });

        document.querySelectorAll('.edit-section-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Get the section data from the button's data attributes
                const sectionId = this.getAttribute('data-id');
                const sectionTitle = this.getAttribute('data-title');
                const sectionContent = this.getAttribute('data-content');
                const subheaders = JSON.parse(this.getAttribute('data-subheaders'));

                // Fill the modal form with the section data
                const modal = document.getElementById('editSectionModal');
                modal.querySelector('input[name="section_id"]').value = sectionId;
                modal.querySelector('input[name="header-title"]').value = sectionTitle;
                modal.querySelector('textarea[name="header-content"]').value = sectionContent;

                // Clear the existing subheader fields
                const subheaderContainer = modal.querySelector('#edit-subheader-container');
                subheaderContainer.innerHTML = '';

                // Add subheader fields based on the existing subheaders
                subheaders.forEach((subheader, index) => {
                    const subheaderHTML = `
                <div class="subheader-container-form">
                    <div class="main__content__editor__section__form__input">
                        <input type="text" name="subheader-title-${index + 1}" class="ct-input" value="${subheader.subheading_title}" placeholder="Subheader Title">
                    </div>
                    <div class="main__content__editor__section__form__input">
                        <textarea name="subheader-content-${index + 1}" class="ct-textarea" placeholder="Subheader Content">${subheader.subheading_content}</textarea>
                    </div>
                </div>
            `;
                    subheaderContainer.insertAdjacentHTML('beforeend', subheaderHTML);
                });
            });
        });
    </script>

</body>

</html>