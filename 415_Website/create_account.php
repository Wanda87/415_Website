<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account</title>
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
        <a href = "aboutUs.php">About Us</a>
        <a href = "viewRestaurant.php">View Restaurants</a>
    </div>

    <section class = "wrapper-main">
      <form>
        <button onclick="location.href='create_customer_account.php';" type="button">Customer Account</button>
        <button onclick="location.href='create_restaurant_account.php';" type="button">Restaurant Manager Account</button>
        <button onclick="location.href='create_admin_account.php';" type="button">Admin Account</button>
      </form>
    </section>
  </body>
</html>
