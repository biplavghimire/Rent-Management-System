<?php
session_start();
$uid=$_SESSION['uid'];
if(!$uid){
	header(header:"location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="house_detail1.css">
</head>
<body>
<header>
    <div class="nav-bar">
        <a href="#" class="logo">
            <img src="assets/images/house1.png" height="20px" alt="House Rent Logo">House Rent
        </a>
        <div class="menu-right">
            <ul id="menu">
                <li><a href="myrented_houses.php"><i class="fas fa-home"></i> 	My Rented Houses</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                <li id="username">
                    <i class="fas fa-user-circle"></i>
                    <?php echo isset($_SESSION['fullname']) ? htmlspecialchars($_SESSION['fullname']) : "Guest"; ?>
                </li>
            </ul>
        </div>
    </div>
</header>

<div class="container">
    <div class="headline">Available Houses for Rent</div>
    <div class="row text-center py-5">
        <?php
        include 'db_connect.php'; 

        $sql_view_owners = "SELECT * FROM houseinfo WHERE status = 1 AND book = 0";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql_view_owners)) {
            echo "<div class='col-12'><h4>No houses available for rent at the moment. Please try again later.</h4></div>";
        } else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $houses = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $houses[] = $row;
            }

            if (empty($houses)) {
                echo "<div class='col-12'><h4>No houses available for rent at the moment. Please check back later.</h4></div>";
            } else {
                foreach ($houses as $house) { ?>
                    <div class="col-md-3 col-sm-6 my-0">
                        <form action="" method="post">
                            <div class="card shadow">
                                <div>
                                    <?php
                                    $image = htmlspecialchars($house['image']);
                                    echo "<img src='assets/images/$image' alt='Image not available' class='img-fluid card-img-top'>";
                                    ?>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title my-0">
                                        <div class="font">A <?php echo htmlspecialchars($house['room_type']); ?> for rent in</div>
                                        <div class="font1">
                                            <i class="fa fa-map-marker"></i> <?php echo htmlspecialchars($house['location']); ?>
                                        </div>
                                    </h5>
                                    <p class="card-text my-0">If you want details, click on the button below.</p>
                                    <h5>
                                        <small class="text-secondary">Rs. <?php echo htmlspecialchars($house['price']); ?></small>
                                    </h5>
                                    <div class="btn-group w-100">
                                        <a href="detail_info.php?h_id=<?php echo htmlspecialchars($house['h_id']); ?>" class="btn btn-sm btn-outline-info w-50">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php }
            }
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
