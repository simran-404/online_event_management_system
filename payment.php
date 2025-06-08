<?php
include 'include/authorize.php';
// Include the database connection file
include 'include/connect.php'; // This file should handle the PostgreSQL connection setup

// Check if event ID exists in the session
if (!isset($_SESSION['event_id'])) {
    header("Location: event.page.php?status=error&message=" . urlencode("Please create an event to continue"));
    exit();
}

$event_id = $_SESSION['event_id'];

// Get form data and sanitize inputs
$name = pg_escape_string($conn, $_POST['name']);
$card_type = pg_escape_string($conn, $_POST['cardType']);
$card_number = pg_escape_string($conn, $_POST['cardNumber']);
$cvv = pg_escape_string($conn, $_POST['cvv']);
$exp_date = pg_escape_string($conn, $_POST['expiration']);

// Validate expiration date
$current_date = date("Y-m");
if ($exp_date < $current_date) {
    header("Location: payment.page.php?status=error&message=" . urlencode("Card expiration date is invalid."));
    exit();
}

$hashed_cvv = password_hash($cvv, PASSWORD_DEFAULT);
$hashed_card_numberv = password_hash($card_number, PASSWORD_DEFAULT);

// Insert data into the `transaction` table
$query = "INSERT INTO transaction (name, card_type, card_number, cvv, exp_date, event_id) 
          VALUES ('$name', '$card_type', '$hashed_card_numberv', '$hashed_cvv', '$exp_date', $event_id)";

if (pg_query($conn, $query)) {
    // Success - Redirect to success.page.php
    $_SESSION['event_page'] = "success.page.php";
    header("Location: success.page.php");
    exit();
} else {
    // Error - Redirect to payment.page.php with an error message
    $error_message = pg_last_error($conn);
    header("Location: payment.page.php?status=error&message=" . urlencode("Error processing payment: " . $error_message));
    exit();
}

// Close the connection
pg_close($conn);
?>
