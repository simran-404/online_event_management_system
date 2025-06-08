<?php
// Include the database connection file
include 'include/connect.php';

session_start(); // Start the session

// Get the form data
$username = pg_escape_string($conn, $_POST['username']);
$password = pg_escape_string($conn, $_POST['password']);

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql1="INSERT INTO login(username, password ) VALUES ('$username', '$hashed_password')";
$result1=pg_query($conn,$sql1);

$sql = "SELECT user_id, password FROM customer WHERE username = '$username'";
$result = pg_query($conn, $sql);

if (pg_num_rows($result) > 0) {
    // Fetch the user's hashed password from the database
    $row = pg_fetch_assoc($result);
    $hashed_password = $row['password'];
    $user_id = $row['user_id'];
  // Verify the password
  if (password_verify($password, $hashed_password)) {
    //Save user id in session to user in other place and check authentication
    $_SESSION['user_id'] = $user_id;
    // Password is correct, redirect to package.page.php
    header("Location: dashboard.page.php");
    exit();
  } else{
    // Incorrect password
    header("Location: login.html?message=Invalid password&status=error");
    exit();
  }
}else{
  // Username does not exist
  header("Location: login.html?message=User does not exist&status=error");
  exit();
}
        
// Close the connection
pg_close($conn);
?>
