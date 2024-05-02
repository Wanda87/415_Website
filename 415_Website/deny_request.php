<?php
session_start();

$servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
$username = 'admin';
$password = 'password';
$dbname = 'softwareproject';

$loggedin = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : "logged out";

if($loggedin == "admin" && basename($_SERVER['PHP_SELF']) != "deny_request.php") {
    header("location: deny_request.php");
} else if ($loggedin != "admin" && basename($_SERVER['PHP_SELF']) == "deny_request.php") {
    header("location: login.php");
}

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed:" . mysqli_connect_error());
}

// Check if the request ID is provided
if(isset($_GET['prid'])) {
  // Delete entry from PendingRestaurant table
  $entryId = $_GET['prid'];
  
  // Prepare statement
  $stmt = $conn->prepare("DELETE FROM PendingRestaurant WHERE requestId = ?");
  $stmt->bind_param("i", $entryId); 
  if ($stmt->execute()) {
      $_SESSION['deny_message'] = 'Request denied and removed successfully.';
  } else {
      $_SESSION['deny_message'] = 'Error denying request: ' . $conn->error;
  }
  $stmt->close();
} else {
  // No request ID provided
  $_SESSION['deny_message'] = 'Error: No request ID provided for denial.';
}


// After denial is complete, redirect back to the admin panel page
header("Location: admin_panel.php");
exit; // Ensure script execution stops after redirection
?>
