<!--TODO: grab rid from session variable rid -->

<!DOCTYPE html>
<?php
    $servername = 'databaseprojectrahhhh.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
    $username = 'admin';
    $password = 'password';
    $dbname = 'softwareproject';

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn -> connect_error){
        die("Connection Failed:" .mysqli_connect_error());
    }
    // sql = select rid from restaurants where mid = rid;

    $rid = 1; // THIS IS JUST FOR TESTING! We need to carry over the manager's mid to get the associated rid

    if(isset($_POST['submit']))
    {
        $itemName = $_POST['itemname'];
        $itemDesc = $_POST['iteamdesc'];

        if (count($_FILES) > 0)
        { // handles the process of getting the image data into a long blob
            if (is_uploaded_file($_FILES['itemImage']['tmp_name']))
            {
                $imgData = file_get_contents($_FILES['itemImage']['tmp_name']);
                $imgType = $_FILES['itemImage']['type'];
                $sql = "INSERT INTO Items(itemImage, iteamdesc, itemname, rid) VALUES(?, ?, ?, ?)";
                $statement = $conn->prepare($sql);
                $statement->bind_param('ssss', $imgData, $itemDesc, $itemName, $rid);
            }
        }
        if($statement -> execute())
            echo "<h2 style = 'text-align: center;'>Form Submission Successful!</h2>";
        else
            echo "<h2 style = 'text-align: center;'>Whu-oh! There was a problem with submitting your form.</h2>";
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
            <a href = "aboutUs.html">About Us</a>
            <a href = "viewRestaurant.php">View Restaurants</a>
            <a href = "applicationForm.php">Application Form</a>
            <a href = "menuItem.php">Add Menu Item</a>
            <a href = "logout.php">Logout</a>
        </div>

        <!-- TODO: There should be some php in here, first to check if the restaurant is approved before
                showing the menu and item form -->
        <?php
            echo "<h2 style = 'text-indent: 5px; text-align: center;'>Current Menu:</h2>";

            $restSQL = "SELECT I.itemImage, I.itemname, I.iteamdesc FROM Items I WHERE I.rid = '$rid'";
            $restResult = $conn->query($restSQL);

            echo "<div style = 'margin: 20px;'>"; // add images to table please and thanks
            if (mysqli_num_rows($restResult) != 0) {
                echo "<table><tbody>";
                while ($row = $restResult->fetch_assoc()) {
                    echo "<tr><td style='padding: 0 15px;'>" . $row["itemname"] . "</td><td>" . $row["iteamdesc"] . "</td></tr>";
                }
                echo "</tbody></table>";
            }
            else {
                echo "<p style = 'text-align: center;'>No current items in this restaurant!</p>";
            }
            echo "</div>";
        ?>

        <h2 style = "text-indent: 5px; text-align: center;">New Item</h2>

        <form method = "POST" enctype="multipart/form-data"> <!-- Application form below: -->
            <label>Item Name: </label>
            <input name = "itemname" id = "itemname" type = "text" style = "width: 35%;" required>

            <label>Item Description: </label>
            <input name = "iteamdesc" id = "iteamdesc" type = "text" style = "width: 35%;" required>

            <label>Submit an Image for your Menu Item: </label>
            <input name = "itemImage" id = "itemImage" type = "file" accept = ".jpg, .jpeg, .png" required
                   style = "font-size: 18px; text-align: center;"> <br><br>

            <button type = "submit" id = "submit" name = "submit" style = "width: 35%;">Submit Item</button>
            
        </form>
    </body>
</html>