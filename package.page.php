<?php
  //Check user is logged in or not
  include 'include/authorize.php';
  //Check user is allowed to access this event step or not
  //include 'include/check_event_step.php';
?>
<html>
  <head>
    <title>Package</title>
    
    <link
      href="./assets/css/fonts.css"
      rel="stylesheet"
    />
    <meta charset="UTF-8">
    <style>
      html {
        width: 100%;
        height: 100%;
        padding: 0;
      }
      body {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        font-family: Arial, sans-serif;
        background: url("./assets/img/bg.jpeg");
        background-size: 100%;
        overflow: hidden;
      }

      body > .container {
        display: flex;
        width: 75%;
        height: calc(100% - 20px);
        padding: 20px 12.5%;
        background-color: #340d0c75;
        overflow-y: auto;
      }
      h1 {
        font-size: 2.2rem;
        font-weight: 600;
        font-family: "Syne";
        color: white;
        text-align: center;
      }

      .row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 30px;
        padding: 20px 0;
        margin: auto;
      }

      .service {
        color: white;
        border-radius: 10px;
        transition: all 0.3s;
        font-family: "Syne";
        overflow: hidden;
        box-shadow: 4px 4px 20px 5px rgba(0, 0, 0, 0.5);
      }
      .service:hover {
        transform: scale(0.9);
      }

      .service a {
        text-decoration: none;
      }

      .service img {
        width: 100%;
        height: 200px;
        object-fit: cover;
      }
      .service .content {
        padding: 10px 18px;
        background-color: #180908de;
        color: white;
      }

      .service .content h2 {
        font-weight: 600;
        margin: 0;
      }
      .service .content p {
        color: #a0a89f;
        font-size: 1rem;
        font-family: "DM Sans";
        font-weight: 500;
      }
    </style>
  </head>
  <body>
    <section class="services container">
      <div class="row">
        <div class="service">
          <a href="event.page.php">
            <img src="assets/img/birthday.webp" alt="Birthday Event" />
            <div class="content">
              <h2>Birthday</h2>
              <p>
                Blow out the candles, not your energy—we’ve got your birthday covered!
              </p>
            </div>
          </a>
        </div>
        <div class="service">
          <a href="event.page.php">
            <img src="assets/img/marriage.webp" alt="Wedding Event" />
            <div class="content">
              <h2>Wedding</h2>
              <p>
                Focus on your first dance, not the planning—we've got your wedding covered!
              </p>
            </div>
          </a>
        </div>
        <div class="service">
          <a href="event.page.php">
            <img src="assets/img/concert.jpg" alt="Concert Event" />
            <div class="content">
              <h2>Concert</h2>
              <p>
                Enjoy the music, groove with the beats, don't worry about the logistics!
            </div>
          </a>
        </div>
        <div class="service">
          <a href="event.page.php">
            <img src="assets/img/gettogether.jpg" alt="Get-Togethers Event" />
            <div class="content">
              <h2>Get-Togethers</h2>
              <p>
                Cherish the moments, enjoy the food and let us handle all the planning!
              </p>
            </div>
          </a>
        </div>
        <div class="service">
          <a href="event.page.php">
            <img src="assets/img/corporate.jpg" alt="Corporate Parties Event" />
            <div class="content">
              <h2>Corporate Parties</h2>
              <p>
                Network, celebrate, and unwind—we'll take care of the rest!
              </p>
            </div>
          </a>
        </div>
        <div class="service">
          <a href="event.page.php">
            <img src="./assets/img/babyshower.jpg" alt="Baby Shower Event" />
            <div class="content">
              <h2>Baby Shower</h2>
              <p>
                Baby on the way? Shower the mom-to-be with love, we’ll handle the rest! 
              </p>
            </div>
          </a>
        </div>
      </div>
    </section>
  </body>
</html>
