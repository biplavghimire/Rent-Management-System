<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<!-- password eye function start here -->
	<script type="text/javascript">
		function myFunction() {
			var x = document.getElementById('myInput');
			var y = document.getElementById('hide1');
			var z = document.getElementById('hide2');

			if (x.type === 'password') {
				x.type = "text";
				y.style.display = "block";
				z.style.display = "none";
			}else{
				x.type = "password";
				y.style.display = "none";
				z.style.display = "block";
			}
		}
		function myFunction2() {
			var x = document.getElementById('myInput2');
			var y = document.getElementById('hide3');
			var z = document.getElementById('hide4');

			if (x.type === 'password') {
				x.type = "text";
				y.style.display = "block";
				z.style.display = "none";
			}else{
				x.type = "password";
				y.style.display = "none";
				z.style.display = "block";
			}
		}
	</script>
	<!-- password eye function ends here -->
</body>
</html>