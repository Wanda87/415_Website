<?php


$servername = "databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "password";
$database = "softwareproject";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $user = $_POST['username'];
    $pass =  $_POST['password'];
    $confirmPass = $_POST['confirm_password'];

    if ($pass !== $confirmPass) {
        echo "Passwords do not match";
    } else {

        $check = $conn->prepare("SELECT cname FROM Customers WHERE cuser = ?");
        $check->bind_param("s", $user);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $showNotification = true;
        } else {
            $check = $conn->prepare(" SELECT aname FROM Admins WHERE auser = ? ");
        
            $check->bind_param("s", $user);
            $check->execute();
            $check->store_result();
        
            if ($check->num_rows > 0) {
                $showNotification = true;
            } else {
                $check = $conn->prepare(" SELECT mname  FROM Managers  WHERE muser = ?  ");
                $check->bind_param("s", $user);
                $check->execute();
                $check->store_result();
        
                if ($check->num_rows > 0) {
                    $showNotification = true;
                } else {
                    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        
                    $stmt = $conn->prepare("INSERT INTO Admins (auser, apass) VALUES (?, ?)");
                    $stmt->bind_param("ss", $user, $hashedPass);
                    $result = $stmt->execute();
        
                    if ($result) {
                        echo "New record created successfully";
                        header("Location: login.php");
                        exit();
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                }
            }
        }
        
        $check->close();
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    <img src="michelinEatsLogo.png" alt="Logo">
    <h1>Michelin Eats</h1>
</div>

<section class="wrapper-main">
<?php if (isset($showNotification) && $showNotification): ?>
        <a href="#" class="notification">
            <span>That username already exists, please select another username.</span>
            <span class="badge"></span>
        </a>
        <br></br>
    <?php endif; ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input required type="text" id="username" name="username" placeholder="Enter your username">

        <label for="password">Password:</label>
        <input required type="password" id="password" name="password" placeholder="Enter your password">

        <label for="confirm_password">Confirm Password:</label>
        <input required type="password" id="confirm_password" name="confirm_password" placeholder="Re-enter your password">

        <button type="submit">Create Admin Account</button>
    </form>

    <form action="create_account.php">
        <input type="submit" value="Go Back"/>
    </form>
</section>

</body>
</html>
