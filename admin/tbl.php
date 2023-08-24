<?php
// Establish a database connection
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';


$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the exhibitors table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS exhibitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255),
    display_name VARCHAR(255),
    section VARCHAR(255),
    mobile_phone VARCHAR(255),
    office_phone VARCHAR(255),
    fax VARCHAR(255),
    pobox VARCHAR(255),
    email VARCHAR(255),
    contact_person VARCHAR(255),
    alternative_person VARCHAR(255),
    payment VARCHAR(255),
    zone VARCHAR(255),
    booth_option1 VARCHAR(255),
    booth_option2 VARCHAR(255),
    booth_option3 VARCHAR(255),
    total_sqm VARCHAR(255),
    approve INT(1)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'exhibitors' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>