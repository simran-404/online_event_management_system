<?php
// Check user is login or not
include 'include/authorize.php';
// Include the database connection file
include 'include/connect.php';

// Retrieve form data
$event_date = pg_escape_string($conn, $_POST['event-date']);
$location = pg_escape_string($conn, $_POST['location']);
$venue = pg_escape_string($conn, $_POST['venue']);
$start_time = pg_escape_string($conn, $_POST['event-start-time']);
$end_time = pg_escape_string($conn, $_POST['event-end-time']);
$package = (int)$_POST['package'];

// Combine date and time to create DateTime objects
$start_datetime_str = $event_date . ' ' . $start_time;
$end_datetime_str = $event_date . ' ' . $end_time;

//Handle the day switch.
$start = DateTime::createFromFormat('Y-m-d H:i', $start_datetime_str);
$end = DateTime::createFromFormat('Y-m-d H:i', $end_datetime_str);

if ($end < $start) {
    // If the end time is before the start time, add one day to the end time.
    $end->modify('+1 day');
}

// Check if start time and end time are the same
if ($start == $end) {
    header("Location: event.page.php?status=error&message=" . urlencode("Please select an appropriate time. Start and end time cannot be the same."));
    exit();
}

// Get duration in hours
$duration_interval = $start->diff($end);
$duration = ($duration_interval->days * 24) + $duration_interval->h + ($duration_interval->i / 60);

// Set maximum allowed hours based on package_id
$max_hours = 0;
if ($package == 1) {
    $max_hours = 8;
} elseif ($package == 2) {
    $max_hours = 16;
} elseif ($package == 3) {
    $max_hours = 23;
}

// Validate event duration
if ($duration > $max_hours) {
    header("Location: event.page.php?status=error&message=" . urlencode("You can select up to $max_hours hours for this package."));
    exit();
}

// Check if the slot is available
$conflict_query = "
    SELECT event_id FROM event 
    WHERE location = '$location' 
        AND venue = '$venue' 
        AND event_date = '$event_date'
        AND (
            (start_time <= '$start_time' AND end_time > '$start_time')  -- New event starts within existing event
            OR (start_time < '$end_time' AND end_time >= '$end_time')    -- New event ends within existing event
            OR (start_time >= '$start_time' AND end_time <= '$end_time')  -- Existing event is fully inside new event
            OR (start_time <= '$start_time' AND end_time >= '$end_time')  -- New event is fully inside existing event
        )";

$conflict_result = pg_query($conn, $conflict_query);

if (pg_num_rows($conflict_result) > 0) {
    // Slot is already booked, redirect with an error message
    header("Location: event.page.php?status=error&message=" . urlencode("The selected time slot is already booked."));
    exit();
}

// Construct the SQL query
$query = "INSERT INTO event (package_id, event_date, location, venue, start_time, end_time, user_id) 
                VALUES ($package, '$event_date', '$location', '$venue', '$start_time', '$end_time', $user_id) RETURNING event_id";

// Execute the query
$result = pg_query($conn, $query);

if ($result) {
    // Retrieve the last inserted event ID
    $row = pg_fetch_assoc($result);
    $event_id = $row['event_id'];

    // Store the event ID in the session, to use in other forms and link other event data to the event
    $_SESSION['event_id'] = $event_id;
    $_SESSION['event_page'] = 'activity.page.php';

    // Success - Redirect to activities.html
    header("Location: activity.page.php");
    exit();
} else {
    // Error - Redirect to event.page.php
    $error_message = pg_last_error($conn);
    header("Location: event.page.php?status=error&message=" . urlencode("Error saving event: " . $error_message));
    exit();
}

// Close the connection
pg_close($conn);
?>
