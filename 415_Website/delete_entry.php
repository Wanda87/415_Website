<?php
session_start();

$servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
$username = 'admin';
$password = 'password';
$dbname = 'softwareproject';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed:" . mysqli_connect_error());
}

// Check if the cid or mid is provided
if(isset($_GET['cid'])) {
    // Delete entry from users/customers table
    $cid = $_GET['cid'];
    
    // Prepare statement
    $stmt = $conn->prepare("DELETE FROM Customers WHERE cid = ?");
    $stmt->bind_param("i", $cid); // "i" indicates integer type
    if ($stmt->execute()) {
        $_SESSION['delete_message'] = 'User deleted successfully.';
    } else {
        $_SESSION['delete_message'] = 'Error deleting user: ' . $conn->error;
    }
    $stmt->close();
} elseif(isset($_GET['mid'])) {
    // Delete entry from managers table
    $mid = $_GET['mid'];
    
    // Prepare statement
    $stmt = $conn->prepare("DELETE FROM Managers WHERE mid = ?");
    $stmt->bind_param("i", $mid); // "i" indicates integer type
    if ($stmt->execute()) {
        $_SESSION['delete_message'] = 'Manager deleted successfully.';
    } else {
        $_SESSION['delete_message'] = 'Error deleting manager: ' . $conn->error;
    }
    $stmt->close();
} 

  elseif(isset($_GET['prid'])) {
  // Delete entry from managers table
  $prid = $_GET['prid'];
  
  // Prepare statement
  $stmt = $conn->prepare("DELETE FROM PendingRestaurant WHERE prid = ?");
  $stmt->bind_param("i", $prid); // "i" indicates integer type
  if ($stmt->execute()) {
      $_SESSION['delete_message'] = 'Request deleted successfully.';
  } else {
      $_SESSION['delete_message'] = 'Error deleting request: ' . $conn->error;
  }
  $stmt->close();
} 


  else {
    // Neither cid nor mid nor prid provided
    $_SESSION['delete_message'] = 'Error: No ID provided for deletion.';
}

// After deletion is complete, redirect back to the admin panel page
header("Location: admin_panel.php");
exit; // Ensure script execution stops after redirection
?>


