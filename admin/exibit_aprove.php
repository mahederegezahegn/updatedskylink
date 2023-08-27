<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

function sendemail($email)
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

        $mail->setFrom('mahederegezaheng@gmail.com');

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
                a {
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
                .email-container {
                    background-color: #ffffff;
                    padding: 30px;
                    border-radius: 5px;
                    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
                }
                .email-container p {
                    color: #555555;
                    font-size: 16px;
                    line-height: 1.5;
                    margin-bottom: 20px;
                }
                .email-container p:last-child {
                    margin-bottom: 0;
                }
                .email-container .header {
                    color: #333333;
                    font-size: 24px;
                    font-weight: bold;
                    margin-bottom: 10px;
                }
                .email-container .sub-header {
                    color: #666666;
                    font-size: 18px;
                    font-weight: bold;
                    margin-bottom: 20px;
                }
                .email-container .cta-button {
                    text-align: center;
                    margin-top: 30px;
                }
                .email-container .cta-button .button {
                    display: inline-block;
                    padding: 12px 30px;
                    font-size: 16px;
                    transition: background-color 0.3s ease;
                }
                .email-container .cta-button .button:hover {
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
            <div class='email-container'>
                <h2 class='header'>Congratulations! Your company has been approved for ICT Expo</h2>
                <h5 class='sub-header'>Verify your email to complete the registration process</h5>
                <p>
                    Thank you for registering with ICT Expo. We are pleased to inform you that your company's exhibition application has been approved. Your booth has been confirmed for the upcoming event.
                </p>
               
            </div>
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
        echo "<script>alert('Message could not be sent. Mailer Error: " . $e->getMessage() . "'); window.location.href = 'approve.php';</script>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

 include_once('dbcon.php');

    // Update the record in the table to set 'approve' to 1 based on the ID
    $sql = "UPDATE exhibitors SET approve = 1 WHERE id = '$id'";
    if ($mysqli->query($sql) === TRUE) {
        // Retrieve the exhibitor's email from the database
        $emailResult = $mysqli->query("SELECT email FROM exhibitors WHERE id = '$id'");
        if ($emailResult && $emailResult->num_rows > 0) {
            $emailRow = $emailResult->fetch_assoc();
            $exhibitorEmail = $emailRow['email'];

            // Call the sendemail() function to send the verification email
            sendemail($exhibitorEmail);

            echo "<script>alert('Record updated successfully.'); window.location.href = 'approve.php';</script>";
        } else {
            echo "<script>alert('Email not found in the database.'); window.location.href = 'approve.php';</script>";
        }
    } else {
        echo "<script>alert('Error updating record: " . $mysqli->error . "'); window.location.href = 'approve.php';</script>";
    }

    // Close the database mysqliection
    $mysqli->close();
} else {
    echo "<script>alert('No ID provided.'); window.location.href = 'approve.php';</script>";
}