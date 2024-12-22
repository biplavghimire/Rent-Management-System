<?php 
	include 'header.php';
	include 'db_connect.php';
	if (isset($_POST['send'])) {
		
		$fname = $_POST['first-name'];
		$lname = $_POST['last-name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$msg = $_POST['message'];

		$insert = "INSERT INTO `feedback` ( `firstname`, `lastname`, `email`, `phone`, `message`) VALUES ('$fname', '$lname', '$email', '$phone', '$msg');";
		$result=$conn->query($insert);
		// mysqli_query($conn, $insert);
		if($result===true){
			echo "<Script>alert('jhgnnn')</script>";
		}else{
			echo "<Script>alert('jhgnfffffffffffnn')</script>";
		}
	}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel = "stylesheet" href="assets/css/contact.css" type="text/css">
		<link rel="stylesheet" href="assets/fontAwesome/css/font-awesome.css" type="text/css"/>
		<title>Contact</title>
	</head>
<body>
	<div class = "contact-section">
		<div class="container">
			<div class="row">		
				<!-- Contact info -->
				<div class="contact-info">			
					<div class="in">
						<span><i class="fa fa-map-marker" area-hidden = "true"></i></span>
						<label>Address</label>
						<p class="set">Suryabinayak, <br> Bhaktapur, Nepal</p>
					</div>
					<div class="in">
						<span><i class="fa fa-phone" area-hidden = "true"></i></span>
						<label>Lets Talk</label>
						
						<p class="set"><a href="">01-23456685</a>
						<br><a href="">9814561596</a></p>
					</div>	
					<div class="in">
						<span><i class="fa fa-envelope" area-hidden = "true"></i></span>
						<label>General Support</label>
						<p class="set"><a href="">houseandroom@gmail.com</a></p>
					</div>					
				</div>
				<!--contact100-form-->
				<form class="contact100-form" action="" method="post" >
					<span class="contact100-form-title">
						<B>Send Us A Message</B>
					</span>

					<label class="label-input100" for="first-name"><B>Tell us your name:</B></label>
					<div class="wrap-input100 rs1-wrap-input100">
						<input id="first-name" class="input100" type="text" name="first-name" placeholder="">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100" data-validate="Type last name">
						<input class="input100" type="text" name="last-name" placeholder="">
						<span class="focus-input100"></span>
					</div>

					<label class="label-input100" for="email"><B>Enter your email:</B></label>
					<div class="wrap-input100">
						<input id="email" class="input100" type="text" name="email" placeholder="">
						<span class="focus-input100"></span>
					</div>

					<label class="label-input100" for="phone"><B>Enter phone number:</B></label>
					<div class="wrap-input100">
						<input id="phone" class="input100" type="text" name="phone" placeholder="">
						<span class="focus-input100"></span>
					</div>

					<label class="label-input100" for="message"><B>Message:</B></label>
					<div class="wrap-input100">
						<textarea id="message" class="input100" name="message" placeholder="Write us a message"></textarea>
						<span class="focus-input100"></span>
					</div>

					<div class="container-contact100-form-btn">
						<button class="contact100-form-btn" name="send">
						<B>Send Message:</B>
						</button>
					</div>
				</form>
			</div>
			
			</div>
		</div>
	</div>	
</body>
</html>
<?php include 'footer1.php'?>