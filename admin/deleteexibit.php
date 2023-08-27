
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

   include_once('dbcon.php');

    // Delete the record from the table based on the ID
    $sql = "DELETE FROM exhibitors WHERE id = '$id'";
    if ($mysqli->query($sql) === TRUE) {
        echo "Record deleted successfully.";
        header('location:approve.php');
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }

    // Close the database mysqliection
    $mysqli->close();
} else {
    echo "No ID provided.";
}

?>