<?php
  include 'include/authorize.php';
  include 'include/connect.php';

  // Fetch events for the logged-in user
$query = "SELECT 
    event.*, 
    package.*
FROM 
    event
JOIN 
    package ON event.package_id = package.package_id 
WHERE 
    event.user_id = $user_id 
ORDER BY 
    event.event_date ASC";

$result = pg_query($conn, $query);

if (!$result) {
    die("Error fetching events: " . pg_last_error($conn));
}

?>
<html>
  <head>
    
    <link
      href="./assets/css/fonts.css"
      rel="stylesheet"
    />
    <link href="./assets/css/index.css" rel="stylesheet" />
    <title>Your Events</title>
  </head>
  <style>
    .left> .content {
      width:70% !important;
      margin:0 auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      border-radius:10px;
      overflow:hidden;
    }

    th, td {
      padding: 10px;
      text-align: left;
      color: white;
      font-family: "Syne", Arial, sans-serif;
    }

    th {
      font-weight: bold;
      background-color: #27120b;
    }
    tr {
      border-bottom: 1px solid grey;
      transition:all 0.3s;
      
      background-color: rgba(52, 13, 12, 0.46);
    }
    tr:hover {
      transform:scale(0.9);
    }

    tr:last-child {
      border-bottom: none;
    }
    tbody td {
      font-family:"DM Sans" !important;
      font-size:0.9rem
    }
    .btn-container{
      padding:15;
    }
  </style>
  <body>
    <div class="container">
      <div class="left">
        <div class="content">
          
        <h1>Events</h1>
        <table>
    <thead>
        <tr>
            <th>Location</th>
            <th>Venue</th>
            <th>Date</th>
            <th>Time (From - To)</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = pg_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['location']) ?></td>
                                <td><?= htmlspecialchars($row['venue']) ?></td>
                                <td><?= htmlspecialchars($row['event_date']) ?></td>
                                <td><?= htmlspecialchars($row['start_time']) . " - " . htmlspecialchars($row['end_time']) ?></td>
                                <td>₹<?= htmlspecialchars($row['price']) ?></td>
                              </tr>
                        <?php endwhile; ?>
    </tbody>
</table>

          
        </div>
      </div>
      <div class="btn-container">
            <button type="submit" class="form-btn">
                <a href="dashboard.page.php">Dashboard</a>
            </button>
        </div>
    </div>
  </body>
</html>
