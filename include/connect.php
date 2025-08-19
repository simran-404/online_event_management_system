<?php
// Database credentials
$host = "db.cyjgtavvcsrtvehmnjmz.supabase.co";
$port = "5432";
$dbname = "postgres";
$username = "postgres";
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
