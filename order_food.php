<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Food</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('preparing-raw-barbeque-chicken-cooking.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
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
            padding: 10px;
            text-align: center;
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
        }

        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="number"] {
            width: 80px;
        }

        .btn-order {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Order Food</h1>
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

            // Fetch food items from the database
            $stmt = $pdo->prepare("SELECT * FROM food_item");
            $stmt->execute();
            $foodItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if the form is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve the form data
                $foodItemIds = $_POST['foodItemIds'];
                $quantities = $_POST['quantities'];

                // Set the buyer_id
                $buyerId = 11;

                // Get the current date and time
                $orderDate = date("Y-m-d");
                $orderTime = date("H:i:s");

                // Initialize the order total
                $orderTotal = 0;

                // Prepare an insert statement for the orders
                $orderSql = "INSERT INTO orders (buyer_id, seller_id, restaurant_id, order_date, order_time, order_total) 
                            VALUES (:buyerId, :sellerId, :restaurantId, :orderDate, :orderTime, :orderTotal)";

                // Prepare the SQL statement
                $orderStmt = $pdo->prepare($orderSql);

                // Begin the transaction
                $pdo->beginTransaction();

                foreach ($foodItemIds as $index => $foodItemId) {
                    $quantity = $quantities[$index];

                    // Fetch the food item details from the database
                    $foodItemSql = "SELECT f.*, fi.seller_id, fi.restaurant_id 
                                    FROM fooditem AS f
                                    INNER JOIN fooditems AS fi ON f.id = fi.food_item_id
                                    WHERE f.id = :foodItemId";
                    $foodItemStmt = $pdo->prepare($foodItemSql);
                    $foodItemStmt->bindParam(':foodItemId', $foodItemId, PDO::PARAM_INT);
                    $foodItemStmt->execute();
                    $foodItem = $foodItemStmt->fetch(PDO::FETCH_ASSOC);

                    // Calculate the total cost of the food item

                    // Add the item total to the order total
                    $orderTotal += $itemTotal;

                   
                    // Execute the prepared statement
                    $orderStmt->execute();
                }

                // Commit the transaction
                $pdo->commit();

                // Display the order total
                echo "<p class='text-success'>Order Total: $<span id='orderTotal'>" . $orderTotal . "</span></p>";
            }
        } catch (PDOException $e) {
            // Rollback the transaction in case of an error
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
        ?>
        <form method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Food Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($foodItems as $foodItem) : ?>
                        <tr>
                            <td><?php echo $foodItem['food_item_name']; ?></td>
                            <td><?php echo $foodItem['food_item_price']; ?></td>
                            <td>
                                <input type="hidden" name="foodItemIds[]" value="<?php echo $foodItem['id']; ?>">
                                <input type="number" name="quantities[]" min="0" value="0">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="form-group">
    <a href="http://localhost/php_workspace/confirm_order.php" class="btn btn-primary btn-order">Place Order</a>
</div>

        </form>
    </div>
</body>

</html>
