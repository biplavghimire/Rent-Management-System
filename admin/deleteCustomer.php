<?php 
	include 'db_connect.php';
	$uid = $_GET['uid'];

	$delete_user_customer = "delete  from users where uid = $uid";
	if(mysqli_query($conn, $delete_user_customer)){
		header('location:customer.php');
	}else{

	}



?>