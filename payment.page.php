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
    <meta charset="UTF-8">
    <title>Payment Page</title>
  </head>
  <style>
    .form-btn {
      margin-top: 20px;
    }
  </style>

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
        </div>
      </div>
      <div class="right">
        <div class="form">
          <div class="payment-box" id="paymentBox">
            <h2>Payment Page</h2>
            <form action="payment.php" method="POST">
              <p id="message"></p>
              <div class="grid-fields">
                <div class="input-group">
                  <!-- Name field (Compulsory) -->
                  <label for="name">Name on Card:</label>
                  <input type="text" id="name" name="name" pattern="^[A-Za-z ]+$" title="Enter valid name" required />
                </div>

                <div class="input-group select-group">
                  <!-- Card Type Selection -->
                  <label for="cardType">Card Type:</label>
                  <select id="cardType" name="cardType" required>
                    <option value="debit">Debit Card</option>
                    <option value="credit">Credit Card</option>
                  </select>
                </div>
              </div>

              <div class="input-group">
                <!-- Card Number field (Compulsory) -->
                <label for="cardNumber">Card Number:</label>
                <input
                  type="text"
                  id="cardNumber"
                  name="cardNumber"
                  pattern="\d{4}-\d{4}-\d{4}"
                  placeholder="0000-0000-0000"
                  required
                />
              </div>

              <div class="grid-fields">
                <div class="input-group">
                  <!-- CVV field (Compulsory) -->
                  <label for="cvv">CVV:</label>
                  <input
                    type="password"
                    id="cvv"
                    name="cvv"
                    pattern="\d{3}"
                    placeholder="***"
                    required
                    title="Enter a valid 3-digit CVV"
                  />
                </div>

                <div class="input-group">
                  <!-- Expiration Date field (Compulsory) -->
                  <label for="expiration">Expiration (YYYY-MM):</label>
                  <input
                    type="month"
                    id="expiration"
                    name="expiration"
                    required
                  />
                </div>
              </div>
              <!-- Submit button -->
              <button type="submit" value="Pay Now" class="form-btn">
                Pay Now
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

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
  </body>
</html>
