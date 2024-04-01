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
  
<div class="container">
    <div class="restaurant-list">
        <!-- Restaurant list content here -->
    </div>

    <div class="static-box">
        <h2>Reviews</h2>

        <!-- "Share your opinion" button -->
        <a href="comment.php" class="share-opinion-button">Share your opinion</a>

        <!-- Display comments fetched from the database -->
        <div class="comments">
            <?php
            $servername = 'database-1.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
            $username = 'admin';
            $password = 'password';
            $dbname= 'databaseproject';

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if ($conn -> connect_error){
                die("Connection failed: " .$conn->connect_error);
            }

            $sql = "SELECT U.cid, U.comments, C.cname FROM UserComments U, Customers C WHERE U.cid = C.cid";
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
