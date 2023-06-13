<?php
// Assuming you have a database connection setup
// Replace your_database_name, your_username, your_password with actual values
$dsn = "mysql:host=localhost;dbname=food management system";
$username = "root";
$password = "";

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        
        $foodItemName = $_POST['foodItemName'];
        $foodItemPrice = $_POST['foodItemPrice'];
        $foodItemQuantity = $_POST['foodItemQuantity'];
        $foodItemDiscount = $_POST['foodItemDiscount'];

        
        $restaurantId = 2; 
        // Prepare the SQL statement
        $sql = "INSERT INTO food_item (restaurant_id, food_item_name, food_item_price, food_item_quantity, food_item_discount)
                VALUES (:restaurantId, :foodItemName, :foodItemPrice, :foodItemQuantity, :foodItemDiscount)";
        $stmt = $pdo->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':restaurantId', $restaurantId);
        $stmt->bindParam(':foodItemName', $foodItemName);
        $stmt->bindParam(':foodItemPrice', $foodItemPrice);
        $stmt->bindParam(':foodItemQuantity', $foodItemQuantity);
        $stmt->bindParam(':foodItemDiscount', $foodItemDiscount);

        // Execute the statement
        $stmt->execute();

        // Redirect to a success page or display a success message
        // header('Location: success.php');
        // exit();
    }

    // Retrieve all food items for the restaurant
    $sql = "SELECT * FROM food_item WHERE restaurant_id = :restaurantId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':restaurantId', $restaurantId);
    $stmt->execute();
    $foodItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Items</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead th {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
        }

        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Food Items</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Food Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($foodItems as $foodItem) : ?>
                    <tr>
                        <td><?php echo $foodItem['food_item_name']; ?></td>
                        <td><?php echo $foodItem['food_item_price']; ?></td>
                        <td><?php echo $foodItem['food_item_quantity']; ?></td>
                        <td><?php echo $foodItem['food_item_discount']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
