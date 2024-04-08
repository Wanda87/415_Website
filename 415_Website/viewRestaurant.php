<!DOCTYPE html>
<?php
  $servername = 'database-1.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
  $username = 'admin';
  $password = 'password';
  $dbname = 'databaseproj';

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

    <form action = "rating_comments_log.php" method = "post"> <!-- Page will be directed to result -->
      <label for = "restaurants">Select a Restaurant: </label>

      <?php
        $sql = "SELECT R.rid, R.rname FROM Restaurants R";
        $result = $conn -> query($sql);

        // creating dropdown menu for resturants
        if(mysqli_num_rows($result) != 0){
          echo "<select name = 'restaurants'>";

          while ($row = $result->fetch_assoc()){
            echo "<option value = '" . $row["rid"] . "'>". $row["rname"] ."</option>";
          }
          
          echo "</select> <input type='submit' name='submit' value='Enter'/>";
        }
      ?>
    </form>

  </body>
</html>
