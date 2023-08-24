<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

// Create a new mysqli connection
$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $eventId = $_GET['id'];
    
    // Perform the database delete
    $sql = "DELETE FROM events WHERE id = $eventId";
    if ($mysqli->query($sql) === TRUE) {
        echo 'Event deleted successfully!';
        header('Location: dash.php');
        exit();
    } else {
        echo 'Error deleting event.';
    }
}
?>