<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>View Restaurants</title>
    <link rel="stylesheet" href = "style.css">
  </head>

  <body>
    <div class="header">
      <img src="michelinEatsLogo.png" alt="Logo"> 
      <h1>Michelin Eats</h1>
    </div>

    <!--Links-->
    <div>
        <a href = "login.php">Login</a>
        <a href = "create_account.php">Create an Account</a>
        <a href = "aboutUs.html">About Us</a>
        <a href = "viewRestaurant.php">View Restaurants</a>
    </div>

    <br>

    <form>
        <label for = "resturants">Select a Restaurant: </label>
        <select name = "rests">
            <option>Rest_1</option>
            <option>Rest_2</option>
            <option>Rest_3</option>
        </select>
        
        <div>
          <p style = "text-align: left;">Restaurant: REST</p> <!--REST needs to be replaced with a php var later-->
        </div>
        <table>
            <tr>
                <td style = "position: relative;">
                    <div class = "container">
                        <img src = "steak.jpg">
                        <p>Sirloin Steak</p>
                    </div>
                </td>
                <td style = "position: relative;">
                    <div class = "container">
                        <img src = "soup.jpg">
                        <p>Mushroom Soup</p>
                    </div>
                </td>
            </tr>
        </table>

        <?php
            $servername = 'database-1.ctk6a08mqegz.us-east-2.rds.amazonaws.com';
            $username = 'admin';
            $password = 'password';
            $dbname = 'databaseproject';
  
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if ($conn -> connect_error){
              die("Connection Failed:" .mysqli_connect_error());
            }
            
            $sql = "SELECT R.rname, R.rdesc FROM Resturants R";
            // maybe include a thingy above like, WHERE R.rname = NAME_FROM_DROPDOWN_LIST
            $result = $conn -> query($sql);
  
            if(mysqli_num_rows($result) != 0){
              echo "<table><tbody>";
              echo "<tr style = 'font-weight: bold;'><td>Rest Name</td><td>Rest Desc</td></tr>";
              while ($row = $result->fetch_assoc()){
                  // adds a new row to the table (a course)
                  echo "<tr><td>". $row["rname"] . "</td><td>" . $row["rdesc"] . "</td></tr>";
              }
              echo "</tbody></table>";
            }
  
          ?>
    </form>
  </body>
</html>
