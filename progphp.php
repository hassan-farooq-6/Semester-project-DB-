<?php
// Retrieve form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$houseNumber = $_POST['houseNumber'];
$road = $_POST['road'];
$city = $_POST['city'];
$province = $_POST['province'];
$zipCode = $_POST['zipCode'];
$country = $_POST['country'];
$email = $_POST['email'];
$Password = $_POST['password'];
$userType = $_POST['userType'];

// Database connection and query
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "food management system";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the statement for checking if email exists
$stmt = $conn->prepare("SELECT email FROM Person WHERE email = ?");
$stmt->bind_param("s", $email);

// Execute the statement
$stmt->execute();

// Fetch the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email already exists, handle the situation accordingly
    echo "Email already exists. Please use a different email.";
} else {
    // Prepare and bind the statement for inserting into the Address table
    $stmt = $conn->prepare("INSERT INTO Address (address, house_number, road, city, province, zip_code, country) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $address, $houseNumber, $road, $city, $province, $zipCode, $country);

    // Execute the statement for inserting into the Address table
    $stmt->execute();

    // Get the generated address ID
    $addressId = $conn->insert_id;

    // Prepare and bind the statement for inserting into the Person table
    $stmt = $conn->prepare("INSERT INTO Person (firstName, lastName, email, contact,Password, address_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $firstName, $lastName, $email, $contact,$Password,  $addressId);

    // Execute the statement for inserting into the Person table
    $stmt->execute();

    // Get the generated person ID
    $personId = $conn->insert_id;

    // Check the user type and insert the data into the respective table
    if ($userType === 'buyer') {
        // Prepare and bind the statement for the Buyer table
        $stmt = $conn->prepare("INSERT INTO Buyer (person_id, food_interests) VALUES (?, ?)");
        $stmt->bind_param("is", $personId, $foodInterests);

        // Set a default value for food interests if not provided in the form
        $foodInterests = isset($_POST['foodInterests']) ? $_POST['foodInterests'] : 'N/A';

        // Execute the statement for the Buyer table
        $stmt->execute();
    } else if ($userType === 'seller') {
        // Prepare and bind the statement for the Seller table
        $stmt = $conn->prepare("INSERT INTO Seller (person_id, seller_job_name) VALUES (?, ?)");
        $stmt->bind_param("is", $personId, $sellerJobName);

        // Set a default value for seller job name if not provided in the form
        $sellerJobName = isset($_POST['sellerJobName']) ? $_POST['sellerJobName'] : 'N/A';

        // Execute the statement for the Seller table
        $stmt->execute();
    }

    // Registration successful, redirect to login page
    header("Location: http://localhost/php_workspace/login.html");
    exit();
}

$stmt->close();
$conn->close();
?>
