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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

function sendemail($email, $name, $token)
{

    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mahederegezaheng@gmail.com';
        $mail->Password = 'idozelnmzyvhhavw';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('mahederegezaheng@gmail.com', $name);

        $mail->addAddress('mahederegezaheng@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'This is a verification for $';
        $email_template = "
        <html>
        <head>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f1f1f1;
                    padding: 20px;
                    max-width: 600px;
                    margin: 0 auto;
                }
                h2 {
                    color: #333333;
                    margin-top: 0;
                    margin-bottom: 20px;
                }
                h5 {
                    color: #666666;
                }
                a{
                    text-decoration:none;

                }
                .button {
                    display: inline-block;
                    background-color: #4CAF50;
                    color: #ffffff;
                    text-decoration: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                }
                .button:hover {
                    background-color: #45a049;
                }
                @media only screen and (max-width: 480px) {
                    body {
                        padding: 10px;
                    }
                }
            </style>
        </head>
        <body>
            <div style='background-color: #ffffff; padding: 30px; border-radius: 5px;'>
                <h2>You have registered with ICT Expo</h2>
                <h5>Verify your email to complete the registration process</h5>
                <p>
                    Thank you for registering with ICT Expo. To verify your email and complete the registration, click the button below:
                </p>
                <p style='text-align: center;'>
                    <a class='button' href='http://localhost/skylink_web/web1/verify_email.php?token=$token'>Verify Email</a>
                </p>
            </div>
        </body>
        </html>
    ";
        $mail->Body = $email_template;

        // Enable debugging mode
        $mail->SMTPDebug = 2;

        if ($mail->send()) {
            echo 'Message has been sent';
        } else {
            throw new Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $companyName = $_POST["companyName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $verificationCode = $_POST["verification"];
    $token = bin2hex(random_bytes(16)); // Generate a random token

    // Check if the email or phone number already exists
    $checkSql = "SELECT * FROM registor WHERE email = ? OR phone_number = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $email, $phoneNumber);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        $errorMsg = "Email or phone number already exists.";
        echo "<script>alert('$errorMsg');</script>";
    
        $redirectUrl = "attend.html?message=" . urlencode($errorMsg);
        echo "<script>window.location.href = '$redirectUrl';</script>";
        exit; // Terminate further execution of the script
    } else {
        // Insert the form data into the table using prepared statements
        $insertSql = "INSERT INTO registor (first_name, last_name, company_name, email, phone_number, verification_code, verify_token)
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("sssssss", $firstName, $lastName, $companyName, $email, $phoneNumber, $verificationCode, $token);

        if ($insertStmt->execute()) {
            // Redirect to the "attend.html" page with the success message as a query parameter
            sendemail($email, $firstName, $token);
            $successMsg = "verify your email we send you email to verify  ";
            $redirectUrl = "attend.html?message=" . urlencode($successMsg);
            echo "<script>window.location.href = '$redirectUrl';</script>";
            exit; // Terminate further execution of the script
        } else {
            $errorMsg = "Error inserting data: " . $insertStmt->error;
            echo "<script>alert('$errorMsg');</script>";

            $redirectUrl = "attend.html?message=" . urlencode($errorMsg);
            echo "<script>window.location.href = '$redirectUrl';</script>";
            exit; // Terminate further execution of the script
        }
    }
}
?>