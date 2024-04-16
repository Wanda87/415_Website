<?php

$servername = "database-1.ctk6a08mqegz.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "password";
$database = "databaseproj";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = $_POST['username']; 
    $pass = $_POST['pwd'];       // Corrected from 'pwd' to 'pwd'

    $check = $conn->prepare("SELECT cname FROM Customers WHERE cuser = ?");
    $check->bind_param("s", $user);
    $check->execute();
    $check->store_result();
        
    if ($check->num_rows > 0) {
        header("Location: login.php");
        print("True");
        exit; // Add an exit to stop script execution after redirect
    } else {
        print("False");
    }
    $check->close(); // Close the prepared statement
}

?>







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
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
