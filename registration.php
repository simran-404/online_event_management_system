<?php
// Include the database connection file
include 'include/connect.php';

// Get the form data
$firstname = pg_escape_string($conn, $_POST['firstname']);
$lastname = pg_escape_string($conn, $_POST['lastname']);
$email = pg_escape_string($conn, $_POST['email']);
$contact = pg_escape_string($conn, $_POST['contact']);
$gender = pg_escape_string($conn, $_POST['gender']);
$username = pg_escape_string($conn, $_POST['username']);
$password = pg_escape_string($conn, $_POST['password']);
$confirm_password = pg_escape_string($conn, $_POST['confirm-password']);

// Check if passwords match
if ($password !== $confirm_password) {
  header("Location: registration.html?message=Passwords do not match");
  exit();
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL query to insert the user into the database
$sql = "INSERT INTO customer(firstname, lastname, email, contact, gender, username, password)
VALUES ('$firstname', '$lastname', '$email', '$contact', '$gender', '$username', '$hashed_password')";

// Execute the query
$result = pg_query($conn, $sql);
    
if ($result) {
    // Redirect to login page with success message
    header("Location: login.html?message=Registration successful&status=success");
    exit();
} else {
    $error = pg_last_error($conn);
    if (strpos($error, "duplicate key value violates unique constraint") !== false) {
      $errorMessage = "Username or Email already exists. Please choose another.";
    } else {
      $errorMessage = "Database error: " . $error;
    }
    // Redirect to registration page with SQL error message
    header("Location: registration.html?message=" . urlencode($errorMessage));
    exit();
}

// Close the connection
pg_close($conn);
?>

	
