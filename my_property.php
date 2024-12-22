<?php
session_start();
$uid=$_SESSION['uid'];
if(!$uid){
	header(header:"location:index.php");
}
include 'db_connect.php';

// Check if the user is logged in and has a valid UID
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['uid'];

// Fetch properties added by the logged-in owner
$sql = "SELECT * FROM houseinfo WHERE uid = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$properties = [];
while ($row = mysqli_fetch_assoc($result)) {
    $properties[] = $row;
}
mysqli_stmt_close($stmt);

// Handle edit request
if (isset($_POST['update_property'])) {
    $h_id = $_POST['h_id'];
    $new_price = $_POST['price'];
    $new_description = $_POST['description'];

    $update_sql = "UPDATE houseinfo SET price = ?, description = ? WHERE h_id = ? AND uid = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "dsii", $new_price, $new_description, $h_id, $uid);
    if (mysqli_stmt_execute($update_stmt)) {
        $message = "Property updated successfully!";
    } else {
        $message = "Failed to update the property.";
    }
    mysqli_stmt_close($update_stmt);

    // Refresh properties after update
    header("Location: my_property.php");
    exit();
}

// Handle delete request
if (isset($_POST['delete_property'])) {
    $h_id = $_POST['h_id'];

    $delete_sql = "DELETE FROM houseinfo WHERE h_id = ? AND uid = ?";
    $delete_stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($delete_stmt, "ii", $h_id, $uid);
    if (mysqli_stmt_execute($delete_stmt)) {
        $message = "Property deleted successfully!";
    } else {
        $message = "Failed to delete the property.";
    }
    mysqli_stmt_close($delete_stmt);

    // Refresh properties after deletion
    header("Location: my_property.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Properties</title>
    <link rel="stylesheet" href="assets/css/owner_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><img src="assets/images/house1.png" height="20px"><span>House Rent</span></h2>
        </div>
        <div class="sidebar-menu">
			<ul>
				<li>
					<a href="insertion.php" class="active"><span class="fas fa-plus"></span>
					<span>Add informarion</span></a>
				</li>

				<li>
					<a href="booked_information.php"><span class="fas fa-book-open"></span>
					<span>Booked information</span></a>
				</li>
				<li>
					<a href="my_property.php"><span class="fa fa-puzzle-piece"></span>
					<span>My Property</span></a>
				</li>

				<li>
					<a href="logout.php"><span class="fas fa-sign-out-alt"></span>
					<span>Logout</span></a>
				</li>

			</ul>			
		</div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="fa fa-align-justify"></span>
                </label>
                My Properties
            </h2>

            <div class="search-wrapper">
                <span class="fa fa-search"></span>
                <input type="search" placeholder="search here">
            </div>

            <div class="user-wrapper">
                <img src="assets/images/user.png" width="50px" height="50px" alt="">
                <div>
                    <h4><?php echo $_SESSION['fullname']; ?></h4>
                    <small>Owner</small>
                </div>
            </div>
        </header>

        <main>
            <div class="container mt-5">
                <?php if (!empty($properties)): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Location</th>
                                <th>Room Type</th>
                                <th>Facilities</th>
                                <th>Price (Rs. /month)</th>
                                <th>Status</th>
                                <th>Book Status</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($properties as $property): ?>
                                <tr>
                                    <td><img src="assets/images/<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image" width="100"></td>
                                    <td><?php echo htmlspecialchars($property['location']); ?></td>
                                    <td><?php echo htmlspecialchars($property['room_type']); ?></td>
                                    <td><?php echo htmlspecialchars($property['facility']); ?></td>
                                    <td><?php echo htmlspecialchars($property['price']); ?></td>
                                    <td><?php if(($property['status']) == 1 ){
                                        echo "<span style='background-color:green; color:white'>Approved</span>";
                                    }else{
                                        echo "<span style='background-color:red; color:white'>Not Approved</span>";
                                    } ?></td>
                                    <td><?php if(($property['book']) == 1 ){
                                        echo "<span style='background-color:red; color:white'>Reserved</span>";
                                    }else{
                                        echo "<span style='background-color:green; color:white'>Available</span>";
                                    } ?></td>
                                    <td><?php echo htmlspecialchars($property['description']); ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $property['h_id']; ?>">Edit</button>
                                        <form method="POST" action="" style="display:inline-block;">
                                            <input type="hidden" name="h_id" value="<?php echo $property['h_id']; ?>">
                                            <button type="submit" name="delete_property" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this property?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editModal<?php echo $property['h_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Property</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="">
                                                <div class="modal-body">
                                                    <input type="hidden" name="h_id" value="<?php echo $property['h_id']; ?>">
                                                    <div class="mb-3">
                                                        <label for="price" class="form-label">Price (Rs.)</label>
                                                        <input type="text" class="form-control" name="price" value="<?php echo htmlspecialchars($property['price']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description</label>
                                                        <textarea class="form-control" name="description" required><?php echo htmlspecialchars($property['description']); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="update_property">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No properties found. <a href="insertion.php">Add a property now.</a></p>
                <?php endif; ?>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
