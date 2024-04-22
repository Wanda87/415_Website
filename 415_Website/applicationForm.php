<!DOCTYPE html>
<?php
  $servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
  $username = 'admin';
  $password = 'password';
  $dbname = 'softwareproject';

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if ($conn -> connect_error){
    die("Connection Failed:" .mysqli_connect_error());
  }
?>

<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Application Form</title>
        <link rel="stylesheet" href = "style.css">
    </head>

    <body>
        <div class="header">
        <img src="michelinEatsLogo.png" alt="Logo"> 
        <h1>Michelin Eats</h1>
        </div>

        <!--Links-->
        <div>
            <a href = "login.php">Login</a>
            <a href = "create_account.php">Create an Account</a>
            <a href = "aboutUs.html">About Us</a>
            <a href = "viewRestaurant.php">View Restaurants</a>
        </div>

        <h2 style = "text-indent: 5px; text-align: center;">Restaurant Application Form</h2>

        <form action = "processForm.php" method = "POST"> <!-- Application form below: -->
            <label>Restaurant Name: </label>
            <input name = "rname" id = "rname" type = "text" style = "width: 35%;" required>

            <label>Restaurant Descrtiption: </label>
            <textarea name = "rdesc" id = "rdesc" rows = "10" cols = "60" required></textarea> <br><br>

            <label>(WIP) Submit a Head Image for your Restaurant: </label>
            <input name = "headImage" id = "headImage" type = "file" accept = ".jpg, .jpeg, .png" required> <br><br>

            <button type = "submit" name = "submit" style = "width: 35%;">Submit Form</button>
            
        </form>
    </body>
</html>