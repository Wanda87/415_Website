<DOCTYPE html>
<?php
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
            <a href = "logout.php">Logout</a>
        </div>

        <div style = "margin: 20px;">
            <h3>Welcome to the Manager Portal!</h3>

            <p>Here, you can submit and review restaurant application forms!</p>
        </div>
    </body>
</html>