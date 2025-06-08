<?php
  include 'include/authorize.php';
  include 'include/check_event_step.php';
?>
<html>
  <head>
    
    <link
      href="./assets/css/fonts.css"
      rel="stylesheet"
    />
    <link href="./assets/css/items.css" rel="stylesheet" />
    <title>Menu</title>
  </head>
  <style>
    .heading {
      padding: 20px 0 !important;
    }
  </style>
  <body>
    <form class="container" method="POST" action="menu.php">
      <div class="heading">
        <h1>Menu</h1>
        <br>
        <p style="color:white;">🍽️ One menu, one tough choice—pick your favorite feast! 😋 <br>💸 Budget: 25 plates | 🌟 Premium: 50 plates | 👑 Luxury: 100 plates</br></p>
      </div>
      <!--MENUS-->
      <div class="items">
        <div class="item">
          <label>
            <input type="radio" name="menu" value="Menu 1" />
            <span>Menu 1 (Veg)</span>
          </label>
          <h4>Starters</h4>
          <p>1. Paneer Tikka</p>
          <p>2. Spring Rolls</p>
          <h4>Main Course</h4>
          <p>1. Plain rice</p>
          <p>2. Veg Biryani</p>
          <p>3. Plain chapati</p>
          <p>4. Butter naan</p>
          <p>5. Shahi paneer</p>
          <p>6. Matar mushroom</p>
          <h4>Beverages</h4>
          <p>1. Masala Chai</p>
          <p>2. Coffee</p>
          <p>3. Coca-cola</p>
          <h4>Desserts</h4>
          <p>1. Gulab Jamun</p>
          <p>2. Cheesecake</p>
        </div>
        <div class="item">
        <label>
            <input type="radio" name="menu" value="Menu 2" />
            <span>Menu 2 (Veg)</span>
          </label>
          <h4>Starters</h4>
          <p>1. Chilli Paneer</p>
          <p>2. Pani Puri </p>
          <h4>Main Course</h4>
          <p>1. Plain rice</p>
          <p>2. Pulao</p>
          <p>3. Plain chapati</p>
          <p>4. Butter naan</p>
          <p>5. Kadhai paneer</p>
          <p>6. Bhindi Masala</p>
          <h4>Beverages</h4>
          <p>1. Masala Chai</p>
          <p>2. Cold Coffee</p>
          <p>3. Mirinda</p>
          <h4>Desserts</h4>
          <p>1. Rasmalai</p>
          <p>2. Brownie with Ice Cream</p>
        </div>
        <div class="item">
          <label>
            <input type="radio" name="menu" value="Menu 3" />
            <span>Menu 3 (Veg + Non- veg)</span>
          </label>
          <h4>Starters</h4>
          <p>1. Chicken Tikka</p>
          <p>2. Hara Bhara Kabab </p>
          <h4>Main Course</h4>
          <p>1. Plain rice</p>
          <p>2. Chicken Dum Biryani</p>
          <p>3. Plain chapati</p>
          <p>4. Butter naan</p>
          <p>5. Butter Chicken</p>
          <p>6. Mix veg</p>
          <h4>Beverages</h4>
          <p>1. Masala Chai</p>
          <p>2. Lassi</p>
          <p>3. Mountain dew</p>
          <h4>Desserts</h4>
          <p>1. Gajar Ka Halwa</p>
          <p>2. Tiramisu</p>
        </div>
        <div class="item">
        <label>
            <input type="radio" name="menu" value="Menu 4" />
            <span>Menu 4 (Veg + Non- veg)</span>
          </label>
          <h4>Starters</h4>
          <p>1. Mutton Seekh Kebab</p>
          <p>2. Dahi Puri </p>
          <h4>Main Course</h4>
          <p>1. Plain rice</p>
          <p>2. Mutton Biryani</p>
          <p>3. Plain chapati</p>
          <p>4. Butter naan</p>
          <p>5. Chicken Korma</p>
          <p>6. Aalu matar gobhi</p>
          <h4>Beverages</h4>
          <p>1. Masala Chai</p>
          <p>2. Nimbu paani </p>
          <p>3. Sprite</p>
          <h4>Desserts</h4>
          <p>1. Mysore Pak</p>
          <p>2. Macarons</p>
        </div>
      </div>
      <p id="message"></p>
      <button class="save-btn btn-animate" type="submit">Save</button>
    </form>
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
