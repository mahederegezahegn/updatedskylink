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
    input[type="file"],
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


include_once('header.php');
include_once('dbcon.php');
echo '<div class="flex">';
include_once('side.php');
?>

<main class="flex w-full">
  <div class="bods bg-gray-100 p-4">

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
    
      <button class="add-event">
        <i class="fas fa-plus"></i> Add Event
      </button>
      <table class="divide-y divide-gray-200">
        <thead>
          <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Type</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Date</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event description</th>
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
                echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['event_type'] . '</td>';
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
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $eventType = $_POST['event-type'];
    $eventName = $_POST['event-name'];
    $eventDate = $_POST['event-date'];
    $eventLocation = $_POST['event-location'];

    // File upload handling
    $targetDirectory = "uploads/"; // Specify the directory where you want to store the uploaded images
    $targetFile = $targetDirectory . basename($_FILES['event-image']['name']); // Get the file name with the directory path
    $uploadOk = 1; // Flag to check if the file upload was successful
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // Get the file extension

    // Check if the file is an actual image
    $check = getimagesize($_FILES['event-image']['tmp_name']);
    if ($check === false) {
        echo '<script>alert("Error: File is not an image.");</script>';
        $uploadOk = 0;
    }

    // Check file size (optional)
    if ($_FILES['event-image']['size'] > 500000) {
        echo '<script>alert("Error: File size exceeds the limit.");</script>';
        $uploadOk = 0;
    }

    // Allow only specific file formats (e.g., jpg, png)
    $allowedFormats = array('jpg', 'jpeg', 'png');
    if (!in_array($imageFileType, $allowedFormats)) {
        echo '<script>alert("Error: Only JPG, JPEG, and PNG files are allowed.");</script>';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script>alert("Error: File upload failed.");</script>';
    } else {
        // If everything is ok, move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['event-image']['tmp_name'], $targetFile)) {
            // File upload successful, proceed to insert file path into the database

       

            // Prepare the SQL statement
            $sql = "INSERT INTO events (event_type, event_title, event_date, event_description, event_image) 
                    VALUES ('$eventType', '$eventName', '$eventDate', '$eventLocation', '$targetFile')";

            // Execute the SQL statement
            if ($mysqli->query($sql) === TRUE) {
                echo '<script>alert("Event added successfully!");</script>';
            } else {
                echo '<script>alert("Error: ' . $sql . '\\n' . $mysqli->error . '");</script>';
            }

            // Close the database connection
            $mysqli->close();
        } else {
            echo '<script>alert("Error: File upload failed.");</script>';
        }
    }
}
?>


<form id="event-form" class="event-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  <button id="close-button" class="close-icon btn-secondary">Close</button>

  <h2>Add Event</h2>
  <label for="event-type">Event Type</label>
  <select id="event-type" name="event-type" required>
    <!-- <option value="" selected disabled>Select an option</option> -->
    <option value="event">Event</option>
    <option value="news">News</option>
    <option value="breaking-news">Breaking News</option>
  </select>
  <label for="event-date">Event Date</label>
  <input type="date" id="event-date" name="event-date" required>
  <label for="event-name">Event Name</label>
  <input type="text" id="event-name" name="event-name" required>
  <label for="event-location">Event Location</label>
  <textarea id="event-location" name="event-location" required></textarea>
  <label for="event-image">Event Image</label>
  <input type="file" id="event-image" name="event-image" accept="image/*" required>
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