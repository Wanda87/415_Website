<?php
session_start();
$servername = "databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "password";
$database = "softwareproject";
$loggedin = "logged out";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass =  $_POST['pwd'];
  
    $check = $conn->prepare("SELECT cname, cpass FROM Customers WHERE cuser = ?");
    $check->bind_param("s", $user);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        $check->bind_result($cname, $cpass);
        $check->fetch();
        if (password_verify($pass, $cpass)) {
          $_SESSION['loggedin'] = "customer";
          header("Location: viewRestaurant.php");
          exit;
        } 
    }

    $check = $conn->prepare("SELECT auser, apass FROM Admins WHERE auser = ?");
    $check->bind_param("s", $user);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        $check->bind_result($aname, $apass);
        $check->fetch();
        if (password_verify($pass, $apass)) {
           $_SESSION['loggedin'] = "admin";
           header("Location: admin_panel.php");
           exit;
        }
    }
    
    $check = $conn->prepare("SELECT mname, mpass FROM Managers WHERE mname= ?");
    $check->bind_param("s", $user);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        $check->bind_result($mname, $mpass);
        $check->fetch();
        if (password_verify($pass, $mpass)) {
          $_SESSION['loggedin'] = "manager";
          header("Location: managerPortal.php");
          exit;
        }
    }

    // If none of the above conditions are met, user does not exist.
    $showNotification = true;
} else {
  $showNotification = false; // Set $showNotification to false when not in POST request.
}

?>





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
  <?php if (isset($showNotification) && $showNotification): ?>
        <a href="#" class="notification">
            <span>Username and password combination does not exist.</span>
            <span class="badge"></span>
       
        </a>
        <br></br>
    <?php endif; ?>
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

