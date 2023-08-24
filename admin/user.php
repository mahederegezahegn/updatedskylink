<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page - ICT Expo</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php
include_once('header.php');


  echo'<div class="flex">';
 
include_once('side.php');
?>
    <main class="flex w-full">
       
       
        <div class="bods bg-gray-100 p-4">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="search-bar">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search...">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
</div>

<?php
// Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

// Create a new mysqli connection
$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

// Handle search input
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare and execute a SELECT query to retrieve data from the registor table
$query = "SELECT * FROM registor WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%' OR phone_number LIKE '%$search%' OR company_name LIKE '%$search%'";
$result = $mysqli->query($query);

// Check if any rows are returned
if ($result->num_rows > 0) {
    ?>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    First Name
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Last Name
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Phone Number
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Company Name
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through each row of data and generate table rows
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['first_name']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['last_name']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['email']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['phone_number']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['company_name']; ?></div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
} else {
    echo "No data found in the registor table.";
}

// Close the database connection
$mysqli->close();
?>
            </div>
          </div>
    <div class="statics">
         
    </div>
   </div>
    </main>

  </body>
  </html>