<?php
session_start(); // Start the session

// Destroy the session
session_unset();
session_destroy();

// Redirect to login.php or any other desired page
header('Location: login.php');
exit();
?>