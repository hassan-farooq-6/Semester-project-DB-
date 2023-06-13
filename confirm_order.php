<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed Successfully</title>
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
            max-width: 400px;
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

        .btn-confirm-order {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Order Placed Successfully</h1>
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

            // Fetch the order details from the database
            $stmt = $pdo->prepare("SELECT o.order_total, f.food_item_name
                                   FROM orders AS o
                                   INNER JOIN food_item AS f ON o.id = f.id
                                   WHERE o.buyer_id = :buyerId");
            $stmt->bindParam(':buyerId', $buyerId, PDO::PARAM_INT);
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display the order details in a table
            echo "<table>
                    <thead>
                        <tr>
                            <th>Food Item</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($orders as $order) {
                echo "<tr>
                        <td>{$order['food_item_name']}</td>
                        <td>{$order['order_total']}</td>
                    </tr>";
            }
            echo "</tbody></table>";

            // Display a confirmation message
            echo "<p class='text-success'>Order placed successfully!</p>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
        <a href="order_food.php" class="btn btn-primary btn-confirm-order">Place Another Order</a>
    </div>
</body>

</html>
