<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['name']) && isset($_POST['email'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $body = $_POST['body'];

  require_once "PHPMailer/PHPMailer.php";
  require_once "PHPMailer/SMTP.php";
  require_once "PHPMailer/Exception.php";
  require 'vendor/autoload.php';

  $mail = new PHPMailer(true);

  $mail->SMTPDebug = SMTP::DEBUG_SERVER;    
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->Username = "doxieology.mcafee@gmail.com";
  $mail->Password = "Cosprings123";
  $mail->Port = 587;
  $mail->SMTPSecure = "tls";

  $mail->isHTML(true);
$mail->setFrom($email, $name);
$mail->addAddress("doxieology.mcafee@gmail.com");
$mail->Subject = ("$name ($email) ($subject)");
$mail->Body = $body;
if($mail->send()){
  $status = "success";
  $response = "Email is sent!";
}
else {
  $status = "failed";
  $response = "Something is wrong: <br>" . $mail->ErrorInfo;
}
  exit(json_encode(array("status" => $status, "response" => $response)));
}
?>