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
<style>
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      display: none;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;
      max-width: 700px;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    form.show {
      display: block;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="submit"],
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      font-size: 14px;
      margin-bottom: 15px;
    }
    .close-icon {
      position: absolute;
      top: 10px;
      right: 10px;
      color: #999;
      cursor: pointer;
    }

    .close-icon:hover {
      color: #555;
    }
</style>
<body>
  
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

include_once('header.php');

echo '<div class="flex">';
include_once('side.php');
?>

<main class="flex w-full">
  <div class="bods bg-gray-100 p-4">

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button type="submit"><i class="fas fa-search"></i></button>
      </div>
      <button class="add-event">
        <i class="fas fa-plus"></i> Add Event
      </button>
      <table class="divide-y divide-gray-200">
        <thead>
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Date</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Location</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Fetch events from the database
          $query = "SELECT * FROM events";
          $result = $mysqli->query($query);

          // Check if there are any events
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['event_title'] . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['event_date'] . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['event_description'] . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">';
                echo '<a href="edit.php?id=' . $row['id'] . '" class="text-indigo-600 hover:text-indigo-900 mr-2"> <i class="fas fa-edit"></i>Edit</a>';
                echo '<a href="delete_event.php?id=' . $row['id'] . '" class="text-red-600 hover:text-red-900"> <i class="fas fa-trash-alt"></i>Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="4">No events found.</td></tr>';
        
          } 

          // Close the database connection
          //
          
          ?>
        </tbody>
      </table>
    </div>
  </div>
</main>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $eventName = $_POST['event-name'];
    $eventDate = $_POST['event-date'];
    $eventLocation = $_POST['event-location'];

    // Perform the database insert
    $sql = "INSERT INTO events (event_title, event_date, event_description) VALUES ('$eventName', '$eventDate', '$eventLocation')";

    // Execute the SQL statement
    if ($mysqli->query($sql) === TRUE) {
     
        echo '<script>alert("Event added successfully!");</script>';
      
      } else {
        echo '<script>alert("Error: ' . $sql . '\\n' . $mysqli->error . '");</script>';
    }
}
$mysqli->close();
?>

<form id="event-form" class="event-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h2>Add Event</h2>
    <label for="event-name">Event Name</label>
    <input type="text" id="event-name" name="event-name" required>
    <label for="event-date">Event Date</label>
    <input type="date" id="event-date" name="event-date" required>
    <label for="event-location">Event Location</label>
    <textarea id="event-location" name="event-location" required></textarea>
    <input type="submit" value="Add">
</form>

<script>
  // Show the add event form when the button is clicked
  const addEventButton = document.querySelector('.add-event');
  const eventForm = document.getElementById('event-form');
  const closeIcon = document.querySelector('.close-icon');

  addEventButton.addEventListener('click', () => {
    eventForm.classList.add('show');
  });

  closeIcon.addEventListener('click', () => {
    eventForm.classList.remove('show');
  });
</script>
</body>
</html>