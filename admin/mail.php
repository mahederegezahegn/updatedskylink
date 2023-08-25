<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mahederegezaheng@gmail.com';
    $mail->Password = 'idozelnmzyvhhavw';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setfrom('mahederegezaheng@gmail.com');

    $mail->addAddress('gezahegntadesse17@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'this is demo';
    $mail->Body = 'aknkana';

    if ($mail->send()) {
      header('location:index.php');
    } else {
        $response = ['success' => false, 'message' => 'Failed to send email. Please try again.'];
    }

    echo json_encode($response);
}
?>