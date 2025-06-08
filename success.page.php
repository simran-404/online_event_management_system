<?php
include 'include/authorize.php';
include 'include/check_event_step.php';
include 'include/connect.php';

$event_id = $_SESSION["event_id"];

// Fetch event details from the database
$query = "SELECT * FROM event WHERE event_id = $event_id";
$event_result = pg_query($conn, $query);

if (pg_num_rows($event_result) > 0) {
    $event = pg_fetch_assoc($event_result);
    // Fetch decorations details
    $decoration_query = "SELECT * FROM decoration WHERE event_id = $event_id";
    $decoration_result = pg_query($conn, $decoration_query);
    $decoration = pg_fetch_assoc($decoration_result);
    $decor_id = $decoration['decor_id'];
    // Fetch flowers details
    $flower_query = "SELECT * FROM flower WHERE decor_id = $decor_id";
    $flower_result = pg_query($conn, $flower_query);
    $flowers = [];
    while ($flower = pg_fetch_assoc($flower_result)) {
        $flowers[] = $flower['flower_name'];
    }

    // Fetch catering menu items
    $activity_query = "SELECT * FROM activity WHERE event_id = $event_id";
    $activity_result = pg_query($conn, $activity_query);
    $activity_items = [];
    while ($activity_item = pg_fetch_assoc($activity_result)) {
        $activity_items[] = $activity_item['activity_name'];
    }

  // Fetch activity items
    $catering_query = "SELECT * FROM catering WHERE event_id = $event_id";
    $catering_result = pg_query($conn, $catering_query);
    $catering_items = [];
    while ($catering_item = pg_fetch_assoc($catering_result)) {
        $catering_items[] = $catering_item['food_preference'];
    }

    $package_id = $event["package_id"];
    $package_query = "SELECT * FROM package WHERE package_id = $package_id";
    $package_result = pg_query($conn, $package_query);
    $package = pg_fetch_assoc($package_result);

} else {
    // If the event is not found, redirect to payment.page.php
    header("Location: event.page.php");
    exit();
}

pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
      type="module"
    ></script>
    <link
      href="./assets/css/fonts.css"
      rel="stylesheet"
    />
    <link href="./assets/css/index.css" rel="stylesheet" />
    <title>Payment Page</title>
  </head>
  <style>
    .form-btn {
      margin-top: 20px;
    }
    .info {
      border-bottom:0px;
      margin-bottom:0px;
      padding-bottom:0px;
      font-size:0.8rem !important;
      color:white;
    }
    .info > span:nth-child(2) {
      color:#CC7825;
      margin-left: 10px;
      font-weight:600
    }
    @media print {
    body {
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    img {
      max-width: 100%;
      display: block; /* Ensures images are visible */
    }

    .btns {
      display: none; /* Hide buttons in print view */
    }
  }
  </style>

  <body>
    <div class="container">
      <div class="left">
        <div class="form details">
          <h2>Event Details</h2>
          <p>All your payment details In One Place</p>
          <!-- EVENT INFO -->
        
        <p class="info">
        <span>Date</span>
        <span><?php echo $event['event_date'] ?></span>
        </p>
          <p class="info">
            <span>Time</span>
            <span><?php echo $event['start_time'].' - '.$event['end_time'] ?></span>
          </p>
        <p class="info">
            <span>Location</span>
            <span><?php echo $event['venue'].', '.$event['location']; ?></span>
          </p>
          <br />

          <!-- Decoration INFO -->
          <div>
            <h2>Decorations</h2>
            <div class="lists">
                <div class="list">
                  <img src="./assets/img/tick.svg" />
                  <span><?php echo $decoration['curtain']; ?> curtain</span>
                </div>
                <div class="list">
                  <img src="./assets/img/tick.svg" />
                  <span><?php echo $decoration['carpet']; ?> Carpet </span>
                </div>
                <div class="list">
                  <img src="./assets/img/tick.svg" />
                  <span><?php echo $decoration['chairs']; ?> Chairs </span>
                </div>
                <div class="list">
                  <img src="./assets/img/tick.svg" />
                  <span><?php echo $decoration['tables']; ?> Tables </span>
                </div>
                <?php if (!empty($flowers)): ?>
                     <div class="list">
                        <img src="./assets/img/tick.svg" />
                        <span>Flowers: <?php echo join(", ", $flowers); ?></span>
                     </div>
                <?php endif; ?>
            </div>
          </div>
          <br />
          <!-- Catering INFO -->
          <div>
            <h2>Menu</h2>
            <div class="lists">
              <?php foreach ($catering_items as $item): ?>
                <div class="list">
                  <img src="./assets/img/tick.svg" />
                  <span><?php echo $item; ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <br /><br/>

 <!-- activity INFO -->
          <div>
            <h2>Activities</h2>
            <div class="lists">
              <?php foreach ($activity_items as $item): ?>
                <div class="list">
                  <img src="./assets/img/tick.svg" />
                  <span><?php echo $item; ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <br /><br/>
          <!-- BUDGET INFO -->
          <div class="package">
            <h2>
          <?php echo $package["name"]?>
        </h2>
            <p>Total Amount ₹<?php echo $package['price']; ?></p>
          </div>
        </div>
      </div>

      <div class="right">
        <div class="form">
          <div class="success">
            <div class="animation">
              <img
                src="assets/img/correct.png"
                background="transparent"
                speed="1"
                style="width: 250px; height: 250px; margin: auto"
                loop
                autoplay
              >
            </div>
            <p>Paid: ₹<?php echo $package['price']; ?></p>
            <h3>Payment Successful</h3>
            <p>All your payment details In One Place</p>
            
            <div class="btns">
              <button class="save-btn btn-animate" type="submit">
                <a href="dashboard.page.php">Dashboard</a>
              </button>
              <button class="save-btn btn-animate" type="submit">
                <a href="feedback.page.php">Give Feedback</a>
              </button>
              <button class="save-btn btn-animate" onclick="printBill()">Print Bill</button>
            </div>
          </div>
        </div>

      </div>
    </div>
    <script>
      function printBill() {
      const images = document.querySelectorAll("img");
      images.forEach(img => img.style.display = "block"); // Ensure images are not hidden
      window.print();
      }
    </script>

    <?php
      unset($_SESSION['event_id']);
      unset($_SESSION['event_page']);
    ?>
  </body>
</html>
