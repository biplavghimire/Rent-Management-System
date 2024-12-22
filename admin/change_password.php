<?php 
	include 'admin_dashboard.php';
	include 'db_connect.php';
	if (isset($_POST['update'])) {
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$update_values = "update admins set email = '$email', username = '$username', password = '$password' where a_id = 1";
		mysqli_query($conn,$update_values) or die("Update error");
}

?>
	<div class="insert">
		<form class="contact100-form" action="" method="post" autocomplete="off">
			<span class="contact100-form-title">
				Change Password!!
			</span>

			
			<label class="label-input100">Enter your email *</label>
			<div class="wrap-input100">
				<input class="input100" type="text" name="email" placeholder="example@gmail.com">
				<span class="focus-input100"></span>
			</div>

			<label class="label-input100">Enter Username *</label>
			<div class="wrap-input100">
				<input class="input100" type="text" name="username" placeholder="example">
				<span class="focus-input100"></span>
			</div>

			<label class="label-input100">Enter password *</label>
			<div class="wrap-input100">
				<input class="input100" type="password" name="password" placeholder="****">
				<span class="focus-input100"></span>
			</div>					

			<div class="container-contact100-form-btn">
				<button class="contact100-form-btn" name="update">
					Update
				</button>
			</div>
		</form>
	</div>
</body>
</html>

