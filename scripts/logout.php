<?php

// Start the session
session_start();

// logout user

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: " . '../view/login.php');
exit();
