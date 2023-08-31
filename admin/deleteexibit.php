
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
        $mail->Subject = 'We sincerely apologize for the inconvenience';
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
  <h2>We sincerely apologize for the inconvenience</h2>
  <p>
    Thank you for registering with ICT Expo. We regret to inform you that your company's exhibition application has not been fully accepted as it does not fulfill the requirements set by our organization.
  </p>
  <p>
    We appreciate your interest and support for our event, and we understand the effort you put into your application. We apologize for any inconvenience caused.
  </p>
  <p>
    If you have any further inquiries or require assistance, please do not hesitate to contact us using the following information:
  </p>
  <p>
    Email: <a href='mailto:contact@ictexpo.com'>contact@ictexpo.com</a><br>
    Phone: +1 123-456-7890
  </p>
  <p>
    We sincerely appreciate your understanding and hope to have the opportunity to work together in the future. Thank you for your support.
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

    // Fetch email and company name from the table based on the ID
    $fetchQuery = "SELECT email, company_name FROM exhibitors WHERE id = '$id'";
    $result = $mysqli->query($fetchQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $companyName = $row['company_name'];

        // Call the sendEmail() function with email and company name as parameters
        sendEmail($email, $companyName);

        // Delete the record from the table based on the ID
        $deleteQuery = "DELETE FROM exhibitors WHERE id = '$id'";
        if ($mysqli->query($deleteQuery) === TRUE) {
            echo "Record deleted successfully.";
            header('location:approve.php');
        } else {
            echo "Error deleting record: " . $mysqli->error;
        }
    } else {
        echo "No record found for the provided ID.";
    }

    // Close the database connection
    $mysqli->close();
} else {
    echo "No ID provided.";
}
?>