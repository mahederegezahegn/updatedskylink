<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';



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

        $mail->addAddress('mahederegezaheng@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'This is a verification for $';
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
    <button> <a href=''>Verify Email</a></button>
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
            echo "<script> window.location.href = 'approve.php';alert('Message has been sent.');</script>";
        } else {
            throw new Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: " . $e->getMessage() . "');";
    }

?>