<?php

require_once "connection/connection.php"; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';


header('Content-Type: application/json');

$formnumber = $_POST["formno"];
$email = $_POST["email"];
$applicantName = $_POST["username"];

$formnumber =11234;
$email = 'amandeepbettiah@gmail.com';
$applicantName = 'Aman Deep';
$subject = 'ABHIMANYU SUPER-40 Form Detail';

$mail = new PHPMailer(true);

$welcm_mail = new PHPMailer(true);


$usermailer ='admin@amandeepbettiah.in';

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $usermailer;                     //SMTP username
    $mail->Password   = 'Admin123@';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    

    
    
    //Recipients
    $mail->setFrom($usermailer, 'ABHIMANYU SUPER-40');
    $mail->addAddress($email);     //Add a recipient
    $mail->addReplyTo($usermailer, 'Information');


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    
    $mail->Body    = 'Dear '.$applicantName.'<br>Online Addmission Form Submitted Successfully <br> Your Form Id :'.$formnumber;
    $mail->AltBody =  'Dear '.$applicantName.' \n Online Addmission Form Submitted Successfully \n Your Form Id : '.$formnumber;


    $mail->send();
    print (json_encode(array('message' => 'Check your Inbox!', 'code' => 1)));

} catch (Exception $e) {
    // $errmsg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    print (json_encode(array('message' => 'Error Occured Mail Not Sent. Please Note The Form Number', 'code' => 0)));
 
}

exit();

?>