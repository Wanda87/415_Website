<?php
session_start();


$loggedin = isset($_SESSION["loggedin"]) ? $_SESSION["loggedin"] : "logged out";

if($loggedin != "logged out" && basename($_SERVER['PHP_SELF']) != "viewRestaurant.php") {
    header("location: viewRestaurant.php");
} else if ($loggedin == "logged out" && basename($_SERVER['PHP_SELF']) == "viewRestaurant.php") {
    header("location: login.php");
}

$servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
$username = 'admin';
$password = 'password';
$dbname = 'softwareproject';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed:" . mysqli_connect_error());
}


// Calculate average rating only if a restaurant is selected
if (isset($_POST['restaurants'])) {
    $restChoice = $_POST['restaurants'];
    $_SESSION['restChoice'] = $restChoice;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Restaurants</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <img src="michelinEatsLogo.png" alt="Logo">
    <h1>Michelin Eats</h1>
</div>

<!--Links-->
<div>
    <a href="login.php">Login</a>
    <a href="create_account.php">Create an Account</a>
    <a href="aboutUs.php">About Us</a>
    <a href="viewRestaurant.php">View Restaurants</a>
    <?php if ($loggedin == "manager"): ?>
        <a href = "managerPortal.php">Back to Manager Portal</a>
    <?php endif; ?>
    <?php if ($loggedin != "logged out"): ?>
        <a href = "logout.php">Logout</a>
    <?php endif; ?>
</div>

<br>

<script>
  // Function to validate the form before submission
  function validateForm() {
    var restaurantSelect = document.getElementById('restaurant-select');

    // Check if the selected value is the default "Select" option
    if (restaurantSelect.value === "") {
      alert("Please select a restaurant.");
      return false; // Prevent form submission
    }
    return true; // Allow form submission
  }
</script>

<div class="container">
<form method="post">
    <!-- Page will be directed to result -->
    <label for="restaurants">Select a Restaurant: </label>
    <?php
    $sql = "SELECT R.rid, R.rname FROM Restaurants R";
    $result = $conn->query($sql);

    // creating dropdown menu for restaurants
    if (mysqli_num_rows($result) != 0) {
        echo "<select name='restaurants'>";
        echo "<option value=''>- Select -</option>"; // Add none or -select- option
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["rid"] . "'>" . $row["rname"] . "</option>";
        }
        echo "</select> <input type='submit' name='submit' id = 'submit' value='SEARCH'/>";
    }

    ?>
</form>

<?php
    if(isset($_POST['submit'])){
        $restchoice = $_POST['restaurants'];
        $_SESSION['restChoice'] = $restchoice;
        header("Location: rating_comments_log.php");
    }
?>

</div>

<!-- Display average rating only if a restaurant is selected -->
<?php if (isset($_POST['restaurants']) && $average_rating !== 'N/A'): ?>
    <div>
        <p>Average Rating: <?php echo $average_rating; ?></p>
    </div>
<?php endif; ?>

</body>
</html>
