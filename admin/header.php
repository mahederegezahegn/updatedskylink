<!DOCTYPE html>
<html lang="en">
<head>
      <title>Dire International Technology Expo</title>     <link rel="icon" type="image/png" href="assets/images/Ict expo final .png">
               
        
</head>
<header class="header">
  <nav class="flex justify-between">
    <a href="#">
      <img src="https://skylinkict.com/wp-content/uploads/2023/05/log-012-160x86.png" alt="Logo" class="w-40 h-10">
    </a>
    <ul class="flex justify-around">
      <li>
        <a href="index.php">
          <i class="fas fa-home"></i>
        </a>
      </li>
      <li>
        <a href="admin.php">
        <i class="fas fa-user-shield"></i>
        </a>
      </li>
      <li>
        <a href="logout.php">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
      <li>
        <!-- Retrieve the username from the session and display it -->
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
          $username = $_SESSION['username'];
          echo $username;
        }
        ?>
      </li>
    </ul>
  </nav>
</header>