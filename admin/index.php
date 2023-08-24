<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include_once('header.php');


  echo'<div class="flex">';
 
include_once('side.php');
?>    <main class="p-8">
<div class="card-container">
      <div class="card">
  <i class="fas fa-users" style="color:blue;"></i>
  <div class="grid">
    <label>Registors </label>
    <label> 
         <?php
        // Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
        $dbHost = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'mydatabase';

        try {
          // Create a new PDO instance
          $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

          // Fetch the number of registers from the database
          $query = $pdo->query("SELECT COUNT(*) AS totalRegisters FROM registor");
          $result = $query->fetch(PDO::FETCH_ASSOC);
          $totalRegisters = $result['totalRegisters'];

          echo $totalRegisters;
        } catch (PDOException $e) {
          echo "Database connection error: " . $e->getMessage();
        }
      ?></label>
  </div>
             </div>
        <div class="card">
          <i class="fas fa-chart-line"style="color:green;"></i>
          <div class="grid">  
<label>Exhibitors</label>
   <label> <?php
        // Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
    
        try {
          // Create a new PDO instance
          $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

          // Fetch the number of registers from the database
          $query = $pdo->query("SELECT COUNT(*) AS totalexbitors FROM exhibitors");
          $result = $query->fetch(PDO::FETCH_ASSOC);
          $totalexbitors = $result['totalexbitors'];

          echo $totalexbitors;
        } catch (PDOException $e) {
          echo "Database connection error: " . $e->getMessage();
        }
      ?></label>
  </div>
             </div>                 <div class="card">
 <i class="fas fa-newspaper" style="color:red;"></i>
  <div class="grid">
    <label>News </label>
    <label> 
         <?php
        // Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
    
        try {
          // Create a new PDO instance
          $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

          // Fetch the number of registers from the database
          $query = $pdo->query("SELECT COUNT(*) AS totalRegisters FROM events");
          $result = $query->fetch(PDO::FETCH_ASSOC);
          $totalRegisters = $result['totalRegisters'];

          echo $totalRegisters;
        } catch (PDOException $e) {
          echo "Database connection error: " . $e->getMessage();
        }
      ?></label>
  </div>
             </div>   



      </div>
      
      <?php
      
    
    $exhibitorsCount = 30;
  ?>
  <div class="progress-container">
    <h1>position left</h1>
<div class="progress-bar-container">
    <div id="registers-progress" class="progress-bar" style="width: <?php echo $totalRegisters; ?>%;"></div>
  </div>
  <p id="registers-text" class="progress-text">Registers: <?php echo $totalRegisters; ?></p>

  <div class="progress-bar-container">
    <div id="exhibitors-progress" class="progress-bar" style="width: <?php echo $exhibitorsCount; ?>%;"></div>
  </div>
  <p id="exhibitors-text" class="progress-text">Exhibitors: <?php echo $exhibitorsCount; ?></p>
     
  </div>
    </main>
  </div>
</body>

</html>