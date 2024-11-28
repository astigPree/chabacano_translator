<?php
include dirname(__DIR__) . '/config/DBConnector.php';

if (isset($_POST['section_id'])) {
    $sectionId = $_POST['section_id'];

    // Delete subheaders first
    $stmt = $conn->prepare("DELETE FROM story_subheaders_tb WHERE heading_id = :heading_id");
    $stmt->execute([':heading_id' => $sectionId]);

    // Then delete the section itself
    $stmt = $conn->prepare("DELETE FROM story_headers_tb WHERE id = :id");
    $stmt->execute([':id' => $sectionId]);

    // Redirect back to the page or show a success message
    $_SESSION['message'] = ['type' => 'success', 'content' => 'Section deleted successfully!'];
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
