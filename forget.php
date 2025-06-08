<?php
// Include the database connection file
include 'include/connect.php';

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

// Check if the username exists
$query = "SELECT * FROM customer WHERE username = '$username'";
$result = pg_query($conn,$query);

if (pg_num_rows($result) === 0) {
    header("Location: forget.html?message=User not found with this username!&status=error");
    exit;
}

// Check if the passwords match
if ($password !== $confirmPassword) {
    header("Location: forget.html?message=Passwords do not match!&status=error");
    exit;
}

// Hash the new password (important for security)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// Update the password in the database
$updateQuery = "UPDATE customer SET password = '$hashedPassword' WHERE username = '$username'";
if (pg_query($conn,$updateQuery)) {
    header("Location: login.html?message=Password reset successful!&status=success");
} else {
    header("Location: forget.html?message=Error updating password!");
}

pg_close($conn);
?>
