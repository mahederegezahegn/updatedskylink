
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

   include_once('dbcon.php');

    // Delete the record from the table based on the ID
    $sql = "DELETE FROM admins WHERE id = '$id'";
    if ($mysqli->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully.')</script>";
        header('location:admin.php');
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }

    // Close the database mysqliection
    $mysqli->close();
} else {
    echo "No ID provided.";
}

?>