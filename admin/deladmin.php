
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Assuming you have established a database connection previously
    // Replace the placeholders with your actual database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the record from the table based on the ID
    $sql = "DELETE FROM admins WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully.')</script>";
        header('location:admin.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "No ID provided.";
}

?>