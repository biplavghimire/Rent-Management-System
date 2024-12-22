<?php
session_start();
$uid=$_SESSION['uid'];
if(!$uid){
	header(header:"location:index.php");
}

// Include the database connection
include 'db_connect.php';

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['uid'])) {
    header('Location: login.php'); // Assuming you have a login page
    exit;
}

// Fetch booked houses for the logged-in user by joining with houseinfo table
$user_id = $_SESSION['uid']; // Assuming user ID is stored in session
$sql_view_booked = "
    SELECT houseinfo.* 
    FROM houseinfo
    INNER JOIN book ON houseinfo.h_id = book.h_id
    WHERE book.c_uid = ?";
    
$stmt = mysqli_stmt_init($conn);
$booked_houses = [];

if (!mysqli_stmt_prepare($stmt, $sql_view_booked)) {
    echo "<div class='col-12'><h4>No houses found that you have booked. Please try again later.</h4></div>";
} else {
    // Bind user ID parameter to the SQL statement
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Fetch all booked house records
    while ($row = mysqli_fetch_assoc($result)) {
        $booked_houses[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['paymentType'])) {
    // Get the posted payment information
    $paymentType = $_POST['paymentType'];
    $houseId = $_POST['houseId'];
    $paymentAmount = $_POST['paymentAmount']; // Payment amount entered by the user

    // Fetch the current house price and payment details
    $sql_get_house = "SELECT price, payment FROM houseinfo WHERE h_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql_get_house)) {
        mysqli_stmt_bind_param($stmt, 'i', $houseId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $house = mysqli_fetch_assoc($result);

        $currentPayment = $house['payment'];
        $price = $house['price'];

        // Calculate the new payment value
        if ($paymentType === 'full') {
            $newPayment = $price;  // Full payment
        } else {
            $newPayment = $currentPayment + $paymentAmount;  // Partial payment
        }

        // Insert payment details into the payment_history table
        $sql_insert_payment = "INSERT INTO payment (user_id, house_id, payment_date, payment_amount, payment_type, payment_method, remaining_amount, payment_status)
                               VALUES (?, ?, NOW(), ?, ?, ?, ?, 'completed')";
        if (mysqli_stmt_prepare($stmt, $sql_insert_payment)) {
            $user_id = $_SESSION['uid']; // Assuming user ID is stored in session
            $payment_method = 'bank_transfer'; // You can adjust this as per the method (cash, online, etc.)
            $remainingAmount = $price - $newPayment;  // Remaining amount after payment

            // Bind parameters and execute the query to insert payment history
            mysqli_stmt_bind_param($stmt, 'iiisss', $user_id, $houseId, $paymentAmount, $paymentType, $payment_method, $remainingAmount);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Payment recorded successfully');</script>";
            } else {
                echo "<script>alert('Error inserting payment into history');</script>";
            }
        }

        // Update the houseinfo table with the new payment value
        $sql_update_payment = "UPDATE houseinfo SET payment = ? WHERE h_id = ?";
        if (mysqli_stmt_prepare($stmt, $sql_update_payment)) {
            $remainingAmount = $price - $newPayment; // Calculate remaining amount
            mysqli_stmt_bind_param($stmt, 'di', $newPayment, $houseId);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Payment updated successfully');</script>";
                echo "<script>window.location.href = window.location.href ;</script>";  // Refresh page after successful payment
            } else {
                echo "<script>alert('Error updating house payment');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Houses</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
                <li><a href="house_detail1.php"><i class="fas fa-home"></i> Houses</a></li>
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
    <div class="headline">Your Booked Houses <a style="float:right;" href="#" data-bs-toggle="modal" data-bs-target="#transactionModal" id="viewTransactions">View Transactions</a></div>
    <div class="row text-center py-5">
        <?php
        if (empty($booked_houses)) {
            echo "<div class='col-12'><h4>You have not booked any houses yet.</h4></div>";
        } else {
            // Loop through each booked house and display its information
            foreach ($booked_houses as $house) {
                $remainingAmount = $house['price'] - $house['payment'];
        ?>
            <div class="col-md-3 col-sm-6 my-0">
                <form action="" method="post">
                    <div class="card shadow">
                        <div>
                            <?php
                            // Assuming 'image' column exists in the houseinfo table
                            $image = htmlspecialchars($house['image']);
                            echo "<img src='assets/images/$image' alt='Image not available' class='img-fluid card-img-top'>";
                            ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title my-0">
                                <div class="font">A <?php echo htmlspecialchars($house['room_type']); ?> you booked in</div>
                                <div class="font1">
                                    <i class="fa fa-map-marker"></i> <?php echo htmlspecialchars($house['location']); ?>
                                </div>
                            </h5>
                            <p class="card-text my-0">Price: Rs. <?php echo htmlspecialchars($house['price']); ?> (/month)</p>
                            <p class="card-text my-0 underline">This Month</p>
                            <p class="card-text my-0">Payment: Rs.  <?php echo htmlspecialchars($house['payment']); ?></p>
                            <p class="card-text my-0">Remaining: Rs.  <?php echo htmlspecialchars($remainingAmount); ?></p>

                            <div class="btn-group w-100 my-1">
                                <button type="button" class="btn btn-sm btn-outline-success w-50" data-bs-toggle="modal" data-bs-target="#paymentModal" data-price="<?php echo htmlspecialchars($house['price']); ?>" data-remaining="<?php echo htmlspecialchars($remainingAmount); ?>" data-houseid="<?php echo htmlspecialchars($house['h_id']); ?>">Pay Now</button>
                            </div>
                            <div class="btn-group w-100">
                                <a href="detail_info.php?h_id=<?php echo htmlspecialchars($house['h_id']); ?>" class="btn btn-sm btn-outline-info w-50">View Details</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<!-- Modal for Transaction History -->
<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionModalLabel">Transaction History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>House ID</th>
                            <th>Payment Amount</th>
                            <th>Payment Date</th>
                            <th>Payment Type</th>
                            <th>Remaining Amount</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTableBody">
                        <!-- Payment history rows will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Payment -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Options</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm" action="" method="POST">
                    <p>Amount: Rs. <span id="amount">0</span></p>
                    <p>Remaining: Rs. <span id="remainingAmount">0</span></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentType" id="fullPayment" value="full">
                        <label class="form-check-label" for="fullPayment">
                            Full Payment
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentType" id="partialPayment" value="partial">
                        <label class="form-check-label" for="partialPayment">
                            Partial Payment
                        </label>
                    </div>
                    <div id="partialAmount" style="display: none;">
                        <label for="amountInput">Enter Partial Amount:</label>
                        <input type="number" class="form-control" id="amountInput" name="paymentAmount" placeholder="Amount to pay">
                    </div>
                    <input type="hidden" id="houseId" name="houseId">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
// Fetch and display transactions when the modal is shown
document.getElementById('viewTransactions').addEventListener('click', function() {
    fetch('fetch_transaction.php')  // Make the AJAX request to fetch the data
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('transactionTableBody');
            tableBody.innerHTML = '';  // Clear any existing data

            // Check if there are transactions
            if (data.length > 0) {
                data.forEach(transaction => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${transaction.house_id}</td>
                        <td>Rs. ${transaction.payment_amount}</td>
                        <td>${transaction.payment_date}</td>
                        <td>${transaction.payment_type}</td>
                        <td>Rs. ${transaction.remaining_amount}</td>
                    `;
                    tableBody.appendChild(row);
                });
            } else {
                tableBody.innerHTML = '<tr><td colspan="5">No transaction history found.</td></tr>';
            }
        })
        .catch(error => {
            console.error('Error fetching transaction data:', error);
            document.getElementById('transactionTableBody').innerHTML = '<tr><td colspan="5">Error fetching transaction data.</td></tr>';
        });
});

// Set values for the payment modal when it is opened
document.getElementById('paymentModal').addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget; 
    var houseId = button.getAttribute('data-houseid');
    var price = button.getAttribute('data-price');
    var remaining = button.getAttribute('data-remaining');
    
    // Set the hidden input value for houseId
    document.getElementById('houseId').value = houseId;
    
    // Set the displayed amount and remaining amount
    document.getElementById('amount').textContent = price;
    document.getElementById('remainingAmount').textContent = remaining;
    
    // Show or hide the partial payment input based on selected payment type
    var fullPaymentRadio = document.getElementById('fullPayment');
    var partialPaymentRadio = document.getElementById('partialPayment');
    var partialAmountDiv = document.getElementById('partialAmount');
    
    fullPaymentRadio.addEventListener('change', function() {
        partialAmountDiv.style.display = 'none';
    });
    
    partialPaymentRadio.addEventListener('change', function() {
        partialAmountDiv.style.display = 'block';
    });
});
</script>

</body>
</html>