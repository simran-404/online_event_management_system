<?php
// Include the database connection file
include 'include/connect.php';

session_start(); // Start the session

// Get the form data
$email = pg_escape_string($conn, $_POST['email']);

$sql = "SELECT user_id FROM customer WHERE email = '$email'";
$result = pg_query($conn, $sql);

if (pg_num_rows($result) > 0) {
    // User exists, redirect to OTP page
    header("Location: otp.html");
    exit();
} else {
    // Username does not exist
    header("Location: verify.html?message=Email is not registered&status=error");
    exit();
}

// Close the connection
pg_close($conn);
?>
