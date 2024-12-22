<?php 
	include 'db_connect.php';

	$count_users = "SELECT COUNT(uid) AS count FROM users where usertype = 'Customer'";
	$count_result = mysqli_query($conn, $count_users);
	while($row = mysqli_fetch_assoc($count_result)){
		$customers = $row['count'];
	}
	
	$count_users = "SELECT COUNT(uid) AS count FROM users where usertype = 'Owner'";
	$count_result = mysqli_query($conn, $count_users);
	while($row = mysqli_fetch_assoc($count_result)){
		$owners = $row['count'];
	}
	
	$count_users = "SELECT COUNT(uid) AS count FROM users";
	$count_result = mysqli_query($conn, $count_users);
	while($row = mysqli_fetch_assoc($count_result)){
		$users = $row['count'];
	}

	$count_users = "SELECT COUNT(bid) AS count FROM book";
	$count_result = mysqli_query($conn, $count_users);
	while($row = mysqli_fetch_assoc($count_result)){
		$book = $row['count'];
	}
	
?>