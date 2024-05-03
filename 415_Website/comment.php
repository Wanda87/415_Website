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
</head>
<body>
  <div class="header">
    <img src="michelinEatsLogo.png" alt="Logo">
    <h1>Michelin Eats</h1>
  </div>

  <div class="rating-box">
    <header>How was your experience?</header>
    <form id="rating-form" action="rating_comments_log.php" method="post">
      <textarea id="comment-box" name="comment-box" placeholder="Add your comment here..." rows="4"></textarea>
      <button type="submit">Submit</button>
    </form>
  </div>

  

</body>
</html>