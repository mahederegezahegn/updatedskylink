<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

function sendemail($email, $name)
{
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
        $mail->Subject = 'Congratulations!'.$name .' has been approved for ICT Expo';
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
            color: #ffffff;
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
          .logo {
            display: block;
            margin: 0 auto;
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
          }
        </style>
        </head>
        <body>
          <img src='company_logo.png' alt='Company Logo' class='logo'>
          <h2>Congratulations! Your company has been approved for ICT Expo</h2>
          <p>
            Thank you for registering with ICT Expo. We are pleased to inform you that your company's exhibition application has been approved. Your booth has been confirmed for the upcoming event.
          </p>
          <p>
            For further assistance or any inquiries, please do not hesitate to contact us using the following information:
          </p>
          <p>
            Email: <a href='mailto:contact@ictexpo.com'>contact@ictexpo.com</a><br>
            Phone: +1 123-456-7890
          </p>
          <p>
            We look forward to seeing you at the event!
          </p>
          <p>Best regards,<br>ICT Expo Team</p>
        </body>
        </html>
    ";

        $mail->Body = $email_template;

        // Enable debugging mode
        $mail->SMTPDebug = 2;

        if ($mail->send()) {
            echo "<script> window.location.href = 'approve.php';alert('Message has been sent.');</script>";
        } else {
            throw new Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: " . $e->getMessage() . "');</script>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include_once('dbcon.php');
    $sql = "UPDATE exhibitors SET approve = 1 WHERE id = '$id'";
    if ($mysqli->query($sql) === TRUE) {
        // Retrieve the exhibitor's email and company name from the database
        $emailResult = $mysqli->query("SELECT email, company_name FROM exhibitors WHERE id = '$id'");
        if ($emailResult && $emailResult->num_rows > 0) {
            $emailRow = $emailResult->fetch_assoc();
            $exhibitorEmail = $emailRow['email'];
            $exhibitorName = $emailRow['company_name'];

            // Call the sendemail() function to send the verification email
            sendemail($exhibitorEmail, $exhibitorName);
            echo "<script>alert('Record updated successfully.'); window.location.href = 'approve.php';</script>";
        } else {
            echo "<script>alert('Email not found in the database.'); window.location.href = 'approve.php';</script>";
        }
    } else {
        echo "<script>alert('Error updating record: " . $mysqli->error . "'); window.location.href = 'approve.php';</script>";
    }

    // Close the database connection
    $mysqli->close();
} else {
    echo "<script>alert('No ID provided.'); window.location.href = 'approve.php';</script>";
}