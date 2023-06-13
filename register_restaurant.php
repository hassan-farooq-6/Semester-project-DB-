<?php
// Retrieve form data
$restaurantName = $_POST['name'];
$phoneNumber = $_POST['phoneNumber'];
$address = $_POST['address'];
$road = $_POST['road'];
$city = $_POST['city'];
$zipCode = $_POST['zipCode'];
$country = $_POST['country'];

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

// Prepare and bind the statement for inserting into the Address table
$stmt = $conn->prepare("INSERT INTO Address (address, road, city, zip_code, country) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $address, $road, $city, $zipCode, $country);

// Execute the statement for inserting into the Address table
$stmt->execute();

// Get the generated address ID
$addressId = $conn->insert_id;

// Insert into the Restaurant table (assuming seller_id exists in the seller table)
$sellerId = 5; // Replace with the actual seller_id value
$stmt = $conn->prepare("INSERT INTO Restaurant (restaurant_name, restaurant_phone_number, address_id, seller_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $restaurantName, $phoneNumber, $addressId, $sellerId);

// Execute the statement for inserting into the Restaurant table
$stmt->execute();

$stmt->close();
$conn->close();

// Assuming the registration is successful
$registrationSuccessful = true;

if ($registrationSuccessful) {
    header("Location: http://localhost/php_workspace/register_food_item.html");
    exit();
} else {
    echo "Restaurant registration failed.";
}
?>
