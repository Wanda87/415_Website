<?php
session_start();
$loggedin = isset($_SESSION["loggedin"]) ? $_SESSION["loggedin"] : "logged out";

if($loggedin == "admin" && basename($_SERVER['PHP_SELF']) != "accept_request.php") {
    header("location: accept_request.php");
} else if ($loggedin == "admin" && basename($_SERVER['PHP_SELF']) == "accept_request.php") {
    header("location: login.php");
}

// Check if parameters are provided
if(isset($_GET['rname']) && isset($_GET['rdesc'])) {
    $rname = $_GET['rname'];
    $rdesc = $_GET['rdesc'];

   //insert sql code here

    // Redirect back to admin panel with success message
    $_SESSION['accept_message'] = "Restaurant '$rname' accepted and added to Restaurants table.";
    header("Location: admin_panel.php");
    exit;
} else {
    // Error handling if parameters are not provided
    $_SESSION['accept_message'] = "Error: Restaurant name or description not provided.";
    header("Location: admin_panel.php");
    exit;
}
?>
