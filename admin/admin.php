<!DOCTYPE html>
<html>
<head>
  <title>Admin Page</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="style.css">
  <style>
    /* CSS for the admin table */
    .admin-table {
      width: 100%;
      border-collapse: collapse;
    }
    .admin-table th, .admin-table td {
      border: 1px solid #ddd;
      padding: 8px;
    }
    .admin-table th {
      background-color: #f2f2f2;
    }

    /* CSS for the add form */
    .add-form {
      display: none;
      padding: 10px;
      border: 1px solid #ddd;
    }
    .add-form label {
      display: block;
      margin-bottom: 5px;
    }
    .add-form input[type="text"],
    .add-form input[type="password"] {
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
    }
    .add-form button {
      display: block;
      width: 100px;
      padding: 5px;
      margin-top: 10px;
    }
  </style>
  <script>
    // JavaScript to show/hide the add form
    function toggleAddForm() {
      var form = document.getElementById("addForm");
      form.style.display = (form.style.display === "none") ? "block" : "none";
    }
  </script>
</head>
<body>
<?php
include_once('header.php');

include_once('dbcon.php');

echo '<div class="flex">';
include_once('side.php');
?>


<main class="flex w-full">
  <div class="bods bg-gray-100 p-4">

  <!-- <button >Add</button> -->
  <button class="add-event" onclick="toggleAddForm()">
        <i class="fas fa-plus"></i> Add
      </button>
 

  <table class="admin-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>password</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php

       // Fetch events from the database
       $query = "SELECT * FROM admins";
       $result = $mysqli->query($query);
       if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
                 echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['username'] . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['password'] . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">
                <a href="deladmin.php?id=' . $row['id'] . '">
                    <i class="fa fa-trash-alt" aria-hidden="true" style="color:red;" > Delete</i>
                </a>
              </td>';
                echo "</tr>";
        }
        
      }else{
          echo '<tr><td colspan="4">No events found.</td></tr>';
        }
      ?>
    </tbody>
  </table>
  <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $adminName = $_POST['adminName'];
  $adminPassword = $_POST['adminPassword'];

  // Validate form fields
  $errors = array();

  if (empty($adminName)) {
      $errors[] = 'Please enter a name.';
  } elseif (!filter_var($adminName, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Please enter a valid email address.';
  }

  if (empty($adminPassword)) {
      $errors[] = 'Please enter a password.';
  } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $adminPassword)) {
      $errors[] = 'Please enter a password with minimum 8 characters and a combination of letters and numbers.';
  }

  // Check for username duplication
  if (empty($errors)) {
      // Assuming you have a database connection established
      $stmt = $mysqli->prepare("SELECT COUNT(*) FROM admins WHERE username = ?");
      $stmt->bind_param("s", $adminName);
      $stmt->execute();
      $stmt->bind_result($count);
      $stmt->fetch();
      $stmt->close();

      if ($count > 0) {
          $errors[] = 'Username already exists. Please choose a different username.';
      }
  }

  if (!empty($errors)) {
      // Display validation errors
      foreach ($errors as $error) {
          echo $error . "<br>";
      }
  } else {
    // Prepare the insert statement
    $stmt = $mysqli->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");

    if (!$stmt) {
        die("Error preparing statement: " . $mysqli->error);
    }

    // Bind the parameters and execute the statement
    $stmt->bind_param("ss", $adminName, $adminPassword);

    if ($stmt->execute()) {
        // Insertion successful
        // echo "Admin added successfully.";
        // header('location:admin.php');
    } else {
        // Insertion failed
        echo "Error adding admin: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
}
?>



<form id="addForm" class="add-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  <h2>Add Admin</h2>
  <label for="adminName">Name:</label>
  <input type="text" id="adminName" name="adminName" placeholder="Enter name" required>

  <label for="adminPassword">Password:</label>
  <input type="password" id="adminPassword" name="adminPassword" placeholder="Enter password" required>

  <button type="submit">Submit</button>
  <button type="button" onclick="toggleAddForm()">Close</button>
</form>
  </div>
  </main>
</body>
<script>
function validateForm() {
  var adminName = document.getElementById('adminName').value;
  var adminPassword = document.getElementById('adminPassword').value;

  if (adminName.trim() === '') {
    alert('Please enter a name.');
    return false;
  }

  if (adminPassword.trim() === '') {
    alert('Please enter a password.');
    return false;
  }

  // Validate email format
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(adminName)) {
    alert('Please enter a valid email address.');
    return false;
  }

  // Validate password strength
  var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
  if (!passwordRegex.test(adminPassword)) {
    alert('Please enter a password with minimum 8 characters and a combination of letters and numbers.');
    return false;
  }

  return true;
}
</script>
</html>