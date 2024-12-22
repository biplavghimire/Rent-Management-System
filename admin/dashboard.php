<?php 
session_start();
$un=$_SESSION['un'];
if(!$un){
	header(header:"location:index.php");
}
	include 'admin_dashboard.php';
	include 'count.php';
	
 ?>

		<div class="cards">
			<div class="card-single">
				<div>
					<h1><?php echo $users; echo "+"; ?></h1>
					<span>Total Users</span>
				</div>
				<div>
					<span class="fas fa-user-plus"></span> 
				</div>
			</div>

			<div class="card-single">
				<div>
					<h1><?php echo $owners; echo "+";?></h1>
					<span>Total Owners</span>
				</div>
				<div>
					<span class="fas fa-user-check"></span>
				</div>
			</div>

			<div class="card-single">
				<div>
					<h1><?php echo $customers; echo "+";?></h1>
					<span>Total Customers</span>
				</div>
				<div>
					<span class="fa fa-users"></span>
				</div>
			</div>

			<div class="card-single">
				<div>
					<h1><?php echo $book; echo "+";?></h1>
					<span>Total Houses Booked</span>
				</div>
				<div>
					<span class="fas fa-house-user"></span>
				</div>
			</div>

			<div class="card-single">
				<div>
					<h1>1</h1>
					<span>Total Admin</span>
				</div>
				<div>
					<span class="fas fa-user-shield"></span>
				</div>
			</div>
		</div>
	</main>
</div>
</body>
</html>