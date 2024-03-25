<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Michelin Eats | Login</title>
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

  <section class="wrapper-main">
    <form action="includes/formHandler.php" method="post">

      <label for="username">Username:</label>
      <input required type="text" id="username" name="username" placeholder="Enter your username">

      <label for="pwd">Password:</label>
      <input required type="password" id="pwd" name="pwd" placeholder="Enter your password">

      <button type="submit" value="login">Log In</button>
    </form>

    <form action = "create_account.php">
        <button type = "submit" value = "create_acc">Don't have an account? Create one here.</button>
    </form>
  </section>

</body>
</html>
