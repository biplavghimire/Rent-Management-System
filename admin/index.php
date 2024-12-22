<?php include 'db_connect.php'; ?>
<?php
				session_start();


	$message = "";
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$pwd = $_POST['password'];
		$_SESSION['username'] = $username; 

		$ur_id = 1;
		
		
		$sql_login_admin = "SELECT * FROM admins where username= ? and password= ? and ur_id = ? ";
		
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql_login_admin)){

			}else{
				mysqli_stmt_bind_param($stmt, "sss", $username, $pwd, $ur_id);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);


		if(mysqli_num_rows($result) >0 ){
			$array = mysqli_fetch_assoc($result);
			
			if ($array['ur_id'] == 1)
			{
		$_SESSION['un']=$username;
		
				header("Refresh:0,URL= dashboard.php");
			}else{
				echo "login sucess";
			}		
		}else{
			$message .="Login Failed";
		}	
	}
}
mysqli_close($conn);
?>
<!DOCTYPE HTML>
<html>
<head>
	 <link rel = "stylesheet" href="assets/css/index.css" type="text/css">
	 <link rel = "stylesheet" href="assets/css/header.css" type="text/css">
	 <link rel="stylesheet" href="assets/fontAwesome/css/font-awesome.css" type="text/css"/><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<title>index</title>
</head>
<body>
	<div class="container11">
		<div class="nav-bar">
			
			<div class="menu-right">
				<span id="span" onclick="myFunction3()">&#9776</span>
				<ul id = "menu">
					<li><a href = "../index.php">Home</a></li>			

					<li><a href = "../login.php">User Login</a></li>
				</ul>
			</div>
		</div>
		<div class="margin">
		<div class="form-box">
			<h1>Admin Login</h1>
			<h2 style="margin-left: 15px; color: red;"><?php echo $message; ?></h2>
			<form method="POST" action="" autocomplete="off">
				<div class="input-box">
					<i class="fa fa-envelope-o"></i>
					<input type="text" name="username" placeholder="Username">
				</div>
				<div class="input-box">
					<i class="fa fa-key"></i>
					<input type="password" name="password" placeholder="Password" id="myInput"> 
					<span class="eye" onclick="myFunction()">
						<i id="hide1" class="fa fa-eye"></i>
						<i id="hide2" class="fa fa-eye-slash"></i>
					</span>
				</div>
				<input type="submit" name="login" value="Login" class="login-btn">
				<button class="btn btn-success">
  <a href="index.php" style="text-decoration: none; color: inherit; padding: 0; margin: 0;">Back</a>
</button>

			</form>
		</div>
	</div>
	</div>



	<?php include '../hide_password.php' ?>
</body>
</html>
