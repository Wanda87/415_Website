<!DOCTYPE html>
<?php
  session_start();
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
            <a href = "aboutUs.php">About Us</a>
            <a href = "viewRestaurant.php">View Restaurants</a>
            <a href = "applicationForm.php">Application Form</a>
            <a href = "menuItem.php">Add Menu Item</a>
            <a href = "logout.php">Logout</a>
        </div>

        <h2 style = "text-indent: 5px; text-align: center;">Restaurant Application Form</h2>

        <form action = "processForm.php" method = "POST" enctype="multipart/form-data"> <!-- Application form below: -->
            <label>Restaurant Name: </label>
            <input name = "rname" id = "rname" type = "text" style = "width: 35%;" required>

            <label>Restaurant Manager: </label>
            <input name = "roname" id = "roname" type = "text" style = "width: 35%;" required>

            <label>Restaurant Descrtiption: </label>
            <textarea name = "rdesc" id = "rdesc" rows = "7" cols = "55" required></textarea> <br><br>

            <label>Do you have your health inspection doctuments sorted out?</label>
            <select name = "docCheck" id = "docCheck" style = "width: 35%; font-size: 18px; text-align: center;">
                <option value = "F">No</option>
                <option value = "T">Yes</option>
            </select> <br><br>

            <label>Submit a Head Image for your Restaurant: </label>
            <input name = "headImage" id = "headImage" type = "file" accept = ".jpg, .jpeg, .png" required
                   style = "font-size: 18px; text-align: center;"> <br><br>

            <button type = "submit" id = "submit" name = "submit" style = "width: 35%;">Submit Form</button>
            
        </form>
    </body>
</html>