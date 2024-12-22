
		<?php 
		include 'admin_dashboard.php';
			include 'db_connect.php';
			$select = "select * from feedback";
			$result = mysqli_query($conn, $select);
			while($row = mysqli_fetch_assoc($result)){
				echo '<div class = "mar"><table>';
				foreach ($row as $key => $value) {
					echo "<tr>";
					echo "<th>$key :</th> <td>$value</td>"; 
				}
				echo "</tr></table></div><hr>";
			}
		?>

</main>		
</div>
</body>
</html>

