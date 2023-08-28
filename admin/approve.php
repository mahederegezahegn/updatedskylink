<?php
include_once('header.php');
// Check if the user name and password are not set in the session
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); // Redirect to login.php
    exit; // Terminate the current script
}

?>

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
include_once('dbcon.php');

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
                          Method
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
 
    // Fetch exhibitors from the database
    $result = $mysqli->query("SELECT * FROM exhibitors");
  
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $zone = $row['zone'];
        $service = $row['section'];
        $companyName = $row['company_name'];
        $userEmail=$row['email'];
        $companyphone = $row['office_phone'];
        $method = $row['method'];
        $exhibitorId = $row['id']; // Assuming you have an 'id' column in the exhibitors table
        $approve=$row['approve'];
        // Generate the table rows dynamically
        if($approve=='0'){
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
        echo '<div class="text-sm text-gray-900">' . $method . '</div>';
        echo '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">';
        echo '<div class="flex items-center gap-10">';
        echo '<a href="exibit_aprove.php?id=' . $exhibitorId . '" class="text-blue-500 hover:text-red-700">';
        echo '<i class="fas fa-check"> </i>';
        echo '</a>';
        echo "<button class='email-button' data-email='$userEmail' onclick='openEmailForm(this)'>
        <i class='fas fa-envelope'></i></button>";
        echo '<a href="deleteexibit.php?id=' . $exhibitorId . '" class="text-red-500 hover:text-red-700">';
        echo '<i class="fas fa-trash-alt"> delete</i>';
        echo '</a>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
      }
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
    $result = $mysqli->query("SELECT * FROM registor");
  
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $zone = $row['company_name'];
        $service = $row['email'];
        $companyName = $row['phone_number'];
        $exhibitorId = $row['id']; // Assuming you have an 'id' column in the exhibitors table
  
        $verified=$row['verified'];
        // Generate the table rows dynamically
        if($verified=='verified'){
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
  <style>
        .email-form {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        width: 400px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .email-form h2 {
        text-align: center;
    }

    .email-form form {
        margin-top: 20px;
    }

    .email-form label {
        display: block;
        margin-bottom: 5px;
    }

    .email-form input[type="email"],
    .email-form input[type="text"],
    .email-form textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .email-form button[type="submit"] {
        background: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }

    .email-form button[type="submit"]:hover {
        background: #45a049;
    }
  </style>
  
  <script>
    function openEmailForm(button) {
        var email = button.getAttribute('data-email');

        var emailFormHTML = `
            <div class="email-form">
                <h2>Send Email</h2>
                <form action="mail.php" method="post">
                    <input type="email" name="to" value="${email}" required><br>
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" id="subject" required><br>
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" rows="5" required></textarea><br>
                    <button type="submit">Send</button>
                </form>
            </div>
        `;

        var emailFormContainer = document.createElement('div');
        emailFormContainer.innerHTML = emailFormHTML;

        document.body.appendChild(emailFormContainer);
    }
</script>
  </html>