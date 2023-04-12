<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
		$success_message = "";
		$error_message = "";
		$message = "";
	?>
<!---------------- Session Ends form here ------------------------>

<?php
if (isset($_POST['sub'])) {
 	$roll_no=$_POST['roll_no'];
 	$amount=$_POST['amount'];
 	$status=$_POST['status'];
	$semval = $_POST['semvalue'];
	$coursecode = $_POST['course_code'];
	$queryFeeStructure = "SELECT fid,fee_amount FROM `feestructure` WHERE course_code = '$coursecode' AND semester = '$semval' AND active = 1";
	$feestructure = mysqli_query($con,$queryFeeStructure);
	if(mysqli_num_rows($feestructure)){
	$feeDetail = mysqli_fetch_assoc($feestructure);
	$feeId = $feeDetail['fid'];
	if($feeDetail['fee_amount'] == $amount){
	$que="insert into student_fee(roll_no,amount,status,feecode)values('$roll_no','$amount','$status',$feeId)";
	//SELECT YEAR(posting_date) FROM `student_fee` 
	$run=mysqli_query($con,$que);
	if ($run) {
		$success_message = "Fee Updated Successfully";
		
		}	
		else{
			$error_message = "Fee Update Operation Failed";
			
		}
	}
	else{
		$error_message = "Fee Amount is Less then Required, Amount is ".$feeDetail['fee_amount'].". Operation Falied";
	}

	}else{
		$error_message = "Invalid Fee Structure, Operation Falied";
	}
	}

?>

<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Student Fee</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="bar-margin text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4>Student Fee Management System </h4>
				</div>
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
						<form action="student-fee.php" method="post">
							<div class="row mt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label>Enter Roll No:</label>
										<div class="d-flex">
											<input type="text" class="form-control" name="roll_no" placeholder="Enter Roll No">
											<input type="submit" name="submit" class="btn btn-primary px-4 ml-4" value="Press">
										</div>
									</div>
								</div>
								<div class="col-md-6 align-items-baseline pt-4">
								</div>
							</div>	
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ml-2">
						<section class="border mt-3">
							<table class="w-100 table-elements table-three-tr" cellpadding="3">
								<tr class="table-tr-head table-three text-white">
									<th>Sr No.</th>
									<th>Roll No.</th>
									<th>Student Name</th>
									<th>Program</th>
									<th>Semester/Month</th>
									<th>Amount (Rs.)</th>
									<th>Status</th>
								</tr>
								<?php  
								$i=1;
									if (isset($_POST['submit'])) {
										$roll_no=$_POST['roll_no'];


										$que="select roll_no,first_name,middle_name,last_name,course_code,semester from student_info where roll_no='$roll_no' ";
									$run=mysqli_query($con,$que);
									if( $run && mysqli_num_rows($run) > 0){
									while ($row=mysqli_fetch_array($run)) {
									?>
										<form action="student-fee.php" method="post">
										<tr>
											<td><?php echo $i++ ?></td>
											<td><?php echo $row['roll_no'] ?></td>
											<input type="hidden" name="roll_no" value=<?php echo $row['roll_no'] ?> >
											<td><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?></td>
											<td><?php echo $row['course_code'] ?></td>
											<td><input type="text" name="semvalue" class="form-control" placeholder="Enter Semester for fee" value="<?php echo $row['semester'] ?>"></td>
											<td><input type="text" name="amount" class="form-control" placeholder="Enter Amount for fee"></td>
											<td>
											<select class="browser-default custom-select" name="status">
												<option value="Due">Due</option>
												<option value="Paid">Paid</option>
											</select>
											</td>
											<input type="hidden" name="course_code" class="form-control" value="<?php echo $row['course_code'] ?>">

										</tr>
										
								<?php		
									}
								}
								else{
									echo "<h5 class='text-danger text-center'>Invalid Roll No. </h5>";
								}
									}
								?>
								<div>
								<input type="submit" name="sub">

								</div>

								</form>
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

