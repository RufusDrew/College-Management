<!---------------- Session starts form here ----------------------->
<?php  
	session_start();

	
	if ($_SESSION["LoginAdmin"])
	{
		$roll_no=$_GET['roll_no'] ?? $_SESSION['LoginStudent'];
	}
	else if(!$_SESSION["LoginAdmin"] && $_SESSION['LoginStudent']){
		$roll_no=$_SESSION['LoginStudent'];
	}
	else{ ?>
		<script> alert("Your Are Not Authorize Person For This link");</script>
	<?php
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
if (isset($_POST['btn_save'])) {

    $applicant_form_num = $_POST['formnum'];
   $roll_no= $_POST["roll_no"];

    $first_name=$_POST["first_name"];

    $middle_name=$_POST["middle_name"];
    
    $last_name=$_POST["last_name"];
    
    $father_name=$_POST["father_name"];
    
    $email=$_POST["email"];
    
    $mobile_no=$_POST["mobile_no"];

    $course_code=$_POST['course_code'];

    $session=$_POST['session'];
    
    $prospectus_issued=$_POST["prospectus_issued"];
    
    $prospectus_amount=$_POST["prospectus_amount"];
    
    $form_b=$_POST["form_b"];
    
    $applicant_status=$_POST["applicant_status"];
    
    $application_status=$_POST["application_status"];
    
    $cnic=$_POST["cnic"];
    
    $dob=$_POST["dob"];
             
    $gender=$_POST["gender"];
    
   $permanent_address=$_POST["permanent_address"];
    
    $current_address=$_POST["current_address"];
    
    $place_of_birth=$_POST["place_of_birth"];
    
    $matric_complition_date=$_POST["matric_complition_date"];
    
    $matric_awarded_date=$_POST["matric_awarded_date"];
    
    $fa_complition_date=$_POST["fa_complition_date"];
    
    $fa_awarded_date=$_POST["fa_awarded_date"];
    
    $ba_complition_date=$_POST["ba_complition_date"];
    
    $ba_awarded_date=$_POST["ba_awarded_date"];

    $password=$_POST['password'];

    $role=$_POST['role'];

    

// *****************************************Images upload code starts here********************************************************** 
   $profile_image = $_FILES['profile_image']['name'];
	if(strlen( $profile_image)>0){
		$tmp_name=$_FILES['profile_image']['tmp_name'];$path = "images/".$profile_image;move_uploaded_file($tmp_name, $path);
	}
	else{
		$profile_image = $_POST["old_profile_image"];
	}
  
//    print_r($profile_image);
//    echo '<br>';
//    print_r($tmp_name);
//    echo '<br>';
//    print_r($path);
//    exit();

   $matric_certificate = $_FILES['matric_certificate']['name'];
   if(strlen($matric_certificate)>0){
   $tmp_name=$_FILES['matric_certificate']['tmp_name'];$path = "images/".$matric_certificate;move_uploaded_file($tmp_name, $path);
   }
   else{
	$matric_certificate = $_POST["old_matric_certificate"];
   }

   $fa_certificate = $_FILES['fa_certificate']['name'];
 	if(strlen($fa_certificate)>0){  
   $tmp_name=$_FILES['fa_certificate']['tmp_name'];$path = "images/".$fa_certificate;move_uploaded_file($tmp_name, $path);
	}
	else{
		$fa_certificate = $_POST["old_fa_certificate"];
	}

   	$ba_certificate = $_FILES['ba_certificate']['name'];
	if(strlen(	$ba_certificate)>0){
	$tmp_name=$_FILES['ba_certificate']['tmp_name'];$path = "images/".$ba_certificate;move_uploaded_file($tmp_name, $path);
	}else{
		$ba_certificate = $_POST["old_ba_certificate"];
	}

// *****************************************Images upload code end here********************************************************** 
	if($applicant_status == "Admitted"){
    $query="Insert into student_info(roll_no,first_name,middle_name,last_name,father_name,email,mobile_no,course_code,session,profile_image,prospectus_issued,prospectus_amount,form_b,applicant_status,application_status,cnic,dob,gender,permanent_address,current_address,place_of_birth,matric_complition_date,matric_awarded_date,matric_certificate,fa_complition_date,fa_awarded_date,fa_certificate,ba_complition_date,ba_awarded_date,ba_certificate)values('$roll_no','$first_name','$middle_name','$last_name','$father_name','$email','$mobile_no','$course_code','$session','$profile_image','$prospectus_issued','$prospectus_amount','$form_b','$applicant_status','$application_status','$cnic','$dob','$gender','$permanent_address','$current_address','$place_of_birth','$matric_complition_date','$matric_awarded_date','$matric_certificate','$fa_complition_date','$fa_awarded_date','$fa_certificate','$ba_complition_date','$ba_awarded_date','$ba_certificate')";
    $run=mysqli_query($con, $query);
	}
	$run = true;
    if ($run) {
        $query3 = "UPDATE admission_info
        SET 	applicant_status= '$applicant_status' , application_status= '$application_status'
        WHERE 	roll_no = $applicant_form_num ";
        // print($query3);
        $run3=mysqli_query($con, $query3);

		if($applicant_status == "Admitted"){
        $query2="insert into login(user_id,Password,Role)values('$roll_no','$password','$role')";
        $run2=mysqli_query($con, $query2);
		}
		$run2 = true;
        if ($run2) {
			$applicantName = $first_name." ".$middle_name." ".$last_name;
			$applicant_status=$_POST["applicant_status"];
			$application_status=$_POST["application_status"];

			$mail = new PHPMailer(true);

			$usermailer ='admin@amandeepbettiah.in';
			$subject = 'Admission Form Status';

try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                   //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $usermailer;                     		//SMTP username
    $mail->Password   = 'Admin123@';                            //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $mail->setFrom($usermailer, 'ABHIMANYU SUPER-40');
    $mail->addAddress($email);     //Add a recipient
    $mail->addReplyTo($usermailer, 'Information');


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    
    //$mail->Body    = 'Dear '.$applicantName.'<br> Your Form Id :'.$applicant_form_num.' Status Update!. <br> Application Status : '.$application_status.'<br> Admission Status : '.$applicant_status.'<br>Roll No. : '. $roll_no;
    if($applicant_status == 'Admitted'){
	$mail->Body = "Dear ".$applicantName.
	",<br>Thank you for your interest in Abhimanyu Super-40. We want to inform you that the status of your application form has been updated.<br>".
	"Please be informed that your application Id ". $applicant_form_num."<b> status ".$applicant_status."</b>.<br>".
	"<b>Your Roll Number is : ".$roll_no."</b><br><br>".
	"Thanks & Regards<br>".
	"Abhimanyu Super-40";
	}
	else{
		$mail->Body = "Dear ".$applicantName.
	",<br>Thank you for your interest in Abhimanyu Super-40. We want to inform you that the status of your application form has been updated.<br>".
	"Please be informed that your application Id ". $applicant_form_num."<b> status ".$applicant_status."</b><br>".
	"Thanks & Regards<br>".
	"Abhimanyu Super-40";
	}
	
	
	$mail->AltBody =  'Dear '.$applicantName.'\n Your Form Id :'.$applicant_form_num.' Status Update!. \n Application Status : '.$application_status.'\n Admission Status : '.$applicant_status.'\n Roll No. : '. $roll_no;


    $mail->send();
	$email_message = 'Check your Inbox!';

} catch (Exception $e) {
    $email_message = 'Error Occured Mail Not Sent. Please Note The Form Number.';
 
}
if($applicant_status == "Admitted"){
           header("Location:student.php");

}
else{
	header("Location:studentapplied.php");
}
        }
        else {
            echo "Your Data has not been submitted into login";
        }
    }
    else {
        echo "Your Data has not been submitted";
    }
   
}
?>



<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Student Information</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
	<?php
    $query="select MAX(roll_no) maxroll from student_info";
    $nextRollNum = mysqli_fetch_assoc(mysqli_query($con,$query))['maxroll'] + 1;
   
	$query="select * from admission_info where roll_no='$roll_no'";
	$run=mysqli_query($con,$query);
    
    if($run && mysqli_num_rows($run) > 0){
	while ($row=mysqli_fetch_array($run)) {
		
		?>
		<div class="container  mt-1 border border-secondary mb-1">
  				    <!-- Large modal -->
					<div class="modal show  bd-example-modal-lg" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					   <div class="modal-dialog modal-lg">
						    <div class="modal-content">
							    <div class="modal-header bg-info text-white">
							        <h4 class="modal-title text-center">Add New Student</h4>
						        </div>
							    <div class="modal-body">
							        <form action="display-student-edit.php" method="POST" enctype="multipart/form-data">

										<div class="row mt-3">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Applicant First Name:*</label>
											        <input type="text" name="first_name" class="form-control"   value="<?php echo $row["first_name"] ?>" required>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Applicant Middle Name:</label>
												    <input type="text" name="middle_name"   value="<?php echo $row["middle_name"] ?>" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1" required>Applicant Last Name:*</label>
												    <input type="text" name="last_name"   value="<?php echo $row["last_name"] ?>" class="form-control">
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Father Name:*</label>
											        <input type="text" name="father_name"   value="<?php echo $row["father_name"] ?>" class="form-control" required>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Student Roll No:</label>
												    <input type="text" name="roll_no"   value="<?php echo $nextRollNum ?>" class="form-control" readonly>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Applicant Email:*</label>
												    <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"   value="<?php echo $row["email"] ?>" required>
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Course which you want?: </label>
											        <select class="browser-default custom-select" name="course_code">
													    <option >Select Course</option>
													    <?php
															$query="select course_code from courses";
															$run=mysqli_query($con,$query);
															while($crow=mysqli_fetch_array($run)) {
                                                                if($row["course_code"] == $crow['course_code'] ){
                                                                    echo	"<option value=".$crow['course_code']." selected >".$crow['course_code']."</option>";
                                                                }else{
                                                                    echo	"<option value=".$crow['course_code'].">".$crow['course_code']."</option>";
                                                                }
															 
															}
														?>
													</select>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Select Session:</label>
												    <select class="browser-default custom-select" name="session">
													    <option >Select Session</option>
													    <?php
															$query="select session from sessions";
															$run=mysqli_query($con,$query);
															while($srow=mysqli_fetch_array($run)) {
                                                                if($row['session'] == $srow['session'] ){
                                                                    echo	"<option value=".$srow['session']." selected >".$srow['session']."</option>";
                                                                }
                                                                else{
                                                                    echo	"<option value=".$srow['session'].">".$srow['session']."</option>";
                                                                }
															
															}
														?>
													</select>

											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Your Profile Image:</label>
												    <input type="file" name="profile_image" placeholder="Student Age" class="form-control" >
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Prospectus Issude: </label>
											        <select class="browser-default custom-select" name="prospectus_issued">
													  <option>Select Option</option>
                                                      <?php  if($row['prospectus_issued'] =="Yes"){
                                                        echo '<option value="Yes" selected>Yes</option>';
                                                      }
                                                      else{
                                                        echo '<option value="Yes">Yes</option>';
                                                      }
                                                        ?>
                                                      <?php 
                                                       if($row['prospectus_issued'] =="No"){
                                                        echo '<option value="No" selcted >No</option>';

                                                       }else{

                                                        echo '<option value="No">No</option>';
                                                       }
                                                      
                                                      ?>
													 
													  
													</select>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Prospectus Amount Recvd:</label>
												    <select class="browser-default custom-select" name="prospectus_amount">
													  <option>Select Option</option>
                                                      <?php  if($row['prospectus_amount'] =="Yes"){
                                                        echo '<option value="Yes" selected>Yes</option>';
                                                      }
                                                      else{
                                                        echo '<option value="Yes">Yes</option>';
                                                      }
                                                        ?>
                                                      <?php 
                                                       if($row['prospectus_amount'] =="No"){
                                                        echo '<option value="No" selcted >No</option>';

                                                       }else{

                                                        echo '<option value="No">No</option>';
                                                       }
                                                      
                                                      ?>
													</select>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">PAN NO. :</label>
												    <input type="text" name="form_b" class="form-control"  value="<?php echo $row["form_b"]?>">
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Applicant Status: </label>
											        <select class="browser-default custom-select" name="applicant_status">
													  <option>Select Option</option>
													  <option value="Admitted">Admitted</option>
													  <option value="Not Admitted">Not Admitted</option>
													</select>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Application Status:</label>
												    <select class="browser-default custom-select" name="application_status">
													  <option>Select Option</option>
													  <option value="Approved">Approved</option>
													  <option value="Not Approved">Not Approved</option>
													</select>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Aadhaar No:</label>
												    <input type="text" name="cnic" data-inputmask="'mask': '9999-9999-9999'" placeholder="XXXX-XXXX-XXXX" class="form-control" value="<?php echo $row["cnic"]?>">
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Date of Birth: </label>
											        <input type="date" name="dob" class="form-control" value="<?php echo $row["dob"]?>">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Mobile No:*</label>
												    <input type="number" name="mobile_no" class="form-control" value="<?php echo $row["mobile_no"]?>" required>
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Gender:</label>
												    <select class="browser-default custom-select" name="gender">
													  <option>Select Gender</option>
                                                      <?php  if($row['gender'] =="Male"){
                                                        echo ' <option value="Male" selected>Male</option>';
                                                      }
                                                      else{
                                                        echo ' <option value="Male">Male</option>';
                                                      }
                                                        ?>
                                                      <?php 
                                                       if($row['gender'] == "Female"){
                                                        echo ' <option value="Female" selected>Female</option>';

                                                       }else{

                                                        echo  '<option value="Female">Female</option>';
                                                       }
                                                      
                                                      ?>

													 
													 
													</select>
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Permanent Address: </label>
											        <input type="text" name="permanent_address" value="<?php echo $row["permanent_address"]?>" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Current Address:</label>
												    <input type="text" name="current_address" value="<?php echo $row["current_address"]?>" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Place of Birth:</label>
												    <input type="text" name="place_of_birth" value="<?php echo $row["place_of_birth"]?>" class="form-control">
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">Matric Completion Date: </label>
											        <input type="date" name="matric_complition_date" value="<?php echo $row["matric_complition_date"]?>" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Matric Awarded Date:</label>
												    <input type="date" name="matric_awarded_date" value="<?php echo $row["matric_awarded_date"]?>"  class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Upload Matric Certificate:</label>
												    <input type="file" name="matric_certificate" class="form-control" value="there is no image">
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">High School completion Date: </label>
											        <input type="date" name="fa_complition_date" value="<?php echo $row["fa_complition_date"]?>" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">High School Awarded Date:</label>
												    <input type="date" name="fa_awarded_date" value="<?php echo $row["fa_awarded_date"]?>" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Upload High School Certificate:</label>
												    <input type="file" name="fa_certificate"  class="form-control" value="there is no image" >
											    </div>
											</div>
								  		</div>
								  		<div class="row">
											<div class="col-md-4">
											    <div class="form-group">
											        <label for="exampleInputEmail1">BA completion Date: </label>
											        <input type="date" name="ba_complition_date" value="<?php echo $row["ba_complition_date"]?>" class="form-control" value="0">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">BA Awarded Date:</label>
												    <input type="date" name="ba_awarded_date" value="<?php echo $row["ba_awarded_date"]?>" class="form-control">
											    </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												    <label for="exampleInputPassword1">Upload BA Certificate:</label>
												    <input type="file" value="" name="ba_certificate"  class="form-control" >
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
											<input type="hidden" name="formnum" value="<?php  echo $roll_no ?>">
											<input type="hidden" name="old_profile_image" value="<?php  echo $row["profile_image"] ?>">
											<input type="hidden" name="old_ba_certificate" value="<?php echo $row["ba_certificate"]?>">
											<input type="hidden" name="old_fa_certificate" value="<?php echo $row["fa_certificate"]?>">
											<input type="hidden" name="old_matric_certificate" value="<?php echo $row["matric_certificate"]?>">
                                            
								  		</div>
								  		<!-- _________________________________________________________________________________
								  											Hidden Values are end here
								  		_________________________________________________________________________________ -->
								  		<div class="modal-footer">
						   		            <input type="submit" class="btn btn-primary" name="btn_save">
		      								<button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
									    </div>
									</form>
						        </div>
						    </div>
					   </div>
					</div>
				</div>
		
	<?php }
    }
    else{

    ?>

        <div class="container  mt-1 border border-secondary mb-1">
            <div class="text-danger text-center"  >
            Invalid Form Number
            </div>
            
							
        </div>

    <?php }?>
    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
        (function () {
            $('.bd-example-modal-lg').modal('show');
    })();


	function closeModal(){
		window.location.href = 'studentapplied.php';
		$('.bd-example-modal-lg').modal('hide');
		
	}
    
    </script>
	<?php include('../common/common-footer.php') ?>
</body>
</html>
