<!---------------- Session starts form here ----------------------->
<?php  

	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
		$success_message = '';
		$error_message ='';
		$message = '';
	?>
<!---------------- Session Ends form here ------------------------>

<!-- --------------------------------add courses------------------------------------- -->
<?php  
	if (isset($_POST['sub'])) {
		$course_code=$_POST['course_code'];
		$semester_or_year=$_POST['semester_or_year'];
		$feeamt= $_POST['feeamount'];

		//$query="insert into courses(course_code,course_name,semester_or_year,no_of_year)values('$course_code','$course_name','$semester_or_year','$no_of_year')";
		$query = "INSERT INTO `feestructure` (`course_code`, `semester`, `active`, `fee_amount`) VALUES ('$course_code', $semester_or_year, '1', $feeamt);";
        $run=mysqli_query($con,$query);
		if ($run) {
			$success_message = "Fee Structure Added Successfully";
		}
		else{
			if(str_contains(mysqli_error($con),'Duplicate')){
				$error_message = 'Duplicate Entry Course Code : '.$course_code.' Already Present';
			}
			else{
				$error_message = "Course Add Operation Failed";
			}
			
		}
	}
?>

<!-- --------------------------------End Php------------------------------------- -->


<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Courses</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4>Fee Structure Management</h4>
				</div>

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
				<div class="row">
					<div class="col-md-12">
						<form action="" method="post">
							<div class="row mt-3">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Select Course:*</label>
                                        <select class="browser-default custom-select" name="course_code" required="">
                                            <option >Select Course</option>
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
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Semester Or Years:</label>
										<input type="number" name="semester_or_year" class="form-control" required placeholder="Enter Semester Or Month" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputPassword1">Fee Amount:</label>
										<input type="number" name="feeamount" class="form-control" required  placeholder="Enter Amount" required>
									</div>
								</div>
							</div>
							<div class="row w-100">
								<div class="col-md-12">
									<input type="submit" name="sub" value="Add Fee" class=" btn btn-primary ml-auto">
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ml-2">
						<section class="mt-3">
							<table class="w-100 table-elements mb-5 table-three-tr" cellpadding="3">
								<tr class="table-tr-head table-three text-white">
									<th>Sr.No</th>
									<th>Course Code</th>
									<th>Semester/Month</th>
									<th>Fee Amount</th>
                                    <th>Status</th>
									<th>Action</th>
								</tr>
								<?php
									$sr=1;
									$query="select *  from feestructure ORDER BY createddate DESC";
									$run=mysqli_query($con,$query);
									while($row=mysqli_fetch_array($run)) {
                                        $active_status =$row['active'] ==1? 'Active' : 'Inactive';
									echo	"<tr>";
									echo	"<td>".$sr++."</td>";
									echo	"<td>".$row['course_code']."</td>";
									echo	"<td>".$row['semester']."</td>";
									echo	"<td>".$row['fee_amount']."</td>";
									echo	"<td>".$active_status."</td>";
									echo	"<td width='20'><a class='btn btn-danger' href=delete-function.php?fee_code=".$row['fid'].">Delete</a></td>";
									echo	"</tr>";
									} 
									
								?>
							</table>				
						</section>
					</div>
				</div>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
		<?php include('../common/common-footer.php') ?>
	</body>
</html>
