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
        <div class=" bods bg-gray-100 p-4">
            <div class="bg-gray-100 p-4">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                  <h2 class="text-lg font-semibold text-gray-800 px-4 py-3">Unapproved Exhibitors</h2>
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                      <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Zone
                          </th>
                          <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Service
                          </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Company Name
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          phone number
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Actions
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    <div id="hiddenCard" style="display: none;" class="hidden-card">
  <button id="closeButton" class="close-button">&times;</button>
  <h3 id="cardTitle"></h3>
  <p id="cardContent"></p>
</div>

    <?php
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'mydatabase';
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Fetch exhibitors from the database
    $result = $conn->query("SELECT * FROM exhibitors");
  
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $zone = $row['zone'];
        $service = $row['section'];
        $companyName = $row['company_name'];
        $companyphone = $row['office_phone'];
        $exhibitorId = $row['id']; // Assuming you have an 'id' column in the exhibitors table
  
        // Generate the table rows dynamically
        echo '<tr>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="text-sm text-gray-900">' . $zone . '</div>';
        echo '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="text-sm text-gray-900">' . $service . '</div>';
        echo '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="text-sm text-gray-900">' . $companyName . '</div>';
        echo '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="text-sm text-gray-900">' . $companyphone . '</div>';
        echo '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="flex items-center gap-10">';
        echo '<a href="exibit_aprove.php?id=' . $exhibitorId . '" class="text-blue-500 hover:text-red-700">';
        echo '<i class="fas fa-check"> approve</i>';
        echo '</a>';
        echo '<button class="text-green-500"  class="view-button"' . $exhibitorId . '" hover:text-green-700 mr-2">';
        echo '<i class="fas fa-eye">view</i>';
        echo '</button>';
         echo '<a href="deleteexibit.php?id=' . $exhibitorId . '" class="text-red-500 hover:text-red-700">';
        echo '<i class="fas fa-envelope"> EMAIL</i>';
        echo '</a>';
        echo '<a href="deleteexibit.php?id=' . $exhibitorId . '" class="text-red-500 hover:text-red-700">';
        echo '<i class="fas fa-trash-alt"> delete</i>';
        echo '</a>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
      }
    } else {
      echo '<tr><td colspan="4">No exhibitors found.</td></tr>';
    }
    ?>
  </tbody>
                  </table>
                </div>
              
                <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-lg">
                  <h2 class="text-lg font-semibold text-gray-800 px-4 py-3">Competitors</h2>
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                      <tr>
                      <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Registor Name
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Company Name
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Email
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Phone Number
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Actions
                        </th>
                        
                      </tr>
                    </thead>
                    <tbody>
    <?php
    // Fetch exhibitors from the database
    $result = $conn->query("SELECT * FROM registor");
  
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $zone = $row['company_name'];
        $service = $row['email'];
        $companyName = $row['phone_number'];
        $exhibitorId = $row['id']; // Assuming you have an 'id' column in the exhibitors table
  
        // Generate the table rows dynamically
        echo '<tr>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="text-sm text-gray-900">' . $fname . ' ' . $lname . '</div>';
        echo '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="text-sm text-gray-900">' . $zone . '</div>';
        echo '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="text-sm text-gray-900">' . $service . '</div>';
        echo '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="text-sm text-gray-900">' . $companyName . '</div>';
        echo '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="flex items-center gap-10">';
        echo '<a href="registor_approve.php?id=' . $exhibitorId . '" class="text-blue-500 hover:text-red-700">';
        echo '<i class="fas fa-check">approve</i>';
        echo '</a>';
       
        echo '<a href="delete_comp.php?id=' . $exhibitorId . '" class="text-red-500 hover:text-red-700">';
        echo '<i class="fas fa-trash-alt"> delete</i>';
        echo '</a>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
      }
    } else {
      echo '<tr><td colspan="4">No exhibitors found.</td></tr>';
    }
    ?>
  </tbody>
                  </table>
                </div>
              </div>
   </div>
    </main>

  </body>
  <script>
  // Get the hidden card and its content elements
  const hiddenCard = document.getElementById('hiddenCard');
  const cardTitle = document.getElementById('cardTitle');
  const cardContent = document.getElementById('cardContent');
  const closeButton = document.getElementById('closeButton');
  const viewButton = document.getElementById('viewButton');

  // Function to show the hidden card
  function showCard() {
    hiddenCard.style.display = 'block';
  }

  // Function to close the hidden card
  function closeCard() {
    hiddenCard.style.display = 'none';
  }

  // Add event listener to the view button
  viewButton.addEventListener('click', () => {
    // Update the card content with the desired data
    cardTitle.textContent = 'Card Title';
    cardContent.textContent = 'Card Content';

    // Show the hidden card
    showCard();
  });

  // Add event listener to the close button
  closeButton.addEventListener('click', closeCard);
</script>
  </html>