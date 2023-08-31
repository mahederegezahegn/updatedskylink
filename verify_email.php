<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification Success</title>
  <style>
    /* Put your CSS styles here */
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
      color: #333333;
      margin-top: 0;
      margin-bottom: 20px;
    }
    p {
      color: #555555;
      font-size: 16px;
      line-height: 1.5;
      margin-bottom: 20px;
    }
    .button {
      display: inline-block;
      background-color: #4CAF50;
      color: #ffffff;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    .button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

<?php

// Assuming the token is passed as a query parameter in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the token exists in the database
        $stmt = $conn->prepare("SELECT * FROM registor WHERE email = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            // Token exists, update the verified value
            $stmt = $conn->prepare("UPDATE registor SET verified = 'verified' WHERE email = :token");
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            // Check if any rows were affected by the update
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                ?>
                <div class="container">
                    <h2>Congratulations! Your Email has been Verified</h2>
                    <p>
                        Thank you for verifying your email. Your email has been successfully verified, and your account is now active.
                    </p>
                    <p>
                        You can now enjoy all the benefits and features of our platform. If you have any questions or need further assistance, please don't hesitate to contact us.
                    </p>
                    <p>
                        <strong>Get started now!</strong>
                    </p>
                    <p>
                        <a class="button" href="index.html">Go to Dashboard</a>
                    </p>
                </div>
                <?php
            } else {
                ?>
                <div class="container">
                    <h2>Your account has already been verified</h2>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="container">
                <h2>Invalid token</h2>
            </div>
            <?php
        }
    } catch (PDOException $e) {
        ?>
        <div class="container">
            <h2>Error updating verified status</h2>
            <p><?php echo $e->getMessage(); ?></p>
        </div>
        <?php
    }
} else {
    ?>
    <div class="container">
        <h2>Invalid token</h2>
    </div>
    <?php
}
?>
</body>
</html>