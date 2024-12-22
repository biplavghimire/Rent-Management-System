<?php 

	include 'header.php';
	include 'db_connect.php';

	if(isset($_POST['submit'])){

		$usertype = $_POST['usertype'];
		$fullname = $_POST['fullname'];
		$gender = "";
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		$err = "";
		$noterr = "";
		$phone_pattern = "/^9[0-9]{9}$/";

		if(isset($_POST['g'])){
			$gender = $_POST['g'];
		}

		if(empty($usertype) || empty($fullname) || empty($gender) || empty($phone) || empty($email) || empty($password) || empty($cpassword) || empty($username)){
			$err = "Empty fields";
		} else {
			if(!preg_match($phone_pattern, $phone)){
				$err = "Invalid phone format";
			} else {
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$err = "Invalid email format";
				} else {
					if($password !== $cpassword){
						$err = 'Passwords do not match.';
					} else {
						$ur_id = "";

						/* to get user id */
						$sql_get_userRole_id = "SELECT * FROM user_roles WHERE role_name=?";
						$stmt1 = mysqli_stmt_init($conn);

						if(!mysqli_stmt_prepare($stmt1, $sql_get_userRole_id)){
							$err = "Database error.";
						} else {
							mysqli_stmt_bind_param($stmt1, "s", $usertype);
							mysqli_stmt_execute($stmt1);
							$result = mysqli_stmt_get_result($stmt1);
							if($row = mysqli_fetch_assoc($result)){
								$ur_id = $row['ur_id'];
							} else {
								$err = "User role not found.";
							}
						}

						if(empty($err)){
							/* to insert user */
							$sql_insert_user = "INSERT INTO users(usertype, fullname, gender, phone, email, username, password, ur_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

							/* create prepared statement */
							$stmt2 = mysqli_stmt_init($conn);

							if(!mysqli_stmt_prepare($stmt2, $sql_insert_user)){
								$err = "Database error.";
							} else {
								mysqli_stmt_bind_param($stmt2, "ssssssss", $usertype, $fullname, $gender, $phone, $email, $username, $password, $ur_id);
								mysqli_stmt_execute($stmt2);
								$noterr = "Registration successful!";
							}
						}
					}
				}
			}
		}
	}

	mysqli_close($conn);
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="assets/css/registration.css" type="text/css">
	<link rel="stylesheet" href="assets/fontAwesome/css/font-awesome.css" type="text/css"/>
	<title>Registration page</title>
	<style type="text/css">
		#err {
			text-align: center;
			color: red;
		}
		#noterr {
			text-align: center;
			color: green;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="margin">
			<div class="form-box">
				<!-- error div started -->
				<div id="err">
					<?php 
						if(isset($err)){
							echo $err;
						}
					?>				
				</div>
				<div id="noterr">
					<?php 
						if(isset($noterr)){
							echo $noterr;
						}
					?>				
				</div>
				<!-- error div ends here -->
				<h1>Registration Form</h1>
				<form action="" method="post" autocomplete="off">
					<div class="input-box">
					<i class="fa fa-user-plus" aria-hidden="true"></i>
						<input type="text" name="fullname" placeholder="Fullname" pattern="^[A-Za-z]+(?:\s[a-zA-Z\s]+)+" title="Please enter Full Name" required maxlength="20">
					</div>
					<!-- full name div ends here -->

					<div class="gender-box">
					<i class="fa fa-male" aria-hidden="true"></i>
						<span>Gender:</span>
						<input type="radio" name="g" value="male"/><label>Male</label>
						<input type="radio" name="g" value="female"/><label>Female</label>
						<input type="radio" name="g" value="others"/><label>Others</label>
					</div>
					<!-- gender div ends here -->

					<div class="input-box">
					<i class="fa fa-phone" area-hidden="true"></i>
						<input type="text" name="phone" placeholder="Phone" maxlength="10" pattern="^9[0-9]{9}$" title="Enter 10 digit Number starting with 9" required>
					</div>
					<!-- phone div ends here -->

					<div class="input-box">
					<i class="fa fa-users" aria-hidden="true"></i>
						<select name="usertype">
							<optgroup label="Usertype">
								<option value="Owner">Owner</option>
								<option value="Customer">Customer</option>									
							</optgroup>
						</select>
					</div>
					<!-- user type div ends here -->

					<div class="input-box">
					<i class="fa fa-envelope" aria-hidden="true"></i>
						<input type="text" name="email" placeholder="Email" maxlength="35" title="Please Enter valid email" required>
					</div>
					<!-- email div ends here -->

					<div class="input-box">
					<i class="fa fa-user-plus" aria-hidden="true"></i>
						<input type="text" name="username" placeholder="Username" maxlength="20" pattern=".{6,}" title="At least 6 characters" required>
					</div>
					<!-- user name div ends here -->

					<div class="input-box">
					<i class="fa fa-key" aria-hidden="true"></i>
						<input type="password" name="password" placeholder="Password" id="password" maxlength="20" pattern=".{8,}" title="Password must be at least 8 characters" required> 
						<span toggle="#password" class="password-toggle"></span>
					</div>
					<!-- password div ends here -->

					<div class="input-box">
					<i class="fa fa-key" aria-hidden="true"></i>
						<input type="password" name="cpassword" placeholder="Confirm Password" id="confirm_password" maxlength="20" pattern=".{8,}" title="Password must be at least 8 characters" required>
						<span toggle="#confirm_password" class="password-toggle"></span>
					</div>
					<!-- confirm password div ends here -->

					<span id="confirmPasswordError" style="color: red;"></span>
					<br>
					<div class="tacbox">
						<input id="checkbox" type="checkbox" name="termsAndCondition" required />
						<label for="termsAndCondition"> I agree to these <a href="#" id="termsLink">Terms and Conditions.</a></label>
					</div>

					<!-- Popup Container -->
					<div id="popupContainer" class="popup">
						<div class="popupContent">
							<span class="close" id="closeBtn">&times;</span>
							<!-- Popup Content Goes Here -->
							<h2><u>Terms and Conditions</u></h2>
							<br />
							
								<li>  Supply of power and water and sanitation in a rented house.  </li>
								<li>  To comply with the other concerns set out in the Agreement.</li>
								<li> To pay the rent during the set period. </li>
								<li>To maintain sanitation, to take care of, protect and safeguard the rented house properly and reasonably. </li>
					         </br></ul>
							
						</div>
					</div>

					<input type="submit" name="submit" value="Sign Up" class="login-btn">
				</form>
			</div>
		</div>
		<!-- registration-form div ends here -->

	<?php include 'hide_password.php'; ?>
	</div>

	<script>
		document.querySelectorAll('.password-toggle').forEach(function(passwordToggle) {
			passwordToggle.addEventListener('click', function () {
				const passwordField = document.querySelector(this.getAttribute('toggle'));

				if (passwordField.type === 'password') {
					passwordField.type = 'text';
					this.classList.add('active');
				} else {
					passwordField.type = 'password';
					this.classList.remove('active');
				}
			});
		});

		document.getElementById('confirm_password').addEventListener('input', function () {
			var password = document.getElementById('password').value;
			var confirmPassword = this.value;
			var confirmPasswordError = document.getElementById('confirmPasswordError');

			if (password !== confirmPassword) {
				confirmPasswordError.textContent = 'Passwords do not match';
			} else {
				confirmPasswordError.textContent = '';
			}
		});

		// Get the popup container and the close button
		var popupContainer = document.getElementById("popupContainer");
		var closeBtn = document.getElementById("closeBtn");

		// Get the terms and conditions link
		var termsLink = document.getElementById("termsLink");

		// When the terms and conditions link is clicked, display the popup
		termsLink.addEventListener("click", function (event) {
			event.preventDefault(); // Prevent the default link behavior
			popupContainer.style.display = "block";
		}); 

		// When the close button is clicked, hide the popup
		closeBtn.addEventListener("click", function () {
		
			popupContainer.style.display = "none";
		});

		// Also, close the popup if user clicks outside the popup content
		window.addEventListener("click", function (event) {
			if (event.target == popupContainer) {
				popupContainer.style.display = "none";
			}
		});
	</script>
</body> 
</html>
