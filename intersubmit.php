<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


function sendemail($email,$name){
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
  <img src='https://direinttechexpo.com/assets/images/Ict%20expo%20final%20.png' alt='Government Logo' class='logo'>
    To complete the registration proce                                                          ss, please verify your email by clicking the following link:
  </p>
  <p>
    <button><a class='button' href='http://localhost/skylink_web/web1/verifyemail.php?token=$email'>Verify Email</a></button>
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
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
   include_once('dbcon.php');
        

    $stmt = $mysqli->prepare("INSERT INTO exhibitors (company_name, display_name, section, mobile_Phone, office_Phone, fax, pobox, email, contact_Person, alternative_Person, payment, zone, website, booth_option1, booth_option2, booth_option3, total_sqm, approve, method) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

    if (!$stmt) {
        die("Error in preparing the statement: " . $mysqli->error);
    }
    // Set the values for the parameters
    $method = 'internaltional';
    $companyName = $_POST['companyName'];
    $displayName = $_POST['displayName'];
    $section = $_POST['section'];
    $mobilePhone = $_POST['mobilePhone'];
    $officePhone = $_POST['officePhone'];
    $fax = $_POST['fax'];
    $pobox = $_POST['pobox'];
    $email = $_POST['email'];
    $contactPerson = $_POST['contactPerson'];
    $alternativePerson = $_POST['alternativePerson'];
    $payment = 'international';
    $zone = $_POST['zone'];
    $website = $_POST['website'];
    $boothNumber = $_POST['boothNumber'];
    $boothNumber2 = $_POST['boothNumber2'];
    $boothNumber3 = $_POST['boothNumber3'];
    $Totalsq = $_POST['Totalsq'];
    $approve = 0; // Assuming you want to set the 'approve' column to 0

 
    // Check if the company name already exists
    $existingCompanyQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE company_name = ?');
    $existingCompanyQuery->bind_param('s', $companyName);
    $existingCompanyQuery->execute();
    $existingCompanyQuery->store_result();
    $existingCompanyCount = $existingCompanyQuery->num_rows;
    $existingCompanyQuery->close();
    
    // Check if the display name already exists
    $existingDisplayQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE display_name = ?');
    $existingDisplayQuery->bind_param('s', $displayName);
    $existingDisplayQuery->execute();
    $existingDisplayQuery->store_result();
    $existingDisplayCount = $existingDisplayQuery->num_rows;
    $existingDisplayQuery->close();
    
    // Check if the mobile phone already exists
    $existingMobileQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE mobile_Phone = ?');
    $existingMobileQuery->bind_param('s', $mobilePhone);
    $existingMobileQuery->execute();
    $existingMobileQuery->store_result();
    $existingMobileCount = $existingMobileQuery->num_rows;
    $existingMobileQuery->close();
    
    // Check if the office phone already exists
    $existingOfficeQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE office_Phone = ?');
    $existingOfficeQuery->bind_param('s', $officePhone);
    $existingOfficeQuery->execute();
    $existingOfficeQuery->store_result();
    $existingOfficeCount = $existingOfficeQuery->num_rows;
    $existingOfficeQuery->close();
    
    // Check if the fax already exists
    $existingFaxQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE fax = ?');
    $existingFaxQuery->bind_param('s', $fax);
    $existingFaxQuery->execute();
    $existingFaxQuery->store_result();
    $existingFaxCount = $existingFaxQuery->num_rows;
    $existingFaxQuery->close();
    
    // Check if the PO Box already exists
    $existingPOBoxQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE pobox = ?');
    $existingPOBoxQuery->bind_param('s', $pobox);
    $existingPOBoxQuery->execute();
    $existingPOBoxQuery->store_result();
    $existingPOBoxCount = $existingPOBoxQuery->num_rows;
    $existingPOBoxQuery->close();
    
    // Check if the website already exists
    $existingWebsiteQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE website = ?');
    $existingWebsiteQuery->bind_param('s', $website);
    $existingWebsiteQuery->execute();
    $existingWebsiteQuery->store_result();
    $existingWebsiteCount = $existingWebsiteQuery->num_rows;
    $existingWebsiteQuery->close();
       
if ($existingCompanyCount > 0) {
    echo "<script>alert('Company name is already registered. Please choose a different name.');</script>";
    echo "<script>window.location.href = 'exhibitor.html';</script>";
} elseif ($existingDisplayCount > 0) {
    echo "<script>alert('Display name is already registered. Please choose a different name.');</script>";
    echo "<script>window.location.href = 'exhibitor.html';</script>";
} elseif ($existingMobileCount > 0) {
    echo "<script>alert('Mobile phone number is already registered. Please enter a different number.');</script>";
    echo "<script>window.location.href = 'exhibitor.html';</script>";
} elseif ($existingOfficeCount > 0) {
    echo "<script>alert('Office phone number is already registered. Please enter a different number.');</script>";
    echo "<script>window.location.href = 'exhibitor.html';</script>";
} elseif ($existingFaxCount > 0) {
    echo "<script>alert('Fax number is already registered. Please enter a different number.');</script>";
    echo "<script>window.location.href = 'exhibitor.html';</script>";
} elseif ($existingPOBoxCount > 0) {
    echo "<script>alert('PO Box number is already registered. Please enter a different number.');</script>";
    echo "<script>window.location.href = 'exhibitor.html';</script>";
} elseif ($existingWebsiteCount > 0) {
    echo "<script>alert('Website is already registered. Please enter a different website URL.');</script>";
    echo "<script>window.location.href = 'exhibitor.html';</script>";
} else {
    // $token = bin2hex(random_bytes(16)); 
    
    // Generate a random token
    // Insert the data into the database
   
    $stmt->bind_param("sssssssssssssssssss",
        $companyName, $displayName, $section, $mobilePhone, $officePhone, $fax, $pobox, $email, $contactPerson, $alternativePerson, $payment, $zone, $website, $boothNumber, $boothNumber2, $boothNumber3, $Totalsq, $approve, $method);
    $stmt->execute();
    $stmt->close();
    if($stmt){
        sendemail($email, $firstName);
    // Display success message
    echo "<script>alert('Data inserted successfully.');</script>";
    echo "<script>window.location.href = 'exhibitor.html';</script>";
    }
    // Display success message
    echo "<script>alert('Data inserted errorr.');</script>";
    echo "<script>window.location.href = 'exhibitor.html';</script>";
}
    }
    ?>