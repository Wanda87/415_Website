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
    </form>
  </body>
</html>