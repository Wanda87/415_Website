<!DOCTYPE html>
<?php
  $servername = 'database-1.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
  $username = 'admin';
  $password = 'password';
  $dbname = 'databaseproject';

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if ($conn -> connect_error){
    die("Connection Failed:" .mysqli_connect_error());
  }
?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>View Restaurants</title>
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

    <br>

    <form action = "viewRestaurantResult.php" method = "post">
      <label for = "restaurants">Select a Restaurant: </label>
      <?php
        $restChoice = "Not Selected";

        $sql = "SELECT R.rid, R.rname FROM Resturants R";
        $result = $conn -> query($sql);

        // dropdown menu for resturants
        if(mysqli_num_rows($result) != 0){
          echo "<select name = 'restaurants'>";

          while ($row = $result->fetch_assoc()){
            echo "<option value = '" . $row["rid"] . "'>". $row["rname"] ."</option>";
          }
          echo "</select> <input type = 'submit'";

          $restChoice = $_POST['restaurants'];
        }
        
        //$restChoice = $_POST['restaurants'];

        if (is_int($restChoice)){
          $sql = "SELECT R.rname FROM Resturants R WHERE R.rid = '$restChoice'";
          $result = $conn -> query($sql);
          $currentRestName = $result -> fetch_assoc();
        }
      ?>
    </form>
      
      <?php

        echo "<div><p style = 'text-align: left;'>Restaurant: $restChoice</p></div>";

        //table for displaying restaurant items

        $restSQL = "SELECT I.itemImage, I.itemname FROM Items I, Resturants R WHERE R.rid = '$restChoice'";
        // maybe include a thingy above like, WHERE R.rname = NAME_FROM_DROPDOWN_LIST
        $restResult = $conn -> query($restSQL);

        if(mysqli_num_rows($restResult) != 0){
          echo "<table><tbody>";
          while ($row = $restResult->fetch_assoc()){
              // adds a new row to the table (an item)
              echo "<tr><td>". $row["itemImage"] . "</td><td>" . $row["itemname"] . "</td></tr>";
          }
          echo "</tbody></table>";
        }
        
      ?>
  </body>
</html>
