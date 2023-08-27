<?php

// Assuming the token is passed as a query parameter in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("UPDATE registor SET verified = 'verified' WHERE verify_token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        // Check if any rows were affected by the update
        if ($stmt->rowCount() > 0) {
            echo "Email verified successfully!";
            header('location:index.html');
        } else {
            echo "Invalid token or email already verified.";
        }
    } catch (PDOException $e) {
        echo "Error updating verified status: " . $e->getMessage();
    }
}