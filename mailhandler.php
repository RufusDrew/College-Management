<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$firstname = $_POST["username"];
$email = $_POST["email"];
$message = $_POST["message"];
$subject = $_POST["subject"];

$mail = new PHPMailer(true);

$welcm_mail = new PHPMailer(true);


$usermailer ='admin@amandeepbettiah.in';

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $usermailer;                     //SMTP username
    $mail->Password   = 'Admin123@';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    

    $welcm_mail->isSMTP();                                            //Send using SMTP
    $welcm_mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $welcm_mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $welcm_mail->Username   = $usermailer;                     //SMTP username
    $welcm_mail->Password   = 'Admin123@';                               //SMTP password
    $welcm_mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $welcm_mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    
    
    //Recipients
    $mail->setFrom($usermailer, 'ABHIMANYU SUPER-40');     // Admin mail
    $mail->addAddress('amandeepbettiah@gmail.com', $firstname);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo($usermailer, 'Information');



    $welcm_mail->setFrom($usermailer, 'ABHIMANYU SUPER-40');     // user mail id
    $welcm_mail->addAddress($email, $firstname);     //Add a recipient
    $welcm_mail->addReplyTo($usermailer, 'Information');



    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = 'Name : '.$firstname.' <br> Message: '.$message.'<br>';
    $mail->AltBody =  "Name : ".$firstname." \n Message: ".$message."\n";


    $welcm_mail->isHTML(true);
    $welcm_mail->Subject = "Thank You For Your Enquiry";
    $welcm_mail->Body    = 'Hi '.$firstname.'<br> Thank You for your enquiry. Our Team will contact you soon. <br>';
    $welcm_mail->AltBody = "Hi ".$firstname."\n Thank You for your enquiry. Our Team will contact you soon. \n";
    


    $mail->send();
    $welcm_mail->send();


    header('Location: contact.php?msgresp=s');

  

} catch (Exception $e) {
    // $errmsg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    header('Location: contact.php?msgresp=f');
 
}

}

?>