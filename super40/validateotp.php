<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
require_once "connection/connection.php"; 

header('Content-Type: application/json');

$phone = $_POST["mobno"];
$email = $_POST["email"];
$applicantName = $_POST["username"];
$inputOtp = $_POST['otp'];
$requesttime = date('Y-m-d H:i:s');

$query = "SELECT Id,otpval FROM `validateuser` WHERE email='$email' AND fullname = '$applicantName' AND mobno = '$phone' AND '$requesttime' < validupto ORDER BY createddate DESC LIMIT 1";
$queryResp =mysqli_query($con,$query);
if ($queryResp && mysqli_num_rows($queryResp)> 0){
    $applicantData = mysqli_fetch_assoc($queryResp);
    if( $applicantData["otpval"] ==  $inputOtp){
        $_SESSION['entryId'] = $applicantData["Id"];
        $_SESSION['isValidOtp'] = true;

    print (json_encode(array('message' => 'Success', 'code' => 1)));

    }
    else{
        print (json_encode(array('message' => 'Invalid OTP Retry', 'code' => 0)));
    }

}
else{
    print (json_encode(array('message' => 'Invalid OTP Retry', 'code' => 0)));
  
}
}

exit();

?>