<!-- TODO: *grab session variable mid from login.php
           *also make sure to add a header for login.php to redirect to here -->

<DOCTYPE html>

<?php


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === "manager" && basename($_SERVER['PHP_SELF']) !== "managerPortal.php") {
  header("location: managerPortal.php");
  exit;
} 

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
    {
        $servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
        $username = 'admin';
        $password = 'password';
        $dbname = 'softwareproject';

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if ($conn -> connect_error){
            die("Connection Failed:" .mysqli_connect_error());
        }
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
            <a href = "aboutUs.html">About Us</a>
            <a href = "viewRestaurant.php">View Restaurants</a>
            <a href = "applicationForm.php">Application Form</a>
            <a href = "menuItem.php">Add Menu Item</a>
            <a href = "logout.php">Logout</a>
        </div>

        <div style = "margin: 20px;">
            <h3>Welcome to the Manager Portal!</h3>

            <p>
                Here, you can submit and review restaurant application forms! Once approved, you can
                then add new items to your restaurant's menu. If you haven't already, please submit
                a form for your restaurant, and make sure to have your paperwork in order!
            </p>
        </div>
    </body>
</html>