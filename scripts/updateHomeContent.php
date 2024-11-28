<?php

include dirname(__DIR__) . '/config/DBConnector.php';

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if one of the fields are empty, show an error
    if (
        empty($_POST['hero-title']) || empty($_POST['hero-content']) ||
        empty($_POST['about-us-title']) || empty($_POST['about-us-content']) ||
        empty($_POST['our-mission-title']) || empty($_POST['our-mission-content']) ||
        empty($_POST['our-vision-title']) || empty($_POST['our-vision-content']) ||
        empty($_POST['why-chabacano-title']) || empty($_POST['why-chabacano-content'])
    ) {
        $_SESSION['message'] = ['type' => 'warning', 'content' => 'Fields are empty! or Some fields are empty!'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $stmt = $conn->prepare("UPDATE home_page_content_tb SET
        hero_title = :hero_title,
        hero_content = :hero_content,
        about_us_title = :about_us_title,
        about_us_content = :about_us_content,
        our_mission_title = :our_mission_title,
        our_mission_content = :our_mission_content,
        our_vision_title = :our_vision_title,
        our_vision_content = :our_vision_content,
        why_chabacano_title = :why_chabacano_title,
        why_chabacano_content = :why_chabacano_content
        WHERE id = 1");

    $stmt->execute([
        ':hero_title' => $_POST['hero-title'],
        ':hero_content' => $_POST['hero-content'],
        ':about_us_title' => $_POST['about-us-title'],
        ':about_us_content' => $_POST['about-us-content'],
        ':our_mission_title' => $_POST['our-mission-title'],
        ':our_mission_content' => $_POST['our-mission-content'],
        ':our_vision_title' => $_POST['our-vision-title'],
        ':our_vision_content' => $_POST['our-vision-content'],
        ':why_chabacano_title' => $_POST['why-chabacano-title'],
        ':why_chabacano_content' => $_POST['why-chabacano-content']
    ]);

    // if the submission is success, go back to the page
    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = ['type' => 'success', 'content' => 'Home page content has been updated!'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $_SESSION['message'] = ['type' => 'error', 'content' => 'Something went wrong. Please try again.'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
