<?php
session_start();

// Database connection
$servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
$username = 'admin';
$password = 'password';
$dbname = 'softwareproject';

$loggedin = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : "logged out";

    
if($loggedin != "logged out" && basename($_SERVER['PHP_SELF']) != "rating_comments_log.php") {
    header("location: rating_comments_log.php");
} else if ($loggedin == "logged out" && basename($_SERVER['PHP_SELF']) == "rating_comments_log.php") {
    header("location: login.php");
}

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed: " . mysqli_connect_error());
}

$average_rating = $_SESSION['$averating'];


// Correct header location redirects
$cid = isset($_SESSION['cid']) ? $_SESSION['cid'] : 0;
if (isset($_POST['share'])) {
    if ($cid == 0) {
        header('Location: login.php');
        exit; // Terminate script execution after redirection
    } else {
        header('Location: comment.php');
        exit; // Terminate script execution after redirection
    }
}
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
    <a href="login.php">Login</a>
    <a href="create_account.php">Create an Account</a>
    <a href="aboutUs.php">About Us</a>
    <a href="viewRestaurant.php">View Restaurants</a>
</div>

<div class="container">
    <div class="restaurant-list">
        <?php // displaying restaurant item table:
        // grabbing the name based off of $restChoice
        $restChoice = $_SESSION['restChoice'];
        $sql = "SELECT R.rname FROM Restaurants R WHERE R.rid = '$restChoice'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        echo "<div style='padding-left: 20px;'>";
        echo "<div><p style='text-align: left;'>Restaurant: " . $row['rname'] . "</p></div>";

        // grabbing restaurant desc and image
        $restSQL = "SELECT R.headImage, R.rdesc FROM Restaurants R WHERE R.rid = '$restChoice'";
        $restResult = $conn->query($restSQL);

        if (mysqli_num_rows($restResult) != 0) {
            $row = $restResult->fetch_assoc();
            $image = $row["headImage"];
            echo "<div>Description: " . $row["rdesc"] . "</div>";
            echo "<img style = 'width: 200px; height: 150px;' src='data:image/jpeg;base64, " . base64_encode($image) . "'/>";
        } else {
            echo "Error displaying restaurant.";
        }

        // table for displaying restaurant items
        echo "<br><br>Available Menu Items:<br><br>";
        $restSQL = "SELECT I.itemImage, I.itemname, I.iteamdesc FROM Items I WHERE I.rid = '$restChoice'";
        $restResult = $conn->query($restSQL);

        if (mysqli_num_rows($restResult) != 0) {
            echo "<table><tbody>";
            while ($row = $restResult->fetch_assoc()) {
                $image = $row["itemImage"];
                //echo "<img src='data:image/jpeg;base64, " . base64_encode($image) . "'/>";
                echo "<tr><td><img style = 'width: 150px; height: 150px;' src='data:image/jpeg;base64, " . base64_encode($image) . "'/>" . "</td><td>" . $row["itemname"] . "</td><td>" . $row["iteamdesc"] . "</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No current items in this restaurant!</p>";
        }
        echo "</div>";
        ?>
    </div>

    <div class="static-box">
        <h2>Reviews</h2>

         <!-- Average rating display -->
        <div class="average-rating">
            <?php
                $get_rating = $conn-> query("SELECT AVG(rating) AS averating FROM UserComment WHERE rid = $restChoice");
                $result = $get_rating->fetch_assoc();
                //echo $result['averating'];
                //$statement->bind_param("i", $restChoice);
                //if($statement->execute()){
                    //$row = $statement->fetch_assoc();
                    //echo $row;
                    //$ave_rating = $row['averating'];
                $_SESSION['avg_rating'] = $result['averating'];
                $ave_rating = $_SESSION['avg_rating'];
                //}
                echo "<p>Average Rating: " . $ave_rating . "</p>";
            ?>
        </div>

        <div>
            <form method="post">
                <!-- "Share your opinion" button -->
                <?php
                echo "<button type='submit' class='share-opinion-button' name='share'>Share your opinion</button>";
                ?>
            </form>
        
        </div>

      

        <!-- Display comments fetched from the database -->
        <div class="comments">
            <?php
            $sql = "SELECT comments, cid FROM UserComment WHERE rid = '$restChoice'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='comment'>";
                    echo "<p>User ID: " . $row["cid"] . "</p>";
                    echo "<p>" . $row["comments"] . "</p>";
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

</body>
</html>

