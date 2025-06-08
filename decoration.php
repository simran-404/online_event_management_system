<?php
// Check user is logged in or not
include 'include/authorize.php';
// Include the database connection file
include 'include/connect.php';

// Check if the user is logged in and if an event ID exists
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html?message=Please+log+in+to+continue&status=error");
    exit();
}

if (!isset($_SESSION['event_id'])) {
    header("Location: event.page.php?message=Please+create+an+event+to+continue&status=error");
    exit();
}

$event_id = $_SESSION['event_id'];

// Fetch the package from the event
$package_query = "SELECT package_id FROM event WHERE event_id = $event_id";
$package_result = pg_query($conn, $package_query);

if ($package_result) {
    $package_row = pg_fetch_assoc($package_result);
    $package = (int)$package_row['package_id']; // Ensure it's treated as an integer
} else {
    $error_message = pg_last_error($conn);
    header("Location: decoration.page.php?status=error&message=" . urlencode("Error+retrieving+package:+" . $error_message));
    exit();
}

// Retrieve form data
$carpet = pg_escape_string($conn, $_POST['carpet']);
$curtain = pg_escape_string($conn, $_POST['curtain']);
$chairs = (int)$_POST['chairs'];
$tables = (int)$_POST['tables'];
$flowers = isset($_POST['flowers']) ? $_POST['flowers'] : []; // Ensure it's an array

// Determine limits based on the package
$flower_limit = 0;
$max_chairs = 0;
$max_tables = 0;

if ($package == 1) {
    $flower_limit = 1;
    $max_chairs = 35;
    $max_tables = 18;
} elseif ($package == 2) {
    $flower_limit = 2;
    $max_chairs = 70;
    $max_tables = 35;
} elseif ($package == 3) {
    $flower_limit = 4;
    $max_chairs = 140;
    $max_tables = 70;
}

// Validate the number of selected flowers
if (count($flowers) > $flower_limit) {
    header("Location: decoration.page.php?status=error&message=" . urlencode("You can select only " . $flower_limit . " flowers for this package."));
    exit();
}

// Validate the number of chairs and tables
if ($chairs > $max_chairs) {
    header("Location: decoration.page.php?status=error&message=" . urlencode("You can select up to " . $max_chairs . " chairs for this package."));
    exit();
}

if ($tables > $max_tables) {
    header("Location: decoration.page.php?status=error&message=" . urlencode("You can select up to " . $max_tables . " tables for this package."));
    exit();
}

// Insert into the decoration table
$insert_decoration = "INSERT INTO decoration (carpet, curtain, tables, chairs, event_id) 
                      VALUES ('$carpet', '$curtain', $tables, $chairs, $event_id) 
                      RETURNING decor_id";

$result = pg_query($conn, $insert_decoration);

if ($result) {
    // Get the last inserted decor_id
    $row = pg_fetch_assoc($result);
    $decor_id = $row['decor_id'];

    // Insert selected flowers into the flower table
    foreach ($flowers as $flower_name) {
        $flower_name = pg_escape_string($conn, $flower_name);
        $insert_flower = "INSERT INTO flower (flower_name, decor_id) 
                          VALUES ('$flower_name', $decor_id)";
        if (!pg_query($conn, $insert_flower)) {
            $error_message = pg_last_error($conn);
            header("Location: decoration.page.php?status=error&message=" . urlencode("Error+saving+flower:+" . $error_message));
            exit();
        }
    }

    $_SESSION['event_page'] = 'menu.page.php';
    // Success - Redirect to the next page
    header("Location: menu.page.php");
    exit();
} else {
    $error_message = pg_last_error($conn);
    header("Location: decoration.page.php?status=error&message=" . urlencode("Error+saving+decoration:+" . $error_message));
    exit();
}

// Close the connection
pg_close($conn);
?>
