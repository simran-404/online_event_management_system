<?php
  include 'include/authorize.php';
  include 'include/check_event_step.php';
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
    <title>Decoration Options</title>

    <style>
      .options {
        display: grid;
        grid-template-columns: 1fr 1fr;
      }
    </style>
    <style></style>
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
          <p style="color:white;"><strong>Pick your perfect setup! 🌸🪑✨</strong></p>
          <p style="color:white;">
            💸 Budget: 1 flower, 35 chairs, 18 tables<br>
            🌟 Premium: 2 flowers, 70 chairs, 35 tables <br>
            👑 Luxury: 4 flowers, 140 chairs, 70 tables
          </p>
        </div>
      </div>
      <div class="right">
        <div class="form form-short">
          <form method="POST" action="decoration.php" >
            <h2>Decoration Selection Form</h2>
            <p id="message"></p>
            <!-- Carpet selection -->
            <div class="grid-fields">
              <div class="input-group select-group">
                <label for="carpet">Carpet Color</label>
                <select
                  id="carpet"
                  name="carpet"
                  required
                >
                  <option value="" selected disabled>Select an option</option>
                  <option value="red">Red</option>
                  <option value="green">Green</option>
 		              <option value="blue">Blue</option>
		              <option value="grey">Grey</option>
                  <option value="pink">Pink</option>
                  <option value="maroon">Maroon</option>
                </select>
              </div>
              <div class="input-group select-group">
                <!-- Curtain selection -->
                <label for="curtain">Curtain Color</label>
                <select
                  id="curtains"
                  name="curtain"
                  required
                >
                  <option value="" selected disabled>Select an option</option>                
                  <option value="pink">Pink</option>
                  <option value="light pink">Light Pink</option>
                  <option value="purple">Purple</option>
	                <option value="white">White</option>
                  <option value="red">Red</option>
                  <option value="light blue">Light blue</option>
                </select>
              </div>
            </div>

            <!-- Flower selection -->
            <div class="input-group checkbox-group" style="margin: 0">
              <label>Flower Selection</label>
              <div class="options">
                <label
                  ><input type="checkbox" name="flowers[]" value="tulip" />
                  <span>Tulip</span>
                  <img src="./assets/img/tulip.svg" />
                </label>
                <label
                  ><input type="checkbox" name="flowers[]" value="rose" />
                  <span>Rose</span>
                  <img src="./assets/img/rose.svg"
                /></label>
                <label
                  ><input type="checkbox" name="flowers[]" value="marigold" />
                  <span>Marigold</span>
                  <img src="./assets/img/mariegold.svg"
                /></label>
                <label
                  ><input type="checkbox" name="flowers[]" value="lily" />
                  <span>Lily</span>
                  <img src="./assets/img/lilly.svg"
                /></label>
                <label
                  ><input type="checkbox" name="flowers[]" value="sunflower" />
                  <span>Sunflower</span>
                  <img src="./assets/img/sunflower.svg"
                /></label>
              </div>
            </div>

            <div class="grid-fields">
              <!-- Number of chairs required -->
              <div class="input-group">
                <label for="chairs">Number of Chairs:</label>
                <input
                  type="number"
                  id="chairs"
                  name="chairs"
                  min="0"
                  max="150"
                  required
                />
              </div>
              <!-- Number of tables required -->
              <div class="input-group">
                <label for="tables">Number of Tables:</label>
                <input
                  type="number"
                  id="tables"
                  name="tables"
                  min="0"
                  max="75"
                  required
                />
              </div>
            </div>

            <!-- Submit button -->
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
</html>
