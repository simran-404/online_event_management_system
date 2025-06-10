<?php
// Database credentials
$host = "dpg-d13tkqq4d50c73eb7ck0-a";
$port = "5432";
$dbname = "eventdb_xjfq";
$username = "eventdb_xjfq_user";
$password = "yT1ax0PzKprZ56RWZtdrpB2eiBr4f1it";

// Create a connection string
$conn_string = "host=$host port=$port dbname=$dbname user=$username password=$password";

// Establish the connection
$conn = pg_connect($conn_string);

// Check the connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

?>
