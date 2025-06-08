<?php
  session_start();
  // Retrieve the user ID from the session
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.html?status=error&message=Please+login+before+creating+event");
    exit();
  }
  $user_id = $_SESSION['user_id'];
?>