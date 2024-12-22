<?php session_start();
$uid=$_SESSION['uid'];
if(!$uid){
	header(header:"location:index.php");
} ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/owner_dashboard.css">
	<!-- fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
	<title>Owner Dashboard</title>
</head>
<body>
	<input type="checkbox" name="" id="nav-toggle">
	<div class="sidebar">
		<div class="sidebar-brand">
			<h2><img src="assets/images/house1.png" height="20px"><span>House Rent</span></h2>
		</div>
		<div class="sidebar-menu">
			<ul>
				<li><a href="insertion.php" class="active"><span class="fas fa-plus"></span> <span>Add Information</span></a></li>
				<li><a href="booked_information.php"><span class="fas fa-book-open"></span> <span>Booked Information</span></a></li>
				<li><a href="my_property.php"><span class="fa fa-puzzle-piece"></span> <span>My Property</span></a></li>
				<li><a href="logout.php"><span class="fas fa-sign-out-alt"></span> <span>Logout</span></a></li>
			</ul>			
		</div>
	</div>

	<div class="main-content">
		<header>
			<h2>
				<label for="nav-toggle">
					<span class="fa fa-align-justify"></span>
				</label>
				Owner Dashboard 
			</h2>

			<div class="search-wrapper">
				<span class="fa fa-search"></span>
				<input type="search" name="" placeholder="Search here"/>
			</div>

			<div class="user-wrapper">
				<img src="assets/images/user.png" width="50px" height="50px" alt="">
				<div>
					<h4><?php echo $_SESSION['fullname']; ?></h4>
					<small>Owner</small>
				</div>
			</div>
		</header>

		<main>		
			<?php
			include 'db_connect.php';

			$uid = $_SESSION['uid'];
			
			/*-------------BOOKED--------------*/
			$sql_check = "SELECT * FROM book WHERE w_id = '$uid'";
			$result = mysqli_query($conn, $sql_check);

			while($row = mysqli_fetch_assoc($result)) {
				$book = $row['h_book'];
				$u_id = $row['w_id'];
				$fullname = $row['c_fullname'];
				$phone = $row['c_phone'];
				$hid = $row['h_id'];

				if ($book == 1 && $u_id == $uid) {
					echo "<h1>Your house is booked!</h1>";
					echo "<small><h5>House ID: ".$hid."</h5></small>";
					echo "<h5>Your house is booked by the following user:</h5>";
					echo "<table>";
					echo "<tr><th>Full Name:</th><td>".$fullname."</td></tr>";
					echo "<tr><th>Phone No.:</th><td>".$phone."</td></tr>";
					echo "</table><br><br>";
				}
			}
			
			/*---------------NOT BOOKED---------------*/
			$sql_check1 = "SELECT * FROM houseinfo WHERE uid = '$uid'";
			$result1 = mysqli_query($conn, $sql_check1);

			while($row1 = mysqli_fetch_assoc($result1)) {
				$book = $row1['book'];	
				$id = $row1['uid'];

				if ($book == 0 && $id == $uid) {
					echo "<h1>Your house is not booked!</h1>";
					echo "<small>It is on the queue!</small><br>";
				}
			}
			?>
		</main>
	</div>
</body>
</html>
