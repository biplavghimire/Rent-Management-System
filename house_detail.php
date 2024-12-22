<?php session_start();
$uid=$_SESSION['uid'];
if(!$uid){
	header(header:"location:index.php");
} ?>
<!DOCTYPE html>
<html>
<head>
	<title>House Details</title>
	<link rel="stylesheet" type="text/css" href="assets/css/house_detail.css">
	<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='bootstrap/js/bootstrap.min.js'></script> 
	<script src='bootbox.min.js'></script>
	<!-- fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
	<header>
		<div class="nav-bar">
			<a href="#" class="logo"><img src="assets/images/house1.png" height="20px">House Rent</a>
			<div class="search-wrapper">
				<span class="fas fa-search"></span>
				<input type="search" name="" placeholder="search here"/>
			</div>
			<div class="menu-right">
				<ul id = "menu">
					<li><a href = "logout.php"><i class = "fas fa-sign-out-alt">Log Out</i></a></li>
					<li id="username"><i class = "fas fa-user-circle"></i><?php echo $_SESSION['fullname']; ?></li>
					
					
				</ul>
			</div>
		</div>
	</header>
	<?php
		 
		include 'db_connect.php';

							
				$sql_view_owners = "SELECT * FROM houseinfo where status = 1";
				$stmt = mysqli_stmt_init($conn);
				$view_customer=[];
				if(!mysqli_stmt_prepare($stmt, $sql_view_owners)){

				}else{
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					while($row = mysqli_fetch_assoc($result)){
						array_push($view_customer, $row);
					}	
				}							
		?>
		<div class="con">
			<table>
				<?php foreach($view_customer as $value) { ?>
					<tr>			
						<th>
							HID:<br>
							LOCATION: <br>
							ROOM_TYPE:<br>
							FACILITY:<br>
							PRICE:<br>
							DESCRIPTION:<br>
							PHONE:<br>
							DATE:<br>
						</th>
						<td>
							<?php echo $value['h_id']; ?><br>
							<?php echo $value['location']; ?><br>
							<?php echo $value['room_type']; ?><br>
							<?php echo $value['facility']; ?><br>	
							<?php echo $value['price']; ?><br>
							<?php echo $value['description']; ?><br>
							<?php echo $value['phone']; ?><br>
							<?php echo $value['date_submission']; ?><br>
						</td>
						
						<td>
							<?php  
								$image = $value['image']; 
								echo "<img src='assets/images/$image' alt='Image is not available'/>";

							?>
						</td>
					</tr>
					
						<tr>						
							<td id="pad"></td>
							<td id="pad">
								
							</td>
							<td id="pad">
								<?php
									$book = $value['book'];
									if ($book == 0) {
										
										?>

										<a onclick='javascript:confirmationBook($(this));return false;' href="booked_data.php?h_id=<?php echo $value['h_id'];  ?>"> <button>BOOK</button></a>
								<?php
									}else{
										echo "<div class = 'book'>BOOKED</div>";
									}
								?>
								
							</td>
						</tr>
					
				<?php } ?>
			</table>
		</div>
		<script type="text/javascript">
			function confirmationBook(anchor)
			{
			   var conf = confirm('Are you sure want to book this HOUSE?');
			   if(conf)
			      window.location=anchor.attr("href");
			}
		</script>
</body>
</html>
<?php include 'footer1.php' ?>
