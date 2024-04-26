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

  if (isset($_GET['cid'])){
    echo $_GET['cid'];
    
    //$deleteRow = mysqli_query($conn, "DELETE FROM `Customers` WHERE `cid` = $cid");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="admin_panel_style.css">
  <title>Admin Panel</title>
</head>
<body>
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

    <button class="save-btn" id="usersSubmit">Save</button>
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
        usersTable += "<tr><td>" + user.cid + "</td><td>"  + user.username + "</td><td>" + user.name + "</td><td><a class='delete-btn' href = 'admin_panel.php?cid= '>Delete</a></td></tr>";
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

      // Generate table content for managers (similar to users)
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
  managersTable += "<tr><td>" + manager.mid + "</td><td>" + manager.username + "</td><td>" + manager.name + "</td><td><button class='delete-btn'>Delete</button></td></tr>";
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
  requestsData.forEach(function(request) {
    requestsTable += "<tr><td>" + request.restaurantName + "</td><td>" + request.managerName + "</td><td>" + request.description + "</td><td>" + request.documents + "</td><td><button class='accept-btn'>Accept</button><button class='deny-btn'>Deny</button></td></tr>";
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

    // Add event listeners for accept and deny buttons
  document.querySelectorAll(".accept-btn").forEach(function(btn) {
    btn.addEventListener("click", function() {
      // Perform accept action for the corresponding request
      console.log("Accept button clicked for request ID: ", this.closest("tr").dataset.requestId);
    });
  });
  
  document.querySelectorAll(".deny-btn").forEach(function(btn) {
    btn.addEventListener("click", function() {
      // Perform deny action for the corresponding request
      console.log("Deny button clicked for request ID: ", this.closest("tr").dataset.requestId);
    });
  });
  //Add event listener for close buttons
    document.querySelectorAll(".close").forEach(function(closeBtn) {
      closeBtn.addEventListener("click", function(){
        document.querySelector(".popup").style.display = "none";
      });
    });
  </script>
</body>
</html>
