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
        <a href = "aboutUs.html">About Us</a>
        <a href = "viewRestaurant.php">View Restaurants</a>
    </div>

    <section class = "wrapper-main">
      <form>
        <button onclick="location.href='login_customer_account.php';" type="button">Login to Customer Account</button>
        <button onclick="location.href='login_restaurant_account.php';" type="button">Login to Restaurant Manager Account</button>
        <button onclick="location.href='login_admin_account.php';" type="button">Login to Admin Account</button>
      </form>
    </section>
  </body>
</html>

