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
  </div>

  <script>
    document.getElementById("usersBtn").addEventListener("click", function(){
      // Generate table content
      var usersTable = "<table><thead><tr><th>User Name</th><th>Name</th></tr></thead><tbody>";
      // Hardcoded data (replace with data fetched from database)
      var usersData = [
        { username: "john_doe", name: "John Doe" },
        { username: "jane_smith", name: "Jane Smith" },
       
      ];
      // Loop through data and generate table rows
      usersData.forEach(function(user) {
  usersTable += "<tr><td>" + user.userName + "</td><td>" + user.name + "</td><td><button class='delete-btn'>Delete</button></td></tr>";
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
  var managersTable = "<table><thead><tr><th>Manager ID</th><th>Name</th></tr></thead><tbody>";
  // Hardcoded data (replace with data fetched from database)
  var managersData = [
    { managerID: "1", name: "Manager 1" },
    { managerID: "2", name: "Manager 2" },
    // Add more data as needed
  ];
  // Loop through data and generate table rows
managersData.forEach(function(manager) {
  managersTable += "<tr><td>" + manager.userName + "</td><td>" + manager.name + "</td><td><button class='delete-btn'>Delete</button></td></tr>";
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
  var requestsTable = "<table><thead><tr><th>Restaurant Name</th><th>Manager Name</th><th>Description</th><th>Health Inspection Documents</th><th>Email Address</th><th>Action</th></tr></thead><tbody>";
  // Hardcoded data (replace with data fetched from database)
  var requestsData = [
    { restaurantName: "Restaurant A", managerName: "Manager A", description: "Description A", documents: "Documents A", email: "email@example.com" },
    { restaurantName: "Restaurant B", managerName: "Manager B", description: "Description B", documents: "Documents B", email: "email@example.com" },
    // Add more data as needed
  ];
  // Loop through data and generate table rows
  requestsData.forEach(function(request) {
    requestsTable += "<tr><td>" + request.restaurantName + "</td><td>" + request.managerName + "</td><td>" + request.description + "</td><td>" + request.documents + "</td><td>" + request.email + "</td><td><button class='accept-btn'>Accept</button><button class='deny-btn'>Deny</button></td></tr>";
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

    document.querySelectorAll(".close").forEach(function(closeBtn) {
      closeBtn.addEventListener("click", function(){
        document.querySelector(".popup").style.display = "none";
      });
    });
  </script>
</body>
</html>
