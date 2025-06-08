<?php
include 'include/authorize.php';
include 'include/check_event_step.php';
include 'include/connect.php';

// Fetch event details from the database
$query = "SELECT * FROM package";
$result = pg_query($conn, $query);
$packages = pg_fetch_all($result);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link
      href="./assets/css/fonts.css"
      rel="stylesheet"
    />
    <link href="./assets/css/index.css" rel="stylesheet" />
    <title>Event Registration</title>
    <style>
      .form {
        max-height: 80%;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="left">
        <div class="content">
          <img src="assets/img/decorgif.gif">
          <h1>Let's Bring Your Event Vision to Life</h1>
          <p>
            Our platform helps you plan and manage events easily. From registration to schedules, everthing in one place. Whether it's a birthday, wedding or corporate party, we 
            make event management hassle-free!
          </p>
          <p style="color:white;"><strong>⏳Instructions for maximum duration</strong></p>
          <p style="color:white;">
            💸8 hours for Budget package<br>
            🌟16 hours for Premium package<br>
            👑23 hours for Luxury package
          </p>
        </div>
    </p>
      </div>
      <div class="right">
        <div class="form form-short">
          <form class="event-form" action="event.php" method="POST">
            <h2>Event Registration</h2>

            <p id="message"></p>

            <!-- Event Name Dropdown 
        <label for="eventname">Event Name:</label>
        <select id="eventname" name="eventname" required>
            <option value="" disabled selected>Select Event</option>
            <option value="Birthday">Birthday</option>
            <option value="Babyshower">Babyshower</option>
            <option value="Anniversary">Anniversary</option>
        </select>-->

            <div class="grid-fields">
              <!-- Location Dropdown -->
              <div class="input-group select-group">
                <label for="location">Location</label>
                <select
                  id="location"
                  name="location"
                  onchange="updateVenue()"
                  required
                >
                  <option value="" disabled selected>Select Location</option>
                  <option value="Viman Nagar">Viman Nagar</option>
                  <option value="Hadapsar">Hadapsar</option>
                  <option value="Deccan">Deccan</option>
                  <option value="Katraj">Katraj</option>
                  <option value="Camp">Camp</option>
		              <option value="Kondhwa">Kondhwa</option>
		              <option value="Shivaji Nagar">Shivaji Nagar</option>
		              <option value="Kothrud">Kothrud</option>
		              <option value="Hinjewadi">Hinjewadi</option>
		              <option value="Kharadi">Kharadi</option>
                </select>
              </div>

              <!-- Venue Dropdown (populated dynamically) -->
              <div class="input-group select-group">
                <label for="venue">Venue</label>
                <select id="venue" name="venue" required>
                  <option value="" disabled selected>Select Venue</option>
                </select>
              </div>
            </div>

            <div class="input-group select-group">
              <label for="package">Package Price</label>
              <select id="" name="package" required>
                <option value="" disabled selected>Select package price</option>
                <?php foreach ($packages as $item): ?>
                   <option value='<?php echo $item['package_id'] ?>'>
                    <?php echo $item["name"].' - ₹'. $item["price"] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="input-group">
              <!-- Event Date -->
              <label for="event-date">Event Date:</label>
              <input type="date" id="event-date" name="event-date" required />
            </div>

            <div class="grid-fields">
              <!-- Event Time -->
              <div class="input-group">
                <label for="event-start-time">Event Start Time:</label>
                <input
                  type="time"
                  id="event-start-time"
                  name="event-start-time"
                  required
                  placeholder="hrs:min"
                />
              </div>
              <div class="input-group">
                <label for="event-end-time">Event End Time:</label>
                <input
                  type="time"
                  id="event-end-time"
                  name="event-end-time"
                  required
                  placeholder="hrs:min"
                />
              </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="form-btn">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </body>
  <script defer>
    //Show error or success message recevied from backend through url
    const searchParams = new URLSearchParams(window.location.search);
    const msg = searchParams.get("message");
    const status = searchParams.get("status") || "error";
    //Show message to user
    if (msg) {
      const messageEl = document.getElementById("message");
      messageEl.textContent = msg;
      messageEl.className = status;
    }
  </script>
  <script defer>
    // JavaScript for dynamic venue selection
    function updateVenue() {
      const location = document.getElementById("location").value;
      const venueSelect = document.getElementById("venue");
      let venues = [];

      // Clear previous options
      venueSelect.innerHTML = "";

      // Populate venues based on location
      if (location === "Viman Nagar") {
        venues = ["Her Highness Hall", "Roofdine Hall","Cocoparra","Hotel Park Estique"];
      } else if (location === "Hadapsar") {
        venues = ["Royal Moments Banquet", "Aashiyana Hall","Symphony Hall","Asodit Banquets"];
      } else if (location === "Deccan") {
        venues = ["Ranjeet Banquets", "Shreyash Hall","Swapnashilp Hall","Amber Hall"];
      } else if (location === "Katraj") {
        venues = ["Aishwarya Hall", "Mahesh Sanskrutik Hall","Royal Moments Banquet","Gulmohor Banquet Hall"];
      } else if (location==="Camp") {
        venues = ["Town Plaza-Banquet Hall","Sanjog Hall","ABM Hall","Ashirwad Hall"];
      }else if (location==="Kondhwa") {
        venues = ["Utsav Banquet Hall","Blue Sky Banquets","Rajyog Lawns and Banquet Hall","Bismillah Khan Memorial Hall"];
      } else if (location === "Shivaji Nagar") {
        venues = ["Bal Gandharva Ranga Mandir", "Shreyas Banquets", "Indraprastha Wedding Hall","Centurion Hotel"];
      } else if (location === "Kothrud") {
        venues = ["Yashwantrao Chavan Natya Gruha", "Vrindavan Multi-Facility Banquet Hall","Harshall Hall","Utsav Sabhagruh"];
      } else if (location === "Hinjewadi") {
        venues = ["Le Royale Residency", "Courtyard by Marriott","The Gateway Hotel","Hyatt Place"];
      } else if (location === "Kharadi") {
        venues = ["Cocoparra", "Radisson Blu Hotel","The Westin Pune","Four Points by Sheraton"];
      }

      // Add venues to the venue dropdown
      venues.forEach(function (venue) {
        const option = document.createElement("option");
        option.value = venue;
        option.text = venue;
        venueSelect.add(option);
      });
    }

    // Function to prevent selecting past dates
    window.onload = function () {
      const today = new Date();
      today.setDate(today.getDate() + 6); // Add 6 days to today's date
      const minDate = today.toISOString().split("T")[0]; // Format it as YYYY-MM-DD
      document.getElementById("event-date").setAttribute("min", minDate);
    };

  </script>
</html>
