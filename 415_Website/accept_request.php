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

// Insert the accepted request into the Restaurants table
$insertRestaurantsSql = "INSERT INTO Restaurants (rname, rdesc, mid) VALUES ('$restaurantName', '$description', $prid)";
if ($conn->query($insertRestaurantsSql) === TRUE) {
    // Retrieve the last inserted ID (rid) from the Restaurants table
    $rid = $conn->insert_id;
    // If insertion into Restaurants table is successful, delete the entry from PendingRestaurant table
    $deletePendingSql = "DELETE FROM PendingRestaurant WHERE prid = $prid";
    if ($conn->query($deletePendingSql) === TRUE) {
        // Redirect back to the admin panel or another appropriate page
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "Error deleting entry from PendingRestaurant table: " . $conn->error;
    }
} else {
    echo "Error inserting entry into Restaurants table: " . $conn->error;
}

$conn->close();
?>
