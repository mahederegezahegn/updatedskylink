<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $companyName = $_POST["companyName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $verificationCode = $_POST["verification"];
    // $redirectUrl = "attend.html?message=" . urlencode($successMessage);
    // Check if the email or phone number already exists
    $checkSql = "SELECT * FROM 	registor WHERE email = '$email' OR phone_number = '$phoneNumber'";
    $checkResult = $conn->query($checkSql);
    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Email or phone number already exists.');</script>";

        echo "<script>window.location.href = '$redirectUrl';</script>";
    } else {
        // Insert the form data into the table
        $sql = "INSERT INTO 	registor (first_name, last_name, company_name, email, phone_number, verification_code)
                VALUES ('$firstName', '$lastName', '$companyName', '$email', '$phoneNumber', '$verificationCode')";

        if ($conn->query($sql) === false) {
            echo "<script>alert('Error inserting data: " . $conn->error . "');</script>";
            
            echo "<script>window.location.href = '$redirectUrl';</script>";
        } else {
            // Redirect to the "attend.html" page with the success message as a query parameter
            $successMessage = "Form data submitted successfully!";
            $redirectUrl = "attend.html?message=" . urlencode($successMessage);
            echo "<script>window.location.href = '$redirectUrl';</script>";
            exit; // Terminate further execution of the script
        }
    }
}

// Close the database connection
$conn->close();
?>