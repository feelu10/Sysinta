<?php
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../index.php?message=You must be logged in to access this page.&type=error");
    exit();
}

// Unset all session values 
$_SESSION = array();

// Destroy session 
session_destroy();

// Redirect to login page with a logout message
header("Location: ../index.php?message=Successfully logged out.&type=success");
exit();
?>
