<DOCTYPE html>
<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
    {
        $servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
        $username = 'admin';
        $password = 'password';
        $dbname = 'softwareproject';

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if ($conn -> connect_error){
            die("Connection Failed:" .mysqli_connect_error());
        }
    }
?>

<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Application Form</title>
        <link rel="stylesheet" href = "style.css">
    </head>

    <body>
        <div class="header">
        <img src="michelinEatsLogo.png" alt="Logo"> 
        <h1>Michelin Eats</h1>
        </div>

        <!--Links-->
        <div>
            <a href = "aboutUs.php">About Us</a>
            <a href = "viewRestaurant.php">View Restaurants</a>
            <a href = "applicationForm.php">Application Form</a>
            <a href = "logout.php">Logout</a>
        </div>

        <br>

        <?php
            if(isset($_POST['submit']))
            {
                $rname = $_POST['rname'];
                $rdesc = $_POST['rdesc'];
                $roname = $_POST['roname'];
                $docCheck = $_POST['docCheck'];

                $mid = $_SESSION['mid'];

                // OKAY OKAY IT WORKS!!
                if (count($_FILES) > 0)
                { // handles the process of getting the image data into a long blob
                    if (is_uploaded_file($_FILES['headImage']['tmp_name']))
                    {
                        $imgData = file_get_contents($_FILES['headImage']['tmp_name']);
                        $imgType = $_FILES['headImage']['type'];
                        $sql = "INSERT INTO PendingRestaurant(rname, headImage, rdesc, roname, docCheck, mid) VALUES(?, ?, ?, ?, ?, ?)";
                        $statement = $conn->prepare($sql);
                        $statement->bind_param('ssssss', $rname, $imgData, $rdesc, $roname, $docCheck, $mid);
                    }
                }
                if($statement -> execute())
                    echo "<h2 style = 'text-align: center;'>Form Submission Successful!</h2>";
                else
                    echo "<h2 style = 'text-align: center;'>Whu-oh! There was a problem with submitting your form.</h2>";
            }
        ?>
    </body>
</html>