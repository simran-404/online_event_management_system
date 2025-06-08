<?php
// Check user is logged in or not
include 'include/authorize.php';
// Include the database connection file
include 'include/connect.php';

// Check if an event is selected
if (!isset($_SESSION['event_id'])) {
    header("Location: event.page.php?message=Please+create+an+event+to+continue&status=error");
    exit();
}

$event_id = $_SESSION['event_id'];

// Retrieve the package_id for the event
$package_query = "SELECT package_id FROM event WHERE event_id = $event_id";
$package_result = pg_query($conn, $package_query);

if (!$package_result) {
    $error_message = pg_last_error($conn);
    header("Location: event.page.php?status=error&message=" . urlencode("Error retrieving package: " . $error_message));
    exit();
}

$package_row = pg_fetch_assoc($package_result);
$package_id = (int) $package_row['package_id']; // Ensure it's an integer

// Define activity limits based on package_id
$activity_limit = 0;
if ($package_id == 1) {
    $activity_limit = 2;
} elseif ($package_id == 2) {
    $activity_limit = 4;
} elseif ($package_id == 3) {
    $activity_limit = 6;
}

// Check if the activity data is present in the request
if (!isset($_POST['activity']) || empty($_POST['activity'])) {
    header("Location: activity.page.php?message=Please+select+at+least+one+activity&status=error");
    exit();
}

// Get the activities from the request
$activities = $_POST['activity'];

// Validate the number of selected activities
if (count($activities) > $activity_limit) {
    header("Location: activity.page.php?status=error&message=" . urlencode("You can select only $activity_limit activities for this package."));
    exit();
}

// Insert each selected activity into the database
foreach ($activities as $activity_name) {
    $activity_name = pg_escape_string($conn, $activity_name); // Sanitize input
    $query = "INSERT INTO activity (activity_name, event_id) VALUES ('$activity_name', $event_id)";

    if (!pg_query($conn, $query)) {
        $error_message = pg_last_error($conn);
        header("Location: activity.page.php?status=error&message=" . urlencode("Error saving activity: " . $error_message));
        exit();
    }
}

$_SESSION['event_page'] = 'decoration.page.php';
// Redirect to decoration.page.php on success
header("Location: decoration.page.php");
exit();

// Close the connection
pg_close($conn);
?>
