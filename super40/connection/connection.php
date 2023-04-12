<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname="super40";
	$con=mysqli_connect($servername,$username,$password ,$dbname);
	date_default_timezone_set('Asia/Kolkata');
	if(!$con)
	{
		echo "Connection is not Successfully";
	}
?>