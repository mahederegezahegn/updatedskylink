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
    $method = 'international';
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

    $stmt->bind_param("sssssssssssssssssss",
        $companyName, $displayName, $section, $mobilePhone, $officePhone, $fax, $pobox, $email, $contactPerson, $alternativePerson, $payment, $zone, $website, $boothNumber, $boothNumber2, $boothNumber3, $Totalsq, $approve, $method);

    if ($stmt->execute()) {
        echo "Insertion successful!";
    } else {
        echo "Error in executing the statement: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();

    // Redirect to a success page
    header("Location: attend.html");
    exit();
}
?>