<!DOCTYPE html>
<?php
  $servername = 'database-1.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
  $username = 'admin';
  $password = 'password';
  $dbname = 'databaseproj';
  $loggedin = isset($_SESSION["loggedin"]) ? $_SESSION["loggedin"] : "logged out";

  if($loggedin != "logged out" && basename($_SERVER['PHP_SELF']) != "viewRestaurantResult.php") {
      header("location: viewRestaurantResult.php");
  } else if ($loggedin == "logged out" && basename($_SERVER['PHP_SELF']) == "viewRestaurantResult.php") {
      header("location: login.php");
  }
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if ($conn -> connect_error){
    die("Connection Failed:" .mysqli_connect_error());
  }

  $restChoice = $_POST['restaurants']; // rid taken from viewRestaurant.php dropdown
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
      
      <?php // displaying restaurant item table:
        // grabbing the name based off of $restChoice
        $sql = "SELECT R.rname FROM Restaurants R WHERE R.rid = '$restChoice'";
        $result = $conn -> query($sql);
        $row = $result ->fetch_assoc();

        echo "<div style = 'padding-left: 20px;'>";

        echo "<div><p style = 'text-align: left;'>Restaurant: " . $row['rname'] . "</p></div>";
        
        // grabbing restaurant desc and image
        $restSQL = "SELECT R.headImage, R.rdesc FROM Restaurants R WHERE R.rid = '$restChoice'";
        $restResult = $conn -> query($restSQL);

        if(mysqli_num_rows($restResult) != 0){
          $row = $restResult->fetch_assoc();
          $image = $row["headImage"];

          echo "<div>Description: ". $row["rdesc"] . "</div>";

          echo "<img src= 'data:image/jpeg;base64, " . base64_encode($image) . "'/>";
        }
        else
            echo "Error displaying restaurant.";

        //table for displaying restaurant items
        echo "<br>Available Menu Items:<br>";

        $restSQL = "SELECT I.itemImage, I.itemname, I.iteamdesc FROM Items I WHERE I.rid = '$restChoice'";
        $restResult = $conn -> query($restSQL);

        if(mysqli_num_rows($restResult) != 0){
          echo "<table><tbody>";
          while ($row = $restResult->fetch_assoc()){
              // adds a new row to the table (an item)
              echo "<tr><td style = 'padding: 0 15px;'>". $row["itemname"] . "</td><td>" . $row["iteamdesc"] . "</td></tr>";
          }
          echo "</tbody></table>";
        }
        else
        {
            echo "<p>No current items in this restaurant!</p>";
        }
        
        echo "</div>";
      ?>

  </body>
</html>
