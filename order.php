<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now</title>
    <style>
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
        }
        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        h1 {
            text-align: center;
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 200px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Order Now</h1>
    <div class="form-container">
        <form method="post" action="">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required>

            <label for="order_date">Order Date:</label>
            <input type="text" id="order_date" name="order_date" required>

            <label for="total_amount">Total Amount:</label>
            <input type="text" id="total_amount" name="total_amount" required>

            <label for="shipping_address">Shipping Address:</label>
            <input type="text" id="shipping_address" name="shipping_address" required>

            <label for="billing_address">Billing Address:</label>
            <input type="text" id="billing_address" name="billing_address" required>

            <input type="submit" name="submit" value="Add Order">
        </form>
    </div>

    <?php
    include("connection.php");

    if (isset($_POST['submit'])) {
        $user_id = $_POST['user_id'];
        $order_date = $_POST['order_date'];
        $total_amount = $_POST['total_amount'];
        $shipping_address = $_POST['shipping_address'];
        $billing_address = $_POST['billing_address'];

        if (empty($user_id) || empty($order_date) || empty($total_amount) || empty($shipping_address) || empty($billing_address)) {
            echo "Please fill in all fields.";
            exit();
        }

        $sql = "INSERT INTO orders_table (user_id, order_date, total_amount, shipping_address, billing_address) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $user_id, $order_date, $total_amount, $shipping_address, $billing_address);

        if ($stmt->execute()) {
            echo "Order added successfully!";
            header("Location:view_orders.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
