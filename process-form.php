<?php
include_once('dbcon.php');
        

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


function sendemail($email,$name,$token){
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'mail.direinttechexpo.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@direinttechexpo.com';
        $mail->Password = 'Dire@Expo_2024';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('info@direinttechexpo.com');

        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'This is a verification for '.$name;
        $email_template = "
        <html>
        <head>
        <style>
        /* Put your CSS styles here */
        body {
          font-family: Arial, sans-serif;
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
        p {
          color: #555555;
          font-size: 16px;
          line-height: 1.5;
          margin-bottom: 20px;
        }
        a {
          color: #4CAF50;
          text-decoration: none;
        }
        .button {
          display: inline-block;
          background-color: #4CAF50;
          color: #ffffff;
          text-decoration: none;
          padding: 10px 20px;
          border-radius: 5px;
          transition: background-color 0.3s ease;
        }
        .button:hover {
          background-color: #45a049;
        }
      </style>
    </head>
    <body>
      <h2>Congratulations! Your company has been approved for ICT Expo</h2>
      <p>
        Thank you for registering with ICT Expo. We are pleased to inform you that your company's exhibition application has been approved. Your booth has been confirmed for the upcoming event.
      </p>
      <p>
        To complete the registration process, please verify your email by clicking the following link:
      </p>
      <p>
    <button><a class='button' href='http://localhost/skylink_web/web1/verify_email.php?token=$token'>Verify Email</a>
    </button>
      </p>
      <p>
        If you have any questions or need further assistance, please don't hesitate to contact us. We look forward to seeing you at the event!
      </p>
      <p>Best regards,<br>ICT Expo Team</p>
    </body>
        </html>
    ";

        $mail->Body = $email_template;

        // Enable debugging mode
        $mail->SMTPDebug = 2;

        if ($mail->send()) {
            echo "<script> window.location.href = 'attend.html';alert('Message has been sent. verify the email');</script>";
        } else {
            throw new Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: " . $e->getMessage() . "');";
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
    $checkStmt = $mysqli->prepare($checkSql);
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
        $insertStmt = $mysqli->prepare($insertSql);
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