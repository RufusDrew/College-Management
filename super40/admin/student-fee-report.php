<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
        $studentName ='';
		$classFeeReport = false;
	?>
<!---------------- Session Ends form here ------------------------>

<?php  
	if (isset($_POST['btn_save2'])) {
		$course_code=$_POST['course_code'];
		$semester=$_POST['semester'];
		$yearData=$_POST['ryear'];
		$classFeeReport  = true;
		$queryFeeStructure = "SELECT fid,fee_amount FROM `feestructure` WHERE course_code = '$course_code' AND semester = '$semester' AND active = 1";
	    $feestructure = mysqli_query($con,$queryFeeStructure);
	    if(mysqli_num_rows($feestructure)){
	    $feeDetail = mysqli_fetch_assoc($feestructure)['fee_amount'];
         }
		$query = "SELECT stinfo.roll_no, stinfo.first_name, stinfo.middle_name, stinfo.last_name,stinfo.course_code,stinfo.semester,stinfo.session, stfee.amount,stfee.status, stfee.feecode,feest.fee_amount totalfee ,feest.semester FROM student_info stinfo LEFT JOIN student_fee stfee ON stinfo.roll_no = stfee.roll_no LEFT JOIN feestructure feest ON stfee.feecode = feest.fid WHERE stinfo.course_code = '$course_code' AND stinfo.semester = $semester"; 
		$run = mysqli_query($con,$query);
		$dataArray = [];
		// $paidArray = [];
		//$upaidArray = [];
		
		if( $run && mysqli_num_rows($run) > 0){
			while ($row=mysqli_fetch_array($run)) {
				$slimit = explode('-',$row['session']);
				if($slimit[0]<=$yearData && $slimit[1]>=$yearData){
					// if($row['status'] == 'Paid'){
						array_push($dataArray,$row);
					// }
					// else{
						// array_push($upaidArray,$row);
					// }
					
				}
		
    }
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
					<h4>Student Fee Management Report </h4>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form action="" method="post">
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
                    <!-- report modal -->
                    <div class="col-md-12 pt-5 mb-2">
									<!-- Large modal -->
									<button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target=".bd-example-modal-lg1">Report</button>
                    <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header bg-info text-white">
														<h4 class="modal-title text-center">Course & Semester Wise Report</h4>
													</div>
													<div class="modal-body">
														<form action="" method="POST" enctype="multipart/form-data">
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
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputPassword1" required>Enter Semester:*</label>
																		<input type="number" name="semester" class="form-control">
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="exampleInputPassword1">Enter Year:*</label>
																		<input type="number" name="ryear" class="form-control" value="<?php echo date("Y")?>">
																	</div>
																</div>
																
															</div>
															<div class="modal-footer">
																<input type="submit" class="btn btn-primary" name="btn_save2" value="Submit">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															</div>
														</form>
													</div>
												</div>
										</div>
									</div>
                    </div>
                    <!-- --- -->
				</div>
				<div class="row">
					<?php if($classFeeReport){?>
					<div class="col-md-12 ml-2">
						<section class="border mt-3">
							<table class="w-100 table-elements table-three-tr" cellpadding="3">
                            <tr class="pt-5 table-three text-white" style="height: 32px;">
											<th>Roll No.</th>
                                            <th> Name </th>
                                            <th> Course Code </th>
                                            <th> Semester/Month </th>
                                            <th> Session </th>
											<th>Total Amt (Rs.)</th>
											<th>Amt Paid (Rs.)</th>
											<th>Status</th>
										</tr>
								<?php  
							
									foreach ( $dataArray as $row) {
                                        $studentName = $row['first_name']." ".$row["middle_name"]." ".$row['last_name'];
									?>
                                    <tr class="text-center">
										
												<td><?php echo $row['roll_no'] ?></td>
                                                <td><?php echo $studentName ?></td>
												<td><?php echo $row['course_code'] ?></td>
												<td><?php echo $row['semester'] ?></td>
												<td><?php echo $row['session'] ?></td>
												<td><?php echo   $feeDetail ?></td>
												<td><?php echo $row['amount'] ?></td>
												<td><?php echo $row['status'] ?></td>
											</tr>
								<?php		
									}
								?>
							</table>				
						</section>
					</div>
				</div>
				<?php }?>
				<?php if(!$classFeeReport){?>
					<div class="col-md-12 ml-2">
						<section class="border mt-3">
							<table class="w-100 table-elements table-three-tr" cellpadding="3">
                            <tr class="pt-5 table-three text-white" style="height: 32px;">
											<th>Voucher No.</th>
											<th>Roll No.</th>
                                            <th> Name </th>
											<th>Amt (Rs.)</th>
											<th>Posting Date</th>
											<th>Status</th>
										</tr>
								<?php  
								$i=1;
									if (isset($_POST['submit'])) {
										$roll_no=$_POST['roll_no'];

                                    $query="select * from student_fee inner join student_info on student_fee.roll_no=student_info.roll_no where student_fee.roll_no='$roll_no'";
                                  
                                    $run=mysqli_query($con,$query);
									if( $run && mysqli_num_rows($run) > 0){
									while ($row=mysqli_fetch_array($run)) {
                                      
									?>
                                    <tr class="text-center">
												<td><?php echo $row['fee_voucher'] ?></td>
												<td><?php echo $row['roll_no'] ?></td>
                                                <td><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?></td>
												<td><?php echo $row['amount'] ?></td>
												<td><?php echo $row['posting_date'] ?></td>
												<td><?php echo $row['status'] ?></td>
											</tr>
								<?php		
									}
								}
								else{
									echo "<h5 class='text-danger text-center'>Invalid Roll No. </h5>";
								}
									}
								?>
							</table>				
						</section>
					</div>
				</div>
				<?php }?>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
		<?php include('../common/common-footer.php') ?>
	</body>
</html>

