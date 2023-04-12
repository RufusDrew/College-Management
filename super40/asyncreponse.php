<?php
// require('functions.inc.php');
// require('dbconnect.inc.php');
require_once "connection/connection.php"; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';


header('Content-Type: application/json');

$phone = $_POST["mobno"];
$email = $_POST["email"];
$applicantName = $_POST["username"];

// $phone = '9572830566';
// $email = 'amandeepbettiah@gmail.com';
// $applicantName = 'Aman Deep';
$subject = 'ABHIMANYU SUPER-40 Authentication OTP';
$otp=rand(111111,999990);
$requesttime = date('Y-m-d H:i:s');
$validupto = date('Y-m-d H:i:s', strtotime('+15 minutes', strtotime($requesttime)));

$query = "INSERT INTO `validateuser` (`email`, `fullname`, `mobno`, `otpval`, `createddate`, `validupto`) VALUES ('$email', '$applicantName', '$phone', '$otp', '$requesttime', '$validupto');";
$queryResp =mysqli_query($con,$query);
if ($queryResp){
    $insertedid = mysqli_insert_id($con);


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
    
    //$mail->Body    = 'Dear '.$applicantName.'<br> Verification OTP - '.$otp;
    $mail->Body = "Dear ".$applicantName.",<br>Please verify your email id using the OTP <b>".$otp."</b> to proceed.<br><br>Thanks & Regards <br> Abhimanyu Super-40";
    $mail->AltBody =  'Dear '.$applicantName.' \n Verification OTP - '.$otp;


 

    $mail->send();
    print (json_encode(array('message' => 'OTP Successfully sent check you email!', 'code' => 1)));

} catch (Exception $e) {
    // $errmsg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    print (json_encode(array('message' => 'Error Occured Try Again Later', 'code' => 0)));
 
}
}
else{
    print (json_encode(array('message' => 'DB Error Occured Try Again Later', 'code' => 0)));
  
}

exit();

?>