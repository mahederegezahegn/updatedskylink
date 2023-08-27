<?php

include_once('dbcon.php');
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