<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.book{
			color: red;
			border: 1px solid red;
			text-align: center;
			padding: 5px;

		}
		.activated{
			color: green;
			border: 1px solid green;
			text-align: center;
			padding: 5px;
		}
	</style>
</head>
<body>
		
		<?php
			include 'admin_dashboard.php';
			include '../db_connect.php';
			session_start();
$un=$_SESSION['un'];
if(!$un){
	header(header:"location:index.php");
}
		?>

		<?php
			
			include '../db_connect.php';
			
			$sql_view_owners = "SELECT * FROM houseinfo";
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
		<table>
			<tr>
				<th>HID</th>
				<th>C_UID</th>
				<th>LOCATION</th>
		        <th>ROOM</th>
		        <th>PRICE( /month)</th>
		        <th>PHONE</th>	        
		        <th>STATUS</th>
		        <th>BOOK INFO</th>
				<th> ACTION </th>
			</tr>

			
			<?php foreach($view_customer as $value) { ?>
			<tr>			
				<td><?php echo $value['h_id']; ?></td>
				<td><?php echo $value['uid']; ?></td>
				<td><?php echo $value['location']; ?></td>
				<td><?php echo $value['room_type']; ?></td>			
				<td><?php echo $value['price']; ?></td>			
				<td><?php echo $value['phone']; ?></td>			
				<td><?php echo $value['status']; ?></td>
				<td><?php echo $value['book']; ?></td>

				<td>
					<?php
						$status = $value['status'];
						$book = $value['book'];
						if ($status == 0) {?>
							<a href="updateHouse.php?hid=<?php echo $value['h_id'];  ?>"> <button><i class = 'fa fa-check'>  Activate </i></button></a>					
						<?php
						}elseif($book == 1){
							echo "<div class = 'book'>BOOKED</div>";
						}else{
							echo "<div class = 'activated'>ACTIVATED</div>";
						}?>				
					
				</td>
			</tr>
			<?php } ?>
		</table>
	</main>
	</div>
</body>
</html>

