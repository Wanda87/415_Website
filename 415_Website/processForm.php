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
            <a href = "login.php">Login</a>
            <a href = "create_account.php">Create an Account</a>
            <a href = "aboutUs.html">About Us</a>
            <a href = "viewRestaurant.php">View Restaurants</a>
        </div>

        <br>

        <?php // so far works with adding the name and description of restaurant
            if(isset($_POST['rname']) && isset($_POST['rdesc']) && isset($_POST['headImage']))
            {
                $rname = $_POST['rname'];
                $rdesc = $_POST['rdesc'];
                $headImage = $_POST['headImage'];

                // had to put in backslashes for the table and column names (WOULD NOT work unless I did this)
                $sql = "INSERT INTO `PendingRestaurant` (`rname`, `rdesc`, `headImage`) VALUES ('$rname', '$rdesc', '$headImage')";
                

                // writing it here in case I forget come morning:
                //   for adding pending restaurants should we add a new column to restaurants
                //   (idk like status) and set it to true or false depending if it's approved?
                //   sounds better than making an entirely new restaurant table in the db. we'd
                //   probably have to add an extra condition to the sql statement in rating_comments_log.php

                $query = mysqli_query($conn, $sql);
                if($query)
                    echo '<h2 style = "text-align: center;">Form Submission Successful(?)</h2>';
                else
                    echo '<h2 style = "text-align: center;">Whu-oh! There was a problem with submitting your form.</h2>';
            }
        ?>
    </body>
</html>