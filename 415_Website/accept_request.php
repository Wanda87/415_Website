<?php
// Establish database connection
$servername = "databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "password";
$dbname = "softwareproject";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve parameters from URL
$restaurantName = $_GET['rname'];
$description = $_GET['rdesc'];
$prid = $_GET['prid'];

// Insert the accepted request into the database
$sql = "INSERT INTO Restaurants (rname, rdesc) VALUES ('$restaurantName', '$description')";

if ($conn->query($sql) === TRUE) {
    // Redirect back to the admin panel or another appropriate page
    header("Location: admin_panel.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
