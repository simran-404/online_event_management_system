<?php
// Get the current page's filename from the URL
$currentPage = basename($_SERVER['PHP_SELF']);
// Use ternary operator to check if the session is set and not empty, else use default 'event.page.php'
$redirectPage = !empty($_SESSION["event_page"]) ? $_SESSION["event_page"] : "event.page.php";

if($redirectPage !== $currentPage && $_SESSION["event_page"] !== $currentPage){
  // Redirect to the determined page
  header("Location: " . $redirectPage);
  exit();
}

?>