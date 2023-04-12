<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	$selectedId = '';
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
		$_SESSION["LoginStudent"]="";
	?>
<!---------------- Session Ends form here ------------------------>




<!--*********************** PHP code end from here for data insertion into database ******************************* -->
 
<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Register Student</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/admin-sidebar.php') ?>
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<div class="d-flex">
						<h4 class="mr-5">Forms Management System </h4>
					
					</div>
				</div>
				
				<div class="row w-100">
					<div class="col-md-12 ml-2">
						<section class="mt-3">
							<div class="row">
								<div class="col-md-6">
									<form action="" method="post">
										<div class="form-group">
											<label for="exampleInputPassword1"><h5>Search:</h5></label>
											<div class="d-flex">
												<input type="text" id="search" name="search" id="search" class="form form-control" placeholder="Enter I'd">
												<input class="btn btn-primary px-4 ml-4" type="button" name="btnSearch" onclick="searchform()" value="Search">
											</div>
										</div>
									</form>
								</div>	
								
							<table class="w-100 table-elements mb-5 table-three-tr text-center" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th>Form No</th>
									<th>Student Name</th>
									<th>Current Address</th>
									<th>Session</th>
									<th>Course ID</th>
									<th>Admission</th>
									
									<th>Applicant Status</th>
									<th>Profile</th>
									<th colspan="1">Operations</th>
								</tr>
								<?php 
								$query="select first_name,middle_name,admission_date,last_name,current_address,session,roll_no,form_b,applicant_status ,profile_image,course_code from admission_info ORDER BY roll_no DESC";
								$run=mysqli_query($con,$query);
								while($row=mysqli_fetch_array($run)) {?>
									<tr>
										<td><?php echo $row["roll_no"] ?></td>
										<td><?php echo $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"] ?></td>
										<td><?php echo $row["current_address"] ?></td>
										<td><?php echo $row["session"] ?></td>
										<td><?php echo $row["course_code"] ?></td>
										<!-- date_format($date,"Y/m/d H:i:s"); -->
										<td><?php echo date("Y-M-d",strtotime($row["admission_date"])); ?></td>
										<td><?php echo $row["applicant_status"] ?></td>
										<td><?php  $profile_image= $row["profile_image"] ?>
										<img height='50px' width='50px' src=<?php echo "../images/".rawurlencode($profile_image);  ?> >
										</td>
										<td width='170'> 
											<?php 
												 if($row["applicant_status"]  == 'Admitted'){
													echo "<a class='btn btn-danger' href=display-student.php?roll_no=".$row['roll_no']."&tbname=admission_info target='_blank'>View</a> ";

												 }
												 else{
													echo "<a class='btn btn-primary' href=display-student-edit.php?roll_no=".$row['roll_no']." target='_blank'>Edit</a> 
													<a class='btn btn-danger' href=display-student.php?roll_no=".$row['roll_no']."&tbname=admission_info target='_blank'>View</a> ";
					
												 }
											
											?>
										</td>
									</tr>
								<?php }
								?>
							</table>				
						</section>
					</div>
				</div>	 
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
		<script>
			function searchform(){
				let formNum = document.getElementById('search').value;
				window.location.href = 'display-student-edit.php?roll_no='+formNum;
			}

		</script>

		<?php include('../common/common-footer.php') ?>
	</body>
</html>