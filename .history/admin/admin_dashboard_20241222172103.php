<?php 

    include 'count.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/css/admin_dashboard.css">
    <link rel="stylesheet" type="text/css" href="assets/css/feedback.css">
    <link rel="stylesheet" type="text/css" href="assets/css/change_password.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/manage_houses.css" type="text/css"/>
    <link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='bootstrap/js/bootstrap.min.js'></script>
    <title>Admin Dashboard</title>
</head>
<body>
    <input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><img src="assets/images/house1.png" height="20px"><span><a href="http://localhost/flatrent/admin/house.php">House Rent</a></span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>">
                        <span class="fas fa-globe"></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="house.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'house.php') ? 'active' : ''; ?>">
                        <span class="fas fa-house-user"></span>
                        <span>Houses</span>
                    </a>
                </li>

                <li>
                    <a href="customer.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'customer.php') ? 'active' : ''; ?>">
                        <span class="fas fa-users"></span>
                        <span>Customers</span>
                    </a>
                </li>

                <li>
                    <a href="owner.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'owner.php') ? 'active' : ''; ?>">
                        <span class="fas fa-user-check"></span>
                        <span>Owners</span>
                    </a>
                </li>

                <li>
                    <a href="feedback.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'feedback.php') ? 'active' : ''; ?>">
                        <span class="far fa-comments"></span>
                        <span>Feedback</span>
                    </a>
                </li>

                <li>
                    <a href="change_password.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'change_password.php') ? 'active' : ''; ?>">
                        <span class="far fa-user-circle"></span>
                        <span>Accounts</span>
                    </a>
                </li>

                <li>
                    <a href="admin_logout.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'admin_logout.php') ? 'active' : ''; ?>">
                        <span class="fas fa-sign-out-alt"></span>
                        <span>Logout</span>
                    </a>
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

                <?php
                // Set the heading based on the active sidebar item
                $page = basename($_SERVER['PHP_SELF']);
                switch($page) {
                    case 'dashboard.php':
                        echo "Dashboard";
                        break;
                    case 'house.php':
                        echo "Manage Houses";
                        break;
                    case 'customer.php':
                        echo "Customers";
                        break;
                    case 'owner.php':
                        echo "Manage Owners";
                        break;
                    case 'feedback.php':
                        echo "Feedback";
                        break;
                    case 'change_password.php':
                        echo "Account Settings";
                        break;
                    default:
                        echo "Dashboard"; // Default heading if no match is found
                }
                ?>
            </h2>

            <div class="search-wrapper">
                <span class="fas fa-search"></span>
                <input type="search" name="" placeholder="Search here"/>
            </div>

            <div class="user-wrapper">
                <img src="assets/images/biplav.jpg" width="50px" height="50px" alt="">
                <div>
                    <h4>Biplav Ghimire</h4>
                    <small>Super Admin</small>
                </div>
            </div>

        </header>
		<main id="dashboard">	

</body>
</html>
