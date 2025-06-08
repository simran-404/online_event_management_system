<?php
// Check if the user is logged in
include 'include/authorize.php';
// Include the database connection file
include 'include/connect.php';

// Retrieve form data
$username = pg_escape_string($conn, $_POST['username']);
$email = pg_escape_string($conn, $_POST['email']);
$comments = pg_escape_string($conn, $_POST['comments']);
$overall_experience = pg_escape_string($conn, $_POST['oe']);
$timely_response = pg_escape_string($conn, $_POST['tr']);
$our_support = pg_escape_string($conn, $_POST['os']);
$overall_satisfaction = pg_escape_string($conn, $_POST['osat']);

// Check if the user exists in the 'customer' table
$user_check_sql = "SELECT user_id FROM customer WHERE username = '$username' AND email = '$email'";
$user_check_result = pg_query($conn, $user_check_sql);

if (pg_num_rows($user_check_result) > 0) {
    // User exists, insert feedback
    $sql = "INSERT INTO feedback (username, email, comments, over_exp, time_resp, over_supp, over_satis) 
            VALUES ('$username', '$email', '$comments', '$overall_experience', '$timely_response', '$our_support', '$overall_satisfaction')";

    if (pg_query($conn, $sql)) {
        // On successful insert, redirect with success message
        header("Location: feedback.page.php?message=Thank you for your valuable feedback!&status=success");
        exit();
    } else {
        // If there's an error, redirect back with an error message
        header("Location: feedback.page.php?message=" . urlencode("Failed to submit feedback: " . pg_last_error($conn)) . "&status=error");
        exit();
    }
} else {
    // User does not exist, redirect back with an error message
    header("Location: feedback.page.php?message=" . urlencode("User does not exist. Please register before submitting feedback.") . "&status=error");
    exit();
}

// Close the database connection
pg_close($conn);
?>
