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
  if($loggedin == "admin" && basename($_SERVER['PHP_SELF']) != "admin_panel.php") {
    header("location: admin_panel.php");
} else if ($loggedin != "admin" && basename($_SERVER['PHP_SELF']) == "admin_panel.php") {
    header("location: login.php");
}

?>
<!--hello-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="admin_panel_style.css">
  <title>Admin Panel</title>
</head>
<body>

 <!-- Container for success messages -->
 <?php if(isset($_SESSION['delete_message'])): ?>
    <div class="success-message" id="successMessage">
        <?php echo $_SESSION['delete_message']; ?>
    </div>
    <?php unset($_SESSION['delete_message']); // Clear the message after displaying ?>
<?php endif; ?>

  <header id="home">
    <a href="#home"><img src="michelinEatsLogo.png" alt="Logo"></a> 
    <div class="header"></div>
  </header>

  <div class="container">
    <h2>What do you want to check today?</h2>
    <a href="#" class="button" id="usersBtn">Users</a>
    <a href="#" class="button" id="managersBtn">Restaurant Managers</a>
    <a href="#" class="button" id="requestsBtn">Requests</a>
  </div>

  <div class="popup">
    <div class="popup-content" id="usersContent"></div>
    <img src="close.png" alt="Close" class="close">

    <div class="popup-content" id="managersContent"></div>
    <img src="close.png" alt="Close" class="close">

    <div class="popup-content" id="requestContent"></div>
    <img src="close.png" alt="Close" class="close">
  </div>

  


  <script>
    document.getElementById("usersBtn").addEventListener("click", function(){
      // Generate table content
      var usersTable = "<table><thead><tr> <th>CID</th> <th>User Name</th> <th>Name</th> </tr></thead><tbody>";
      
      <?php
        $sql = "SELECT C.cid, C.cuser, C.cname FROM Customers C";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) != 0) {
            echo "var usersData = [";
            while ($row = $result->fetch_assoc()) {
                echo "{ username: '". $row["cuser"] . "', name: '" . $row["cname"] . "', cid: '" . $row["cid"] . "'},";
            }
            echo "];";
        }
      ?>

      // Loop through data and generate table rows
      usersData.forEach(function(user) {
        // NOTE: When retrieving data from js array, make sure the colum name from array matches below:
        usersTable += "<tr data-entry-id='c" + user.cid + "'><td>" + user.cid + "</td><td>"  + user.username + "</td><td>" + user.name + "</td><td><a class='delete-btn' href='delete_entry.php?cid=" + user.cid + "'>Delete</a></td></tr>";

      });
      
      usersTable += "</tbody></table>";
      // Update usersContent with generated table
      document.getElementById("usersContent").innerHTML = usersTable;

      document.getElementById("usersContent").style.display = "block";
      document.getElementById("managersContent").style.display = "none";
      document.getElementById("requestContent").style.display = "none";
      document.querySelector(".popup").style.display = "flex";
    });

    

    document.getElementById("managersBtn").addEventListener("click", function(){

      // Generate table content for managers 
  var managersTable = "<table><thead><tr> <th>MID</th> <th>Manager Username</th> <th>Name</th> </tr></thead><tbody>";
  
  <?php
    $sql = "SELECT mid, mname, muser FROM Managers";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) != 0) {
        echo "var managersData = [";
        while ($row = $result->fetch_assoc()) {
            echo "{username: '". $row["muser"] . "', name: '" . $row["mname"] . "', mid: '" . $row["mid"] . "'},";
        }
        echo "];";
    }
    ?>

  // Loop through data and generate table rows
managersData.forEach(function(manager) {
  managersTable += "<tr data-entry-id='m" + manager.mid + "'><td>" + manager.mid + "</td><td>" + manager.username + "</td><td>" + manager.name + "</td><td><a class='delete-btn' href='delete_entry.php?mid=" + manager.mid + "'>Delete</a></td></tr>";

});
  managersTable += "</tbody></table>";
  // Update managersContent with generated table
  document.getElementById("managersContent").innerHTML = managersTable;
  
      document.getElementById("usersContent").style.display = "none";
      document.getElementById("managersContent").style.display = "block";
      document.getElementById("requestContent").style.display = "none";
      document.querySelector(".popup").style.display = "flex";
    });

    document.getElementById("requestsBtn").addEventListener("click", function(){

      // Generate table content for requests
  var requestsTable = "<table><thead><tr><th>Restaurant Name</th><th>Manager Name</th><th>Description</th><th>Health Inspection Documents</th><th>Action</th></tr></thead><tbody>";
  
  <?php
    $sql = "SELECT P.rname, P.roname, P.rdesc, P.docCheck FROM PendingRestaurant P";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) != 0) {
        echo "var requestsData = [";
        while ($row = $result->fetch_assoc()) {
            echo "{ 'restaurantName': '". $row["rname"] . "', 'managerName': '" . $row["roname"] . "', description: '" .$row["rdesc"] . "', 'documents': '" . $row["docCheck"] ."'},"; 
        }
        echo "];";
    }
    ?>

  // Loop through data and generate table rows
  requestsData.forEach(function(request, index) {
    requestsTable += "<tr data-entry-id='r" + index + "'><td>" + request.restaurantName + "</td><td>" + request.managerName + "</td><td>" + request.description + "</td><td>" + request.documents + "</td><td><button class='accept-btn' data-prid='" + index + "'>Accept</button><button class='deny-btn' data-entry-id='r" + index + "' data-prid='" + index + "'>Deny</button></td></tr>";

  });
  requestsTable += "</tbody></table>";
  // Update requestsContent with generated table
  document.getElementById("requestContent").innerHTML = requestsTable;
  
      document.getElementById("usersContent").style.display = "none";
      document.getElementById("managersContent").style.display = "none";
      document.getElementById("requestContent").style.display = "block";
      document.querySelector(".popup").classList.add("requests-popup"); // Add class to popup
      document.querySelector(".popup").style.display = "flex";
    });

 
  //Add event listener for close buttons
    document.querySelectorAll(".close").forEach(function(closeBtn) {
      closeBtn.addEventListener("click", function(){
        document.querySelector(".popup").style.display = "none";
      });
    });

    
 // Function to display success message
 function showSuccessMessage(message) {
      var successMessageContainer = document.getElementById("successMessage");
      successMessageContainer.innerText = message;
      successMessageContainer.style.display = "block";
      // Hide the message after a certain period
      setTimeout(function() {
        successMessageContainer.style.display = "none";
      }, 3000); // Adjust the timeout as needed
    }

// Add event listeners for delete buttons in users and managers popup windows
document.querySelectorAll(".delete-btn").forEach(function(btn) {
    btn.addEventListener("click", function() {
        // Get the ID of the entry to be deleted (cid or mid)
        var entryId = this.closest("tr").dataset.entryId;

        // Determine if it's a user, manager, or request entry and construct the URL accordingly
        var url;
        if (entryId.startsWith("c")) {
            // For user deletion
            url = "delete_entry.php?cid=" + entryId.substring(1);
        } else if (entryId.startsWith("m")) {
            // For manager deletion
            url = "delete_entry.php?mid=" + entryId.substring(1);
        } else if (entryId.startsWith("r")) {
            // For request deletion
            url = "delete_entry.php?prid=" + entryId.substring(1);
        } else {
            // Handle error if entryId is neither cid, mid, nor rid
            console.error("Invalid entry ID format:", entryId);
            return; // Exit function to prevent further execution
        }

        // Redirect to the constructed URL
        window.location.href = url;
    });
});


document.querySelectorAll(".accept-btn").forEach(function(btn) {
    btn.addEventListener("click", function() {
        var row = this.closest("tr"); // Get the closest row
        var restaurantName = row.querySelector("td:first-child").innerText; // Get the restaurant name
        var description = row.querySelector("td:nth-child(3)").innerText; // Get the description
        var prid = row.dataset.prid; // Get the request ID

        // Redirect to accept_request.php with parameters to handle insertion into Restaurants table
        window.location.href = "accept_request.php?rname=" + encodeURIComponent(restaurantName) + "&rdesc=" + encodeURIComponent(description) + "&prid=" + prid;
    });
});




  </script>
</body>
</html>
