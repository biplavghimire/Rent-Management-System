<?php
session_start();
include 'db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Get the user ID based on the username
$sql_user_id = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql_user_id);
if ($row = mysqli_fetch_assoc($result)) {
    $user_id = $row['uid'];
}

// Fetch the rented houses for the logged-in user
$sql_rented_houses = "SELECT * FROM book WHERE c_uid = $user_id";
$rented_result = mysqli_query($conn, $sql_rented_houses);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<!-- fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
	<!-- stylesheet -->
	<link rel="stylesheet" type="text/css" href="house_detail1.css">
</head>
<body>
<header>
		<div class="nav-bar">
			<a href="#" class="logo"><img src="assets/images/house1.png" height="20px">House Rent</a>
			
			<div class="menu-right">
				
				<ul id = "menu">
				<li><a href = "my_houserented.php"><i >My Rented house</i></a></li>
					<li><a href = "logout.php"><i class = "fas fa-sign-out-alt">Log Out</i></a></li>
					<li id="username"><i class = "fas fa-user-circle"></i><?php echo $_SESSION['fullname']; ?></li>
					
					
				</ul>
			</div>
		</div>
	</header>


<div class="container">
    <div class="headline">My Rented Houses</div>
    <div class="row text-center py-5">
        <?php
        if (mysqli_num_rows($rented_result) > 0) {
            while ($house = mysqli_fetch_assoc($rented_result)) {
                $house_id = $house['h_id'];
                $sql_house_info = "SELECT * FROM houseinfo WHERE h_id = $house_id";
                $house_info = mysqli_query($conn, $sql_house_info);
                $house_data = mysqli_fetch_assoc($house_info);
        ?>
            <div class="col-md-3 col-sm-6 my-0">
                <div class="card shadow">
                    <div>
                        <?php
                        $image = htmlspecialchars($house_data['image']);
                        echo "<img src='assets/images/$image' alt='Image not available' class='img-fluid card-img-top'>";
                        ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title my-0">
                            <div class="font">A <?php echo htmlspecialchars($house_data['room_type']); ?> for rent in</div>
                            <div class="font1">
                                <i class="fa fa-map-marker"></i> <?php echo htmlspecialchars($house_data['location']); ?>
                            </div>
                        </h5>
                        <p class="card-text my-0">Price: Rs. <?php echo htmlspecialchars($house_data['price']); ?></p>
                        <h5><small class="text-secondary">Booked: <?php echo $house['date']; ?></small></h5>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
            echo "<div class='col-12'><h4>You haven't rented any house yet.</h4></div>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
