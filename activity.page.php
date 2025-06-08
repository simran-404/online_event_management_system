<?php
  //Check user is logged in or not
  include 'include/authorize.php';
  //Check user is allowed to access this event step or not
  include 'include/check_event_step.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link href="./assets/css/fonts.css" rel="stylesheet" />
    <link href="./assets/css/items.css" rel="stylesheet" />
    <title>Activities Page</title>
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="heading">
          <h1>Activities</h1>
          <p style="font-weight: 500;">Make your event more engaging.<br>Pick up to 2 activities with Budget, 4 with Premium, and 6 with Luxury—more upgrades, more fun! 🎉</p>
        </div>
        <!--ITEMS-->
        <form action="activity.php" method="POST">
          <div class="items">
            <?php
              $activities = [
                "Musical Chair" => ["image" => "musicalchair.jpg", "desc" => "A classic game that brings fun and excitement for all age groups!"],
                "Karaoke" => ["image" => "karaoke.jpg", "desc" => "Sing your heart out with friends and enjoy a musical evening."],
                "Magic Show" => ["image" => "magic.webp", "desc" => "Experience the wonder of illusions and tricks from a talented magician."],
                "Dance Battle" => ["image" => "dance.jpg", "desc" => "Show off your dance moves in a thrilling battle of rhythm and energy."],
                "DJ Party" => ["image" => "dj.jpg", "desc" => "Groove to the latest hits with an electrifying DJ spinning the beats."],
                "Stand-up Comedy" => ["image" => "standup.jpg", "desc" => "Laugh out loud with top-notch comedians delivering hilarious performances."],
                "Improv & Acting Games" => ["image" => "acting.jpg", "desc" => "Unleash your creativity with fun and spontaneous acting challenges."],
                "Storytelling & Open Mic Sessions" => ["image" => "openmic.jpg", "desc" => "Express yourself through stories, poetry, or music in an open-mic setting."]
              ];

              foreach ($activities as $activity => $details) {
                echo "<div class='item'>
                        <img src='./assets/img/{$details['image']}' alt='$activity' />
                        <h3>$activity</h3>
                        <p>{$details['desc']}</p>
                        <div>
                          <img src='./assets/img/add.svg' />
                          <input type='checkbox' name='activity[]' value='$activity' onchange='addActivity(this)' />
                        </div>
                      </div>";
              }
            ?>
          </div>
          <p id="error-message" class="error"></p>
          <!--SAVE BUTTON-->
          <button type="submit" class="save-btn btn-animate">Save</button>
        </form>
      </div>
    </div>
  </body>
  <script defer>
    // Show error message received from backend through URL
    const searchParams = new URLSearchParams(window.location.search);
    const msg = searchParams.get("message");
    if (msg) {
      document.getElementById("error-message").textContent = msg;
    }

    function addActivity(checkbox) {
      checkbox.closest(".item").classList.toggle("selected");
    }
  </script>
</html>
