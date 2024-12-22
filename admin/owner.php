	<?php 
	session_start();
	$un=$_SESSION['un'];
	if(!$un){
		header(header:"location:index.php");
	}
		include 'admin_dashboard.php';
		include 'db_connect.php';
	?>

	<?php
		
		$ur_id = 2;
		$sql_view_owners = "SELECT * from users AS u INNER JOIN user_roles AS ur ON u.ur_id=ur.ur_id WHERE u.ur_id = ?";
		$stmt = mysqli_stmt_init($conn);
		$view_customer=[];
		if(!mysqli_stmt_prepare($stmt, $sql_view_owners)){

		}else{
			mysqli_stmt_bind_param($stmt, "s",$ur_id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result)){
				array_push($view_customer, $row);
			}	
		}
			
						
	?>			
	<table>
		<tr>
			<th>UID</th>
			<th>USERTYPE</th>
			<th>FULLNAME</th>
			<th>GENDER</th>
			<th>PHONE</th>
			<th>USERNAME</th>
			<th> ACTION </th>
		</tr>

		
		<?php foreach($view_customer as $value) { ?>
		<tr>			
			<td><?php echo $value['uid']; ?></td>
			<td><?php echo $value['usertype']; ?></td>
			<td><?php echo $value['fullname']; ?></td>
			<td><?php echo $value['gender']; ?></td>
			<td><?php echo $value['phone']; ?></td>
			<td><?php echo $value['username']; ?></td>
			<td><a onclick='javascript:confirmationDelete($(this));return false;' href="delete_owner.php?uid=<?php echo $value['uid'];  ?>"> <button><i class = 'fas fa-trash'>  Delete</i></button></a></td>
			</tr>
		<?php } ?>
		
	</table>

	<script type="text/javascript">
		function confirmationDelete(anchor)
	{
	   var conf = confirm('Are you sure want to delete this record?');
	   if(conf)
	      window.location=anchor.attr("href");
	}
	</script>
</main>
</div>
</body>
</html>

