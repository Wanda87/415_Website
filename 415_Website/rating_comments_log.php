<?php
    $servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
    $username = 'admin';
    $password = 'password';
    $dbname= 'softwareproject';

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn -> connect_error){
        die("Connection failed: " .$conn->connect_error);
    }

    $restChoice = $_POST['restaurants']; // rid taken from viewRestaurant.php dropdown
    $cid = 0;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurant Reviews</title>
        <link rel="stylesheet" href="rating_comments_log_style.css">
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
        
        <div class="container">
            <div class="restaurant-list">
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
            </div>

            <div class="static-box">
                <h2>Reviews</h2>
                
                <div><form method = "post">
                    <!-- "Share your opinion" button -->

                    <?php // needs a check to see if a user is logged in or not
                        echo "<button type = 'submit' class = 'share-opinion-button' name = 'share'>Share your opinion</button>";
                        // need to have an if statement here to check if the cid = 0, and then to either
                        //   redirect to comment.php or login.php

                        if(isset($_POST['share'])){
                            if($cid = 0){
                                header('Location: ', login.php);
                            }
                            else{
                                header('Location: ', comment.php);
                            }
                        }
                    ?>
                </form></div>

                <!-- Display comments fetched from the database -->
                <div class="comments">
                    <?php
                    $sql = "SELECT U.cid, U.comments, C.cname FROM UserComment U, Customers C WHERE U.cid = C.cid AND U.rid = '$restChoice'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='comment'>";
                            echo "<p>User ID: " . $row["cid"]. "</p>";
                            echo "<p>" . $row["comments"]. "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>

        <script src="script.js"></script>

    </body>
</html>
