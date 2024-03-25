<?php
  // php login authentication stuff will go here
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Create Customer Account</title>
    <link rel="stylesheet" href = "style.css">
  </head>
  <body>

    <div class="header">
      <img src="michelinEatsLogo.png" alt="Logo"> 
      <h1>Michelin Eats</h1>
    </div>

    <section class="wrapper-main">
      <form action="create_customer_account_handler.php" method="post">
        <label for="name">Name:</label>
        <input required type="text" id="name" name="name" placeholder="Enter your name">
        
        <label for="username">Username:</label>
        <input required type="text" id="username" name="username" placeholder="Enter your username">
        
        <label for="password">Password:</label>
        <input required type="password" id="password" name="password" placeholder="Enter your password">
        
        <label for="confirm_password">Confirm Password:</label>
        <input required type="password" id="confirm_password" name="confirm_password" placeholder="Re-enter your password">

        <button type="submit">Create Customer Account</button>
      </form>

      <form action = "create_account.php">
        <input type = "submit" value = "Go Back"/>
      </form>
    </section>

  </body>
</html>
