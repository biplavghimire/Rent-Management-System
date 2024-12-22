<?php
session_start();
$uid=$_SESSION['uid'];
if(!$uid){
	header(header:"location:index.php");
}
include 'db_connect.php';

$user_id = $_SESSION['uid']; // Assuming user ID is stored in session

// Query to fetch the transaction history of the user
$sql = "SELECT house_id, payment_amount, payment_date, payment_type, remaining_amount
        FROM payment
        WHERE user_id = ?";

$stmt = mysqli_stmt_init($conn);
$transactions = [];

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $transactions[] = $row;
    }
} else {
    // Handle error if SQL fails
    echo json_encode([]);
    exit();
}

// Return the transaction data as a JSON response
echo json_encode($transactions);
?>
