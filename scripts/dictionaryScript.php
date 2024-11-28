<?php

include dirname(__DIR__) . '/config/DBConnector.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (isset($_POST['action']) && $_POST['action'] === 'update') {
            // Update dictionary entry
            $stmt = $conn->prepare("UPDATE dictionary_tb SET chabacano_lang = :chabacano, tagalog_lang = :tagalog, english_lang = :english, definition = :definition WHERE id = :id");
            $stmt->execute([
                ':chabacano' => $_POST['chabacano-lang'],
                ':tagalog' => $_POST['tagalog-lang'],
                ':english' => $_POST['english-lang'],
                ':definition' => $_POST['definition'],
                ':id' => $_POST['id']
            ]);

            $_SESSION['message'] = ['type' => 'success', 'content' => 'Entry updated successfully!'];
        } else if ($_POST['action'] === 'delete') {
            $stmt = $conn->prepare("DELETE FROM dictionary_tb WHERE id = :id");
            $stmt->execute([
                ':id' => $_POST['id']
            ]);
            if ($stmt->rowCount() > 0) {
                $_SESSION['message'] = ['type' => 'success', 'content' => 'Dictionary entry has been deleted!'];
            }
        } else {

            if (empty($_POST['chabacano-lang']) || empty($_POST['tagalog-lang']) || empty($_POST['english-lang']) || empty($_POST['definition'])) {

                $_SESSION['message'] = ['type' => 'warning', 'content' => 'Fields are empty! or Some fields are empty!'];
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            $stmt = $conn->prepare("INSERT INTO dictionary_tb(chabacano_lang, tagalog_lang, english_lang, definition) VALUES(:chabacano_lang, :tagalog_lang, :english_lang, :definition)");
            $stmt->execute([
                ':chabacano_lang' => $_POST['chabacano-lang'],
                ':tagalog_lang' => $_POST['tagalog-lang'],
                ':english_lang' => $_POST['english-lang'],
                ':definition' => $_POST['definition']
            ]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['message'] = ['type' => 'success', 'content' => 'Dictionary entry has been added!'];
            }
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } catch (PDOException $e) {
        $_SESSION['message'] = ['type' => 'error', 'content' => $e->getMessage()];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
