<?php 

	include 'db_connect.php';
	session_start();
$un=$_SESSION['un'];
if(!$un){
	header(header:"location:index.php");
}
	$hid = $_GET['hid'];
	$status = 1;
	$update_user_customer = "update houseinfo set status = '$status' where h_id = $hid";
	if(mysqli_query($conn, $update_user_customer)){
		header('location:house.php');
	}else{

	}

 ?>