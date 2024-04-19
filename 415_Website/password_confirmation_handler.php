<?php

$servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
$username = 'admin';
$password = 'password';


$conn = new mysqli($servername, $username, $password);
if ($conn -> connect_error){
    die("Connection failed: " .$conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $account_type = $_POST["account_type"]; // Get the account type from the form


    // Check if passwords match
    if ($password !== $confirm_password) {
        // Redirect back to the respective account creation page with an error message
        $redirect_url = "";


        // Determine the appropriate redirect URL based on the account type
        switch ($account_type) {
            case "customer":
                $redirect_url = "create_customer_account.php";
                break;
            case "restaurant_owner":
                $redirect_url = "create_restaurant_account.php";
                break;
            case "admin":
                $redirect_url = "create_admin_account.php";
                break;
            default:
                // Handle invalid account type (optional)
                break;
        }


        // Redirect back to the respective account creation page with an error message
        header("Location: $redirect_url?error=password_mismatch");
        exit;
    }


    // Proceed with further processing if passwords match
   // Hash the password before storing it in the database for security
   $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   // Insert user data into the database
   $sql = "INSERT INTO Customers (cname, cuser, cpass) VALUES ('$name', '$username', '$hashed_password')";
   
   if ($conn->query($sql) === TRUE) {
       // Redirect to login page.
       header("Location: Login.php");
       exit;
   } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
   }

}

// Close the database connection
$conn->close();
?>



