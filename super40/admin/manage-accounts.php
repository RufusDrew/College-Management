<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;
	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	require '../PHPMailer/src/SMTP.php';
	?>
<!---------------- Session Ends form here ------------------------>

<?php
	$message = "";
	$success_message = '';
	$error_message ='';
if (isset($_POST['submit'])) {
	$account = $_POST['account'];
	$user_id = $_POST['user_id'];
	$usertype = $_POST['acctype'];
	if($usertype == 'Teacher'){
		$validateAcc = "SELECT teacher_id,email,first_name,middle_name,last_name FROM `teacher_info` WHERE email = '$user_id'";
	}
	else{
		$validateAcc = "SELECT roll_no,email,first_name,middle_name,last_name FROM `student_info` WHERE roll_no = $user_id";
	} 
	$emailDetail  = mysqli_query($con,$validateAcc);
	if(mysqli_num_rows($emailDetail)> 0){
	$que="update login set account='$account' where user_id = '$user_id'";
	$run=mysqli_query($con,$que);
	if ($run) {
		$message =  $account == "Activate" ? "Account Activated Successfully" : "Account Deactivated Successfully";
		$query = "SELECT * FROM login WHERE user_id = '$user_id'";
		$queryres = mysqli_query($con,$query);
		if($queryres && mysqli_num_rows($queryres) > 0){
			$userData = mysqli_fetch_assoc($queryres);
				$mail = new PHPMailer(true);	
				$studentDetail = mysqli_fetch_assoc($emailDetail);
				$email = $studentDetail["email"];
				$applicantName = $studentDetail["first_name"]." ".$studentDetail["middle_name"]." ".$studentDetail["last_name"];
				$instHelpNo = '+91 7004826636';
				$usermailer ='admin@amandeepbettiah.in';
				$subject = 'Login Credentials'; 
	
			try {
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = $usermailer;                     //SMTP username
				$mail->Password   = 'Admin123@';                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
			
				$mail->setFrom($usermailer, 'ABHIMANYU SUPER-40');
				$mail->addAddress($email);     //Add a recipient
				$mail->addReplyTo($usermailer, 'Information');
			
			
				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = $subject;
				if ($account  == 'Activate'){
				//$mail->Body    = 'Dear '.$applicantName.'<br>Your login deatil is <br> User ID : '.$userData["user_id"].'<br> Password : '.$userData["Password"];
				
				$mail->Body = "Dear ".$applicantName.
				", <br> We welcome you to Abhimanyu Super-40 and are pleased to reconnect with you.<br>".
				"Please find below the credentials required to login to the portal.<br>".
				"<b>User ID: ".$userData["user_id"]."</b><br>".
				"<b>Password: ".$userData["Password"]."</b><br>".
				"Click Here to go to the Abhimanyu Super-40 portal.<br>".
				"In case of any assistance required, please feel free to reach out to us at Mobile Number ".$instHelpNo.".<br><br>". 
				"Thanks & Regards <br>".
				"Abhimanyu Super-40";
				
				$mail->AltBody =  'Dear '.$applicantName.'\n Your login deatil is \n User ID : '.$userData["user_id"].'\n Password : '.$userData["Password"];
				}
				else{
					$mail->Body    = 'Dear '.$applicantName.'<br>Your Account Has been <b>deactivated.</b><br> <b>User ID : '.$userData["user_id"]."</b><br>In case of any assistance required, please feel free to reach out to us at Mobile Number ".$instHelpNo.".<br><br>"."Thanks & Regards <br>"."Abhimanyu Super-40";
					
				$mail->AltBody =  'Dear '.$applicantName.' \n Your Account Has been deactivated. \n User ID : '.$userData["user_id"]."\n \n Thanks & Regards \n"."Abhimanyu Super-40";;
				}


				
			
				$mail->send();
				
				$success_message = $message;
			
			} catch (Exception $e) {
				
				$success_message = $message;
			
			}
		}
	}	
	else{
		$error_message = "Account Not Activated, Invalid Id";
	}

}
else{
	$error_message =  "Invalid User Id";
}

}

?>
<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Manage Accounts</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4>User Account Management System </h4>
				</div>
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<?php
									if($success_message){
										$bg_color = "alert-success";
										$message = $success_message;
									}
									else if($error_message){
										$bg_color = "alert-danger";	
										$message = $error_message;
									}
								?>
								<h5 class="py-2 pl-3 <?php echo $bg_color; ?>">
									
									<?php echo $message ?>
								</h5>
							</div>
							<div class="col-md-12">
								<form action="manage-accounts.php" method="post">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Enter User ID</label>
												<input type="text" name="user_id" class="form-control" required placeholder="Enter ID">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Enter Account Status:</label>
												<select name="account" class="form-control" required> 
													<option  selected disabled value="">Select Account Status</option>
													<option value="Activate">Activate</option>
													<option value="Deactivate">Deactivate</option>

												</select>
											</div>
										</div>
									</div>
									<div class="row">
									<div class="col-md-6">
											<div class="form-group">
												<label>Enter Account Type:</label>
												<select name="acctype" class="form-control">
													<option value="Student" selected>Student</option>
													<option value="Teacher">Teacher</option>

												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
												<input type="submit" name="submit" value="Change" class="btn btn-primary px-5">
											</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<?php include('../common/common-footer.php') ?>
	</body>
</html>
