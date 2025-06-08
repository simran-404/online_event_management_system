<?php
  include 'include/authorize.php';
?>
<html >
  <head>
    <title>Feedback page</title>
    <meta charset="UTF-8" />
    <meta name="viewprt" content="width=device-width, initial-scale=1.0" />
    
    <link
      href="./assets/css/fonts.css"
      rel="stylesheet"
    />
    <link href="./assets/css/index.css" rel="stylesheet" />
  </head>
  <body>
    <div class="container">
      <div class="left">
        <div class="content">
          <img src="assets/img/decorgif.gif">
          <h1>Your Feedback is Important for Us!</h1>
          <p>
            We value your thoughts and suggestions! Your feedback helps us improve and create even better experiences for you. Let us know what you think!
          </p>
          <div class="btns">
          <button class="form-btn logout">
              <a href="dashboard.page.php">Dashboard</a>
            </button>
            <button class="form-btn logout">
              <a href="logout.php">Logout</a>
            </button>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="form">
          <form action="feedback.php" method="POST">
            <p id="message"></p>
            <div class="input-group">
              <input
                type="text"
                name="username"
                placeholder="Username"
                required
              />
            </div>
            <div class="input-group">
              <input
                type="email"
                name="email"
                placeholder="Email"
                required
              />
            </div>
            <div class="input-group">
              <label>Your Review</label>
              <textarea
                aria-required="true"
                name="comments"
                rows="5"
                cols="40"
                required
              ></textarea>
            </div>
            <div class="input-group radio-group">
              <label for="oe" aria-required="true">Overall Experience</label>
              <div class="options">
                <label for="vg">
                  <input type="radio" value="vg" name="oe" required />
                  <span>Very Good</span>
                </label>
                <label for="g">
                  <input type="radio" value="g" name="oe" required />
                  <span>Good</span>
                </label>
                <label for="b">
                  <input type="radio" value="b" name="oe" required />
                  <span>Bad</span>
                </label>
                <label for="p">
                  <input type="radio" value="p" name="oe" required />
                  <span>Poor</span>
                </label>
              </div>
            </div>
            <div class="input-group radio-group">
              <label for="tr" aria-required="true">Timely Respnse</label>
              <div class="options">
                <label for="vg">
                  <input type="radio" value="vg" name="tr" required />
                  <span>Very Good</span>
                </label>
                <label for="g">
                  <input type="radio" value="g" name="tr" required />
                  <span>Good</span>
                </label>
                <label for="b">
                  <input type="radio" value="b" name="tr" required />
                  <span>Bad</span>
                </label>
                <label for="p">
                  <input type="radio" value="p" name="tr" required />
                  <span>Poor</span>
                </label>
              </div>
            </div>
            <div class="input-group radio-group">
              <label for="os">Our Supprt</label>
              <div class="options">
                <label for="vg">
                  <input type="radio" value="vg" name="os" required />
                  <span>Very Good</span>
                </label>
                <label for="g">
                  <input type="radio" value="g" name="os" required />
                  <span>Good</span>
                </label>
                <label for="b">
                  <input type="radio" value="b" name="os" required />
                  <span>Bad</span>
                </label>
                <label for="p">
                  <input type="radio" value="p" name="os" required />
                  <span>Poor</span>
                </label>
              </div>
            </div>
            <div class="input-group radio-group">
              <label for="osat">Overall Satisfaction</label>
              <div class="options">
                <label for="vg">
                  <input type="radio" value="vg" name="osat" required />
                  <span>Very Good</span>
                </label>
                <label for="g">
                  <input type="radio" value="g" name="osat" required />
                  <span>Good</span>
                </label>
                <label for="b">
                  <input type="radio" value="b" name="osat" required />
                  <span>Bad</span>
                </label>
                <label for="p">
                  <input type="radio" value="p" name="osat" required />
                  <span>Poor</span>
                </label>
              </div>
            </div>
            <button type="submit" class="form-btn">submit</button>
          </form>
        </div>
      </div>
    </div>
  </body>
  <script defer>
    //Show error or success message recevied from backend through url
    const searchParams = new URLSearchParams(window.location.search) 
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
