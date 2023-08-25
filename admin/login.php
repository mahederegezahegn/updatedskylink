<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background:#ddd;
      background-size: cover;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-form {
      max-width: 400px;
      width: 90%;
      padding: 30px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      text-align: left;
    }

    .input-container {
      position: relative;
      margin-bottom: 15px;
    }

    .input-container i {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 10px;
      color: #999;
    }
    
    .input-container input {
      width: 80%;
      padding: 10px 40px 10px 30px;
      border: 1px solid #ccc;
      border-radius: 3px;
      font-size: 14px;
    }

    .input-container input[type="password"] {
      padding-right: 40px;
    }

    .input-container i.show-password {
      right: 10px;
      left: auto;
      cursor: pointer;
    }

    button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      border: none;
      background-color: #007bff;
      color: #fff;
      font-size: 14px;
      font-weight: bold;
      border-radius: 3px;
      cursor: pointer;
    }

    .fa-lock {
      margin-right: 5px;
    }
  </style>
  <script>
    function togglePassword() {
      var passwordInput = document.getElementById("password");
      var eyeIcon = document.getElementById("eye-icon");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
      }
    }
  </script>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    /* CSS styles here */
  </style>
</head>

<body>
  <div class="container">
    <div class="login-form">
      <h1>Admin Login</h1>
      <?php
session_start(); // Start the session

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the username and password
    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        // Assuming you have established a database connection previously
        $dbHost = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'mydatabase';
        $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the query to check if the username and password exist in the database (using prepared statement)
        $query = "SELECT * FROM admins WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Valid login credentials
            $_SESSION['username'] = $username; // Save the username in the session
            $_SESSION['password'] = $password; // Save the password in the session
            echo "Login successful!";
            // Redirect to index.php or perform other actions
            header('Location: index.php');
            exit();
          } else {
            // Invalid login
            $query = "SELECT * FROM admins WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows === 0) {
                $error = "Invalid username.";
            } else {
                $error = "Invalid password.";
            }
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!-- Display the error message if any -->
<?php if (!empty($error)) : ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="handleFormSubmit(event)">
        <div class="input-container">
            <i class="fas fa-user"></i>
            <input type="text" id="username" name="username" placeholder="Username" required>
        </div>

        <div class="input-container">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <i id="eye-icon" class="fas fa-eye" onclick="togglePassword()"></i>
        </div>

        <button type="submit" name="submit"><i class="fas fa-lock"></i> Login</button>

        <?php if (!empty($error)) { ?>
            <div id="error-container"><?php echo $error; ?></div>
        <?php } ?>
        <div id="success-container"></div>
    </form>
</body>
</html>
