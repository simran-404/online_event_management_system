<?php
include 'include/authorize.php';
// Include the database connection file
include 'include/connect.php';

if (!isset($_SESSION['event_id'])) {
    header("Location: event.page.php?message=Please+create+an+event+to+continue&status=error");
    exit();
}

$event_id = $_SESSION['event_id'];

// Retrieve form data
$food_preference = pg_escape_string($conn, $_POST['menu']);

// Insert into the catering table
$query = "INSERT INTO catering (food_preference, event_id) VALUES ('$food_preference', $event_id)";

if (pg_query($conn, $query)) {
    // Success - Redirect to the next page
    $_SESSION['event_page'] = 'payment.page.php';
    header("Location: payment.page.php");
} else {
    $error_message = pg_last_error($conn);
    header("Location: menu.page.php?status=error&message=" . urlencode("Error+saving+menu:+" . $error_message));
}

// Close the connection
pg_close($conn);
exit();
?>
