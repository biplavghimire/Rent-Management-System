<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<title>header</title>
	<link rel="stylesheet" type="text/css" href="assets/css/header.css">
</head>
<body>
	<header>
		<div class="nav-bar">
		  	<div class="menu-right">
				<span id="span" onclick="myFunction3()">&#9776</span>
				<ul id = "menu">
					<li><a href = "index.php">Home</a></li>			
					<li><a href = "contact.php">Contact</a></li>
					<li><a href = "login.php">User Login</a></li>
					<li><a href = "admin/index.php">Admin Login</a></li>
					<li><a href = "registration.php">Sign Up</a></li>
				</ul>
			</div>
		</div>
	</header>

	<script type="text/javascript">
		function myFunction3(){
			var x = document.getElementById('menu');
			if (x.style.display == "block") {
				x.style.display ="none";
			}else{
				x.style.display ="block";
			}
		}
	</script>
</body>
</html>