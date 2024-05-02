
<?php

  session_start();

  $loggedin = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : "logged out";

    
  if($loggedin != "logged out" && basename($_SERVER['PHP_SELF']) != "comment.php") {
      header("location: comment.php");
  } else if ($loggedin == "logged out" && basename($_SERVER['PHP_SELF']) == "comment.php") {
      header("location: login.php");
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Share Your Opinion</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="comment_style.css">
  <script src="comment.js" defer></script>
</head>
<body>
  <div class="header">
    <img src="michelinEatsLogo.png" alt="Logo">
    <h1>Michelin Eats</h1>
  </div>

  <form method = "POST">
    <div class="rating-box">
      <header>How was your experience?</header>
      <div class="stars">
      <input type="hidden" id="rating" name="rating"> <!-- Hidden input field for capturing the rating value -->
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <textarea id="comment-box" name = "comment-box" placeholder="Add your comment here..." rows="4"></textarea>
      <button id="submit-comment" name = "submit-comment">Submit</button>
    </div>
  </form>

  <?php
    require '\vendor\autoload.php';
    use Aws\Comprehend\ComprehendClient;
    
    $cacertPath = 'cacert.pem'; // Update this with the actual path
    $servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
    $username = 'admin';
    $password = 'password';
    $dbname = 'softwareproject';
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn -> connect_error){
      die("Connection Failed:" .mysqli_connect_error());
    }
    
    if (isset($_SESSION['submit-comment'])){
      $restChoice = $_SESSION['restaurant_choice'];
      $cid = $_SESSION['cid'];
    
    $client = new ComprehendClient([
        'region' => 'us-east-2',
        'version' => 'latest',
        'credentials' => [
            'key' => "AKIAZI2LGBZFJJI6OFTC",
            'secret' => "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"
        ],
        'http' => [
            'verify' => $cacertPath,
        ],
    ]);
    $result = $client->detectSentiment([
        'LanguageCode' => 'en',
        'Text' => $comment,
    ]);
    
    $data = $result->toArray();
    $sentiment = $data['Sentiment'];
    
    $data = $result->toArray();
    $sentimentScore = $data['SentimentScore'];
    
    $weights = [
        'Positive' => 4,
        'Negative' => 0.5,
        'Mixed' => 2,
        'Neutral' => 3
    ];
    
    $weightedSum = 0;
    foreach ($weights as $sentiment => $weight) {
        $weightedSum += $sentimentScore[$sentiment] * $weight;
    }
    
    $maxScore = 0;
    foreach ($sentimentScore as $score) {
        $maxScore += $score * max($weights);
    }
    
    $ratingOutOf5 = ($weightedSum / $maxScore) * 5;
    
    $query = "INSERT INTO UserComment (cid, rid, comments, rating) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iisd", $cid, $restChoice, $comment, $ratingOutOf5);
    mysqli_stmt_execute($stmt);
    
    $query = "SELECT AVG(rating) AS averating FROM UserComment WHERE rid = ?;";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $restChoice);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $averating);
    mysqli_stmt_fetch($stmt);
    
    }
    
  ?>
</body>
</html>
