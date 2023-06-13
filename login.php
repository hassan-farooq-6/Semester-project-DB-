<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
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
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      margin-top: 100px;
      border: 1px solid #ddd;
      border-radius: 5px;
      background-color: rgba(255, 255, 255, 0.8);
    }

    .container h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .container table {
      width: 100%;
      margin-bottom: 20px;
    }

    .container table th {
      background-color: #f2f2f2;
      padding: 10px;
      text-align: left;
    }

    .container table td {
      padding: 10px;
    }

    .container form .form-group {
      margin-bottom: 20px;
    }

    .container form .btn-primary {
      width: 100%;
      background-color: #777;
      border-color: #777;
    }
    
    .btn-container {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }
    
    .btn-card {
      display: flex;
      align-items: center;
      background-color: #f2f2f2;
      padding: 10px;
      border-radius: 5px;
    }
    
    .btn-card .btn-icon {
      margin-right: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Login</h1>
    <?php
    session_start(); // Start a session to store user login information

    // Database connection and query
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "food management system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Prepare and execute the login query
      $stmt = $conn->prepare("SELECT * FROM person WHERE Password = ?");
      $stmt->bind_param("s", $password);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows === 1) { // If the user is found in the person table
        $row = $result->fetch_assoc();
        $personId = $row['id'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];

        $_SESSION['email'] = $email;
        $_SESSION['personId'] = $personId;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        

        echo "<div class='table-responsive'>
          <table class='table table-bordered'>
            <tr>
              <th>Email</th>
              <th>Person ID</th>
              <th>First Name</th>
              <th>Last Name</th>
            </tr>
            <tr>
              <td>$email</td>
              <td>$personId</td>
              <td>$firstName</td>
              <td>$lastName</td>
            </tr>
          </table>
        </div>";

        echo "
        <div class='btn-container'>
            <div class='btn-card'>
                <span class='btn-icon'>&#9776;</span>
                <a href='http://localhost/php_workspace/restaurant.html'>Restaurant Registration</a>
            </div>
            <div class='btn-card'>
                <span class='btn-icon'>&#127828;</span>
                <a href='http://localhost/php_workspace/register_food_item.html'>Food Item Registration</a>
            </div>
            <div class='btn-card'>
                <span class='btn-icon'>&#127828;</span>
                <a href='http://localhost/php_workspace/order_food.php'>Order Food</a>
            </div>
            <div class='btn-card'>
                <span class='btn-icon'>&#10004;</span>
                <a href='http://localhost/php_workspace/confirm_order.php'>Confirm Order</a>
            </div>
        </div>";

        exit();
      } else {
        echo "<div class='alert alert-danger'>Invalid credentials. Please try again.</div>";
      }
    }

    $conn->close();
    ?>
    

    <form method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>


  </div>
</body>

</html>
