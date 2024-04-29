<!-- TODO: Get button to direct to 3 different pages: login.php if not logged in,
                                                      create_restaurant_account.php if logged in as customer/admin,
                                                      applicationForm.php if logged in as manager -->
<?php
  session_start();
  #$loginCheck = $_SESSION['loggedin'];
  $loggedin = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : "logged out";



  // Database connection
  $servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
  $username = 'admin';
  $password = 'password';
  $dbname = 'softwareproject';

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection Failed: " . mysqli_connect_error());
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Create Account</title>
    <link rel="stylesheet" href = "style.css">
  </head>

  <body>
    <div class = "header">
        <img src = "michelinEatsLogo.png" alt = "logo">
        <h1>Michelin Eats</h1>
    </div>

    <!--Links-->
    <div>
      <a href = "login.php">Login</a>
      <a href = "create_account.php">Create an Account</a>
      <a href = "aboutUs.php">About Us</a>
   
      <?php if ($loggedin != "logged out"): ?>
        <a href = "viewRestaurant.php">View Restaurants</a>
        <a href = "logout.php">Logout</a>
        <?php endif; ?>
    </div>

    <div style = "margin: 20px;">
      <p>
        Michelin-star restaurants are pricey! Imagine wasting all that money on something you didn't
        even like, something you weren't expecting, or something that you're allergic to! At Michelin Eats
        we want to offer you a way to check out these high class restaurants' menus, which include images
        and possible allergens! We even have a ratings system where you can read the opinions of other fine
        diners. Wow!
      </p>

      <br>

      <div>
        <img src = "steak.jpg" style = "height: 200px; width: 200px; display: inline-block;">
        <h4>See menu items!</h4>

        <img src = "revScreenshot.png" style = "height: 200px; width: 400px; display: inline-block;">
        <h4>And check out what others think about them!</h4>
      </div>


    </div>

    <div style = "text-align: center;">
      <p style = "margin: 20px;">
        Are you a restaurant manager and would you like to add your restaurant to our website?
        Please click below to fill out a form for submission!
      </p>
      <!-- I have no idea how I'm gonna implement this, but there'll need to be some php here
            for checking if a user is logged in as a restaurant manager before directing them
            to applicationForm.php -->
      <form action = "applicationForm.php">
        <button type = "submit" style = "width: 35%;">Fill out a form!</button>
      </form>
    </div>

  </body>

</html>