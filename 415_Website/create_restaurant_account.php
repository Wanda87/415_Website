<?php
  // php login authentication stuff will go here
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Create Restaurant Owner Account</title>
    <link rel="stylesheet" href = "style.css">
  </head>
  <body>
    <div class = "header">
      <img src="michelinEatsLogo.png" alt="Logo"> 
      <h1>Michelin Eats</h1>
    </div>

    <section class="wrapper-main">
      <form action="create_account_handler.php" method="post">
        <label for="manager_name">Manager Name:</label>
        <input required type="text" id="manager_name" name="manager_name" placeholder="Enter manager's name">
        
        <label for="username">Username:</label>
        <input required type="text" id="username" name="username" placeholder="Enter your username">
        
        <label for="password">Password:</label>
        <input required type="password" id="password" name="password" placeholder="Enter your password">
        
        <label for="confirm_password">Confirm Password:</label>
        <input required type="password" id="confirm_password" name="confirm_password" placeholder="Re-enter your password">

        <button type="submit">Create Restaurant Owner Account</button>
        <input type="hidden" name="account_type" value="restaurant_owner">
      </form>

      <form action = "create_account.php">
        <input type = "submit" value = "Go Back"/>
      </form>
    </section>

  </body>
</html>
