<?php
// Database credentials
$host = "192.168.16.1";
$port = "5432";
$dbname = "tyb12";
$username = "tyb12";
$password = "";

// Create a connection string
$conn_string = "host=$host port=$port dbname=$dbname user=$username";

// Establish the connection
$conn = pg_connect($conn_string);

// Check the connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

?>
