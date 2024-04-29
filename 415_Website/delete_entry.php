<?php
 session_start();

 $loggedin = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : "logged out";

   
 if($_SESSION["loggedin"] == "admin" && basename($_SERVER['PHP_SELF']) != "delete_entry.php"){
    header("location: delete_entry.php");
  }else if ($_SESSION["loggedin"] != "admin" && basename($_SERVER['PHP_SELF']) == "delete_entry.php"){
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
} else {
    // Neither cid nor mid provided
    $_SESSION['delete_message'] = 'Error: No ID provided for deletion.';
}

// After deletion is complete, redirect back to the admin panel page
header("Location: admin_panel.php");
exit; // Ensure script execution stops after redirection
?>
