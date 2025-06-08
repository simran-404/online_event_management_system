<?php
  include 'include/authorize.php';
?>
<html>
  <head>
    
    <link
      href="./assets/css/fonts.css"
      rel="stylesheet"
    />
    <link href="./assets/css/index.css" rel="stylesheet" />
    <title>Dashboard</title>
  </head>
  <style>
    .left> .content {
      width:50% !important;
      margin: auto;
    }
  </style>
  <body>
    <div class="container">
      <div class="left">
        <div class="content">
          
          <span>Welcome</span>
          <h1>Let's Bring Your Event Vision to Life</h1>
          <p>
		        Get one step closer to make your dream event a reality by creating an event or you can check your previous bookings. For deatils about our packages, click on Budget details.
          </p>
          <div class="btns">
          <button class="form-btn"><a href="events.page.php">Your Events</a></button>
          <button class="form-btn"><a href="package.page.php">Create Event</a></button>
          <button class="form-btn"><a href="details.html">Budget details</a></button>
          <button class="form-btn logout"><a href="logout.php">Logout</a></button>
        </div>
        </div>
      </div>
    </div>
  </body>
</html>
