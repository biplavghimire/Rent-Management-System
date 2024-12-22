
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detail info</title>
	<link rel="stylesheet" type="text/css" href="detail_info.css">
	<!-- fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
	<div class="container">
	
		<?php
			session_start();
			$un=$_SESSION['uid'];
			if(!$uid){
				header(header:"location:index.php");
			} 
			include 'db_connect.php';

				$hid = $_GET['h_id'];
								
					$sql_view_owners = "SELECT * FROM houseinfo where h_id = $hid";
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
			
			<?php foreach($view_customer as $value) { ?>
				
				<!-- <div class="search-container">
				    <form action="/action_page.php">
				      <input type="text" placeholder="Enter an address or price." name="search">
				      <button type="submit"><i class="fa fa-search"></i></button>
				    </form>
				  </div> -->
				<div class="heading">
					<?php echo $value['room_type']; ?> for rent at  <?php echo $value['location']; ?>
				</div>
				<div class= 'font1'>
					<?php echo "<i class='fa fa-map-marker'></i>".$value['location']; ?>			
				</div>
				<div class="image">
					<?php  
						$image = $value['image']; 
						echo "<img src='assets/images/$image' alt='Image is not available'/>";
					?>
				</div>
				
				
				<div class="info">
					<div class="pad">
						<div class="card-single">
							<strong>price:</strong>
							<?php echo $value['price']; ?>
						</div>
						<div class="card-single">
							<strong>facility:</strong>
							<?php echo $value['facility']; ?>
						</div>
						<div class="card-single">
							<strong>phone no.:</strong>
							<?php echo $value['phone']; ?>
						</div>		
						<div class="card-single">
							<strong>Date:</strong>
							<?php echo $value['date_submission']; ?>
						</div>	
						<div class="card-single">
							<strong>Description:</strong>
								<?php echo $value['description']; ?><br>
						</div>					
						
						
					</div>
					
				</div>
				<div class="button">
				<?php if($value['book'] == 0): ?>
    <a onclick='javascript:confirmationBook($(this));return false;' href="booked_data.php?h_id=<?php echo $value['h_id']; ?>">
        <button>Book</button>
    </a>
<?php endif; ?>

					
					<a href="house_detail1.php"> <button>Back</button></a>
				</div>
			<?php } ?>

	</div>
</body>
</html>

