<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
   include_once('dbcon.php');
        

    $stmt = $mysqli->prepare("INSERT INTO exhibitors (company_name, display_name, section, mobile_Phone, office_Phone, fax, pobox, email, contact_Person, alternative_Person, payment, zone, website, booth_option1, booth_option2, booth_option3, total_sqm, approve, method) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

    if (!$stmt) {
        die("Error in preparing the statement: " . $mysqli->error);
    }
    // Set the values for the parameters
    $method = 'local';
    $companyName = $_POST['companyName'];
    $displayName = $_POST['displayName'];
    $section = $_POST['section'];
    $mobilePhone = $_POST['mobilePhone'];
    $officePhone = $_POST['officePhone'];
    $fax = $_POST['fax'];
    $pobox = $_POST['pobox'];
    $email = $_POST['email'];
    $contactPerson = $_POST['contactPerson'];
    $alternativePerson = $_POST['alternativePerson'];
    $payment = $_POST['payment'];
    $zone = $_POST['zone'];
    $website = $_POST['website'];
    $boothNumber = $_POST['boothNumber'];
    $boothNumber2 = $_POST['boothNumber2'];
    $boothNumber3 = $_POST['boothNumber3'];
    $Totalsq = $_POST['Totalsq'];
    $approve = 0; // Assuming you want to set the 'approve' column to 0

 
    // Check if the company name already exists
    $existingCompanyQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE company_name = ?');
    $existingCompanyQuery->bind_param('s', $companyName);
    $existingCompanyQuery->execute();
    $existingCompanyQuery->store_result();
    $existingCompanyCount = $existingCompanyQuery->num_rows;
    $existingCompanyQuery->close();
    
    // Check if the display name already exists
    $existingDisplayQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE display_name = ?');
    $existingDisplayQuery->bind_param('s', $displayName);
    $existingDisplayQuery->execute();
    $existingDisplayQuery->store_result();
    $existingDisplayCount = $existingDisplayQuery->num_rows;
    $existingDisplayQuery->close();
    
    // Check if the mobile phone already exists
    $existingMobileQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE mobile_Phone = ?');
    $existingMobileQuery->bind_param('s', $mobilePhone);
    $existingMobileQuery->execute();
    $existingMobileQuery->store_result();
    $existingMobileCount = $existingMobileQuery->num_rows;
    $existingMobileQuery->close();
    
    // Check if the office phone already exists
    $existingOfficeQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE office_Phone = ?');
    $existingOfficeQuery->bind_param('s', $officePhone);
    $existingOfficeQuery->execute();
    $existingOfficeQuery->store_result();
    $existingOfficeCount = $existingOfficeQuery->num_rows;
    $existingOfficeQuery->close();
    
    // Check if the fax already exists
    $existingFaxQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE fax = ?');
    $existingFaxQuery->bind_param('s', $fax);
    $existingFaxQuery->execute();
    $existingFaxQuery->store_result();
    $existingFaxCount = $existingFaxQuery->num_rows;
    $existingFaxQuery->close();
    
    // Check if the PO Box already exists
    $existingPOBoxQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE pobox = ?');
    $existingPOBoxQuery->bind_param('s', $pobox);
    $existingPOBoxQuery->execute();
    $existingPOBoxQuery->store_result();
    $existingPOBoxCount = $existingPOBoxQuery->num_rows;
    $existingPOBoxQuery->close();
    
    // Check if the website already exists
    $existingWebsiteQuery = $mysqli->prepare('SELECT id FROM exhibitors WHERE website = ?');
    $existingWebsiteQuery->bind_param('s', $website);
    $existingWebsiteQuery->execute();
    $existingWebsiteQuery->store_result();
    $existingWebsiteCount = $existingWebsiteQuery->num_rows;
    $existingWebsiteQuery->close();
        if ($existingCompanyCount > 0) {
            echo "<script>alert('Company name is already registered. Please choose a different name.');</script>";
                header('location:exhibitor.html');
            header('location:exhibitor.html');
        } elseif ($existingDisplayCount > 0) {
            echo "<script>alert('Display name is already registered. Please choose a different name.');</script>";
                header('location:exhibitor.html');
        } elseif ($existingMobileCount > 0) {
            echo "<script>alert('Mobile phone number is already registered. Please enter a different number.');</script>";
                header('location:exhibitor.html');
        } elseif ($existingOfficeCount > 0) {
            echo "<script>alert('Office phone number is already registered. Please enter a different number.');</script>";
                header('location:exhibitor.html');
        } elseif ($existingFaxCount > 0) {
            echo "<script>alert('Fax number is already registered. Please enter a different number.');</script>";
                header('location:exhibitor.html');
        } elseif ($existingPOBoxCount > 0) {
            echo "<script>alert('PO Box number is already registered. Please enter a different number.');</script>";
                header('location:exhibitor.html');
        } elseif ($existingWebsiteCount > 0) {
            echo "<script>alert('Website is already registered. Please enter a different website URL.');</script>";
                header('location:exhibitor.html');
        } else {
            // Insert the data into the database
           $stmt->bind_param("sssssssssssssssssss",
            $companyName, $displayName, $section, $mobilePhone, $officePhone, $fax, $pobox, $email, $contactPerson, $alternativePerson, $payment, $zone, $website, $boothNumber, $boothNumber2, $boothNumber3, $Totalsq, $approve, $method);
        $stmt->execute();
            $stmt->close();
    
            // Display success message
            echo "<script>alert('Data inserted successfully.');</script>";
            header('location:exhibitors.html');
        }
    }
    ?>