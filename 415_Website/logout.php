<DOCTYPE html>
<?php
session_start();
$loggedin = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : "logged out";

if($loggedin != "logged out" && basename($_SERVER['PHP_SELF']) != "logout.php") {
    header("location: logout.php");
} else if ($loggedin == "logged out" && basename($_SERVER['PHP_SELF']) == "logout.php") {
    header("location: login.php");
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
session_destroy();
$loggedin = "logged out";
?>

<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Logout</title>
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
        <a href = "aboutUs.php">About Us</a>
        <a href = "viewRestaurant.php">View Restaurants</a>
        </div>

        <div style = "margin: 20px; text-align: center;">
            <h3>Logout successful!</h3>

        </div>
    </body>
</html>