<?php
session_start(); 

require("connection/connection.php");  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
if (isset($_SESSION['LoginAdmin'])){
    header('Location: admin/admin-index.php');
}
else if (isset($_SESSION['isValidOtp']) && isset($_SESSION['entryId'] )){
	$filterId = $_SESSION["entryId"];
	$query = "SELECT * FROM `validateuser` WHERE id = $filterId";
	$queryResp = mysqli_query($con,$query);
	$fistName = '';
	$lastName = '';
	$middleName = '';
	$applicantEmail = '';
	$applicantMob = '';
	$applied = false;
	$email_message = '';
	if($query && mysqli_num_rows($queryResp)){
		$applicantData = mysqli_fetch_assoc($queryResp);
		$applicantName = explode(" ",$applicantData["fullname"]);
		$lenName = count($applicantName);
		if($lenName > 0){
			if($lenName == 1){
				$fistName = $applicantName[0];
			}
			elseif($lenName == 2){
				$fistName = $applicantName[0];
				$lastName = $applicantName[$lenName-1];
			}
			else{
				$fistName = $applicantName[0];
				$lastName = $applicantName[$lenName-1];
				$middleName = join(" ",array_slice($applicantName,1,$lenName-2));
			}


		}
		$applicantEmail = $applicantData["email"];
		$applicantMob = $applicantData["mobno"];
		
	}
}
else{
 header('Location:login/login.php');
}

?>

<?php  
	// print_r($_POST);
 	if (isset($_POST['btn_save'])) {
 		$first_name= strtoupper($_POST["first_name"]);

 		$middle_name= strtoupper($_POST["middle_name"]);
 		
 		$last_name= strtoupper($_POST["last_name"]);
 		
 		$father_name=strtoupper($_POST["father_name"]);
 		
 		$email=$_POST["email"];
 		
 		$mobile_no=$_POST["mobile_no"];

 		$course_code=$_POST['course_code'];

 		$session=$_POST['session'];
 		
 		$prospectus_issued='';
 		
 		$prospectus_amount='';
 		
 		$form_b=$_POST["form_b"];
 		
 		$applicant_status='';
 		
 		$application_status='';
 		
 		$cnic=$_POST["cnic"];
 		
 		$dob=$_POST["dob"];
 		 		
 		$gender=$_POST["gender"];
 		
		$permanent_address=$_POST["permanent_address"];
 		
 		$current_address=$_POST["current_address"];
 		
 		$place_of_birth=strtoupper($_POST["place_of_birth"]);
 		
 		$matric_complition_date=$_POST["matric_complition_date"];
 		
 		$matric_awarded_date=$_POST["matric_awarded_date"];
 		
 		$fa_complition_date=$_POST["fa_complition_date"];
 		
 		$fa_awarded_date=$_POST["fa_awarded_date"];
 		
 		$ba_complition_date=$_POST["ba_complition_date"];
 		
 		$ba_awarded_date=$_POST["ba_awarded_date"];

 		$password=$_POST['password'];

 		$role=$_POST['role'];

 		

// *****************************************Images upload code starts here********************************************************** 
		$profile_image = $_FILES['profile_image']['name'];$tmp_name=$_FILES['profile_image']['tmp_name'];$path = "images/".$profile_image;move_uploaded_file($tmp_name, $path);

		$matric_certificate = $_FILES['matric_certificate']['name'];$tmp_name=$_FILES['matric_certificate']['tmp_name'];$path = "images/".$matric_certificate;move_uploaded_file($tmp_name, $path);

		$fa_certificate = $_FILES['fa_certificate']['name'];$tmp_name=$_FILES['fa_certificate']['tmp_name'];$path = "images/".$fa_certificate;move_uploaded_file($tmp_name, $path);

		$ba_certificate = $_FILES['ba_certificate']['name'];$tmp_name=$_FILES['ba_certificate']['tmp_name'];$path = "images/".$ba_certificate;move_uploaded_file($tmp_name, $path);


// *****************************************Images upload code end here********************************************************** 

 		$query="Insert into admission_info(first_name,middle_name,last_name,father_name,email,mobile_no,course_code,session,profile_image,prospectus_issued,prospectus_amount,form_b,applicant_status,application_status,cnic,dob,gender,permanent_address,current_address,place_of_birth,matric_complition_date,matric_awarded_date,matric_certificate,fa_complition_date,fa_awarded_date,fa_certificate,ba_complition_date,ba_awarded_date,ba_certificate)values('$first_name','$middle_name','$last_name','$father_name','$email','$mobile_no','$course_code','$session','$profile_image','$prospectus_issued','$prospectus_amount','$form_b','$applicant_status','$application_status','$cnic','$dob','$gender','$permanent_address','$current_address','$place_of_birth','$matric_complition_date','$matric_awarded_date','$matric_certificate','$fa_complition_date','$fa_awarded_date','$fa_certificate','$ba_complition_date','$ba_awarded_date','$ba_certificate')";
 		// print($query);
		
		$run=mysqli_query($con, $query);
		$roll_no = mysqli_insert_id($con);
 		if ($run) {
			unset($_SESSION['isValidOtp']);
			unset($_SESSION['entryId']);
			 $applied = true;
			 $formId = mysqli_insert_id($con);


			$formnumber = $formId;
			$applicantName = $first_name." ".$middle_name." ".$last_name;

			$mail = new PHPMailer(true);

			$usermailer ='admin@amandeepbettiah.in';
			$subject = 'Form Submitted Successfully';

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
    
	
    // $mail->Body    = 'Dear '.$applicantName.'<br>Online Addmission Form Submitted Successfully <br> Your Admission Form Number :'.$formnumber;
    $mail->Body  ="Dear ".$applicantName.",<br><br>Thank you for your interest in Abhimanyu Super-40. We want to let you know that we have received your application and we are delighted that you would consider joining our institute.<br>".
	"We will review your application and will be in touch soon.<br>".
	"<b>Your Admission Form Number is: ".$formnumber."</b><br><br>".
	"Thanks & Regards<br>".
	"Abhimanyu Super-40";
	$mail->AltBody =  'Dear '.$applicantName.' \n Online Addmission Form Submitted Successfully \n Your Admission Form Number : '.$formnumber;


    $mail->send();
	$email_message = 'Check your Inbox!';

} catch (Exception $e) {
    $email_message = 'Error Occured Mail Not Sent. Please Note The Form Number.';
 
}

 		}
 		else {
 			echo "Your Data has not been submitted 1";
 		}
 	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Registration form</title>
</head>
<body>
	<?php include('common/header.php');  
	if(!$applied){
		?>
	<section>
	<div class="container-fluid mt-4">
		<div class="row pt-2">
			<div class="col-xl-12 col-lg-12 col-md-12 w-100">
				<div class="bg-info text-center">
					<div class="table-one flex-wrap flex-md-no-wrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
						<h4>Online Addmission Form</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="row m-3">
			<div class="col-md-12">
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-4 my-2">
							<div class="form-group">
								<label for="exampleInputEmail1">Applicant First Name:*</label>
								<input type="text" name="first_name" class="form-control" value="<?php echo $fistName ?>" readonly required>
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Applicant Middle Name:</label>
								<input type="text" name="middle_name" value="<?php echo $middleName  ?>" readonly class="form-control">
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1" required>Applicant Last Name:*</label>
								<input type="text" name="last_name" value= "<?php echo $lastName ?>" readonly class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputEmail1">Father Name:*</label>
								<input type="text" name="father_name" class="form-control" required>
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Applicant Email:*</label>
								<input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value= "<?php echo $applicantEmail    ?>" readonly required>
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Mobile No:*</label>
								<input type="number" name="mobile_no" class="form-control"  value= "<?php echo $applicantMob   ?>" readonly required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputEmail1">Course which you want?: </label>
								<select required class="browser-default form-select" name="course_code">
									<option selected disabled value="">Select Course</option>
									<?php
										$query="select course_code from courses";
										$run=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($run)) {
											echo	"<option value=".$row['course_code'].">".$row['course_code']."</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Select Session:</label>
								<select required class="browser-default form-select" name="session">
									<option selected disabled value="" >Select Session</option>
									<?php
										$query="select session from sessions";
										$run=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($run)) {
											echo	"<option value=".$row['session'].">".$row['session']."</option>";
										}
									?>
								</select>

							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Your Profile Image:</label>
								<input type="file" name="profile_image" placeholder="Student Age" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- <div class="col-md-4  my-2">
							<div class="form-group mt-md-4>
								<label for="exampleInputEmail1">Prospectus Issude: </label>
								<select class="browser-default custom-select" name="prospectus_issued">
									<option>Select Option</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div> -->
						<!-- <div class="col-md-4  my-2">
							<div class="form-group mt-md-4">
								<label for="exampleInputPassword1">Prospectus Amount Recvd:</label>
								<select class="browser-default custom-select" name="prospectus_amount">
									<option>Select Option</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div> -->
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">PAN NO. :</label>
								<input type="text" name="form_b" class="form-control">
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Aadhaar No:</label>
								<input type="text" name="cnic" data-inputmask="'mask': '9999-9999-9999'" placeholder="XXXX-XXXX-XXXX" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- <div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputEmail1">Applicant Status: </label>
								<select class="browser-default custom-select" name="applicant_status">
									<option>Select Option</option>
									<option value="Admitted">Admitted</option>
									<option value="Not Admitted">Not Admitted</option>
								</select>
							</div>
						</div> -->
						<!-- <div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Application Status:</label>
								<select class="browser-default custom-select" name="application_status" readonly>
									<option>Select Option </option>
									<option value="Approved">Approved</option>
									<option value="Not Approved">Not Approved</option>
								</select>
							</div>
						</div> -->
					
					</div>
					<div class="row">
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputEmail1">Date of Birth: </label>
								<input type="date" name="dob" class="form-control" required>
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Other Phone:</label>
								<input type="number" name="other_phone" class="form-control">
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Gender:</label>
								<select class="browser-default form-select" name="gender" required>
									<option selected disabled value="">Select Gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputEmail1">Permanent Address: </label>
								<input type="text" name="permanent_address" class="form-control" required>
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Current Address:</label>
								<input type="text" name="current_address" class="form-control" required>
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Place of Birth:</label>
								<input type="text" name="place_of_birth" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputEmail1">Matric Completion Date: </label>
								<input type="date" name="matric_complition_date" class="form-control">
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Matric Awarded  Date:</label>
								<input type="date" name="matric_awarded_date" class="form-control">
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Upload Matric Certificate:</label>
								<input type="file" name="matric_certificate" class="form-control" value="there is no image">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputEmail1">High School completion Date: </label>
								<input type="date" name="fa_complition_date" class="form-control">
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">High School Awarded Date:</label>
								<input type="date" name="fa_awarded_date" class="form-control">
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Upload High School Certificate:</label>
								<input type="file" name="fa_certificate" class="form-control" value="there is no image" >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputEmail1">BA completion Date: </label>
								<input type="date" name="ba_complition_date" class="form-control" value="0">
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">BA Awarded Date:</label>
								<input type="date" name="ba_awarded_date" class="form-control">
							</div>
						</div>
						<div class="col-md-4  my-2">
							<div class="form-group">
								<label for="exampleInputPassword1">Upload BA Certificate:</label>
								<input type="file" value="" name="ba_certificate" class="form-control" >
							</div>
						</div>
					</div>
					<!-- _________________________________________________________________________________
														Hidden Values are here
					_________________________________________________________________________________ -->
					<div>
						<input type="hidden" name="password" value="<?php $requesttime = date('Y-m-d h:i:s'); 
						 echo substr(str_shuffle(md5($requesttime)), 0, 8); ?>">
						<input type="hidden" name="role" value="Student">
					</div>
					<!-- _________________________________________________________________________________
														Hidden Values are end here
					_________________________________________________________________________________ -->
					<div class="modal-footer">
						<div class="my-4 text-center">
						<input type="submit" class="btn btn-primary px-5" name="btn_save" value="Submit">
						</div>
						
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 w-100 p-5">
				<h4 class="bg-secondary p-3 text-center text-white">Undertaking</h4>
				<h5>Candidates awaiting results are required to sign the following undertaking:</h5>
				<p class="tet-justify">
				I solemnly declare that I have submitted the application with correct details.  I pledge to abide by the Rules and Regulations of the Institution
				</p>
			</div>
		</div>	
	</div>
									</section>
	<?php
	}
	else{ ?>
	<section>
		<div class="mt-4">
		

	
		<div class="container my-8">
		<div class="row mt-4">
			<div class="col-xl-12 col-lg-12 col-md-12 w-100">
				<div class="bg-info text-center">
					<div class="table-one flex-wrap flex-md-no-wrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
						<h4>Online Addmission Form Submitted Successfully</h4>
						<h5> Your Form Id : <?php  echo  $formId ?></h5>
						<h6> <?php  echo  $email_message ?> </h6>
					</div>
				</div>
			</div>
		</div>
		</div>
		</div>
		</section>
	<?php	

	} ?>
	 <script src="node_modules/jquery/dist/jquery-3.6.0.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<?php include('common/footer.php') ?>
</body>
</html>