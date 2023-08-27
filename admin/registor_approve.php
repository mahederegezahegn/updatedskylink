
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
include_once('dbcon.php');

    // Delete the record from the table based on the ID
    $sql = "UPDATE registor SET approve = 1 WHERE id = '$id'";
    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully.";
        header('location: approve.php');
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    // Close the database mysqliection
    $mysqli->close();
} else {
    echo "No ID provided.";
}

?>