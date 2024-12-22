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
	<!-- sweet alert cdn -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
				<li>
					<a href="insertion.php" class="active"><span class="fas fa-plus"></span>
					<span>Add informarion</span></a>
				</li>

				<li>
					<a href="booked_information.php"><span class="fas fa-book-open"></span>
					<span>Booked information</span></a>
				</li>
				<li>
					<a href="my_property.php"><span class="fa fa-puzzle-piece"></span>
					<span>My Property</span></a>
				</li>

				<li>
					<a href="logout.php"><span class="fas fa-sign-out-alt"></span>
					<span>Logout</span></a>
				</li>

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
				<input type="search" name="" placeholder="search here"/>
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
	if (isset($_POST['submit'])) 
	{
		$username = $_SESSION['username'];

		$sql_get_uid = "select uid from users where username= '$username'";

		$result = mysqli_query($conn,$sql_get_uid);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
		   		$u_id=  $row["uid"];
	   		}
		}

		$location = $_POST['txtlocation'];
		$room = $_POST['selRent'];
		$price = $_POST['txtprice'];
		$description = $_POST['txtdescription'];
		$contact = $_POST['txtcontact'];
		$status = 0;
		$book = 0;
		$image = $_FILES['image']['name'];		
			$filename=$_FILES['image']['tmp_name'];
			$folder = "assets/images/".$image;
			move_uploaded_file($filename, $folder);
		$price_pattern = "/^\d+(:?[.]\d{20})$/";
		$err = "";
		
		$facility="";  
		$selected="";
		

		if(!empty($location) || !empty($room) || !empty($description)  || !empty($facility) 
		|| !empty($price) || !empty($contact) || !empty($date) || !empty($image) || !empty($_POST['f'])){

			if (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $price)){
				
			}else{
				if(!preg_match("/^[0-9]{10}+$/", $contact)){
					$err = "Invalid phone format";
				}else{
				
					$check=$_POST['f'];  
					foreach($check as $selected){  
					       $facility .= $selected.",";  
					 }
					
					$insert_values = "insert into houseinfo(
					uid, location, room_type, facility, price, description, phone, image, status, book)
					values('$u_id', '$location', '$room', '$facility', '$price', '$description', 
					'$contact', '$image','$status', '$book')";
						if(mysqli_query($conn,$insert_values)){
							//echo '<script>alert("Insertion Successfully!!")</script>';
							echo '<script>
								swal({
									  title: "Insertion Successfully!!",
									  text: "Click Ok!",
									  icon: "success",
									  button: "Ok",
									});
							 </script>';
						}else{
							echo '<script>alert("Insertion Failed!!")</script>';
						}
					

				}
    		}
		}else{
			$err = "empty fields";
		}		
	}
	
?>
	
		<div class = "insert">
			<div id="err">
				<?php 
					if(isset($err)){
						echo $err;
					}?>				
			</div>
						
		<form class="contact100-form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
			<span class="contact100-form-title">
				Add HouseInfo!!
			</span>

			
			<label class="label-input100">Enter Location *</label>
			<div class="wrap-input100">
				<input class="input100" type = "text" name = "txtlocation" placeholder = "Location">
				<span class="focus-input100"></span>
			</div>

			<label class="label-input100">select room type *</label>
			<div class="wrap-input100">
				<select name = "selRent" class="input100">
					<optgroup label = "Rent">
						<option>Room</option>
						<option>Flat</option>
						<option>House</option>
					</optgroup>
				</select>
				<span class="focus-input100"></span>
			</div>

			<label class="label-input100">select facility *</label>
			<div class="wrap-input100">
				<input class="input101" type = "checkbox" name = "f[]" value="Wifi"/>Wifi
				<input class="input101" type = "checkbox" name = "f[]" value="Parking"/>Parking
				<input class="input101" type = "checkbox" name = "f[]" value="Water"/>Water
				<input class="input101" type = "checkbox" name = "f[]" value="Electicity"/>Free Electicity
				<span class="focus-input100"></span>
			</div>
				
			<label class="label-input100">Enter Price( .per month) *</label>
			<div class="wrap-input100">
				<input class="input100" type = "text" name = "txtprice" placeholder = "price">
				<span class="focus-input100"></span>
			</div>

			<label class="label-input100">Enter description *</label>
			<div class="wrap-input100">
				<input class="input100" type = "text" name = "txtdescription" placeholder = "description">
				<span class="focus-input100"></span>
			</div>

			<label class="label-input100">Enter contact no. *</label>
			<div class="wrap-input100">
				<input class="input100" type = "text" name = "txtcontact" placeholder = "contact no.">
				<span class="focus-input100"></span>
			</div>

			<label class="label-input100">Add image *</label>
			<div class="wrap-input100">
				<input class="input100" type = "file" class = "file" name = "image"/>
				<span class="focus-input100"></span>
			</div>					

			<div class="container-contact100-form-btn">
				<button class="contact100-form-btn" name = "submit">
					add
				</button>
			</div>
		</form>
		</div>
	</main>
</div>

</body>
</html>