<?php
  $servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
  $username = 'admin';
  $password = 'password';
  $dbname= 'softwareproject';

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
  }

  $restChoice = $_POST['restaurants']; // rid taken from viewRestaurant.php dropdown
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Your Opinion</title>

    
    <link rel="stylesheet" href = "comment_style.css">
    </head>
  <body>

    <?php
      // Check if the form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
        $comments = $_POST['comments'];

        // Insert the data into the database
        $sql = "INSERT INTO UserComment (cid, rid, comments) VALUES ('$cid', '$restChoice', '$comments')";
        if ($conn->query($sql) === TRUE) {
            // Redirect to the previous page
            header('Location: rating_comments_log.php');
            exit();
        }
        else {
            // Display an error message
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }

    $conn->close();
    ?>

    <div class="header">
      <img src="michelinEatsLogo.png" alt="Logo"> 
      <h1>Michelin Eats</h1>
    </div>

    <div class="rating-box">
      <header>How was your experience?</header>
      
      <textarea id="comment-box" placeholder = "Add your comment here..." rows="4"></textarea>
      <button id="submmit-comment">Submit</button>
    </div>
    

  </body>
</html>

