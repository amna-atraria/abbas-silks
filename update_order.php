<?php
include("connection.php");
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
if (!empty($order_id)) {
    $sql = "SELECT * FROM orders_table WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    $stmt->close();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $user_id = $_POST['user_id'];
    $order_date = $_POST['order_date'];
    $total_amount = $_POST['total_amount'];
    $shipping_address = $_POST['shipping_address'];
    $billing_address = $_POST['billing_address'];

    $sql = "UPDATE orders_table SET user_id = ?, order_date = ?, total_amount = ?, shipping_address = ?, billing_address = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $user_id, $order_date, $total_amount, $shipping_address, $billing_address, $order_id);

    if ($stmt->execute()) {
        header("Location: view_orders.php?message=Order updated successfully");
        exit();
    } else {
        echo "Error updating order: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 80%;
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            color: #555;
        }
        input, textarea {
            margin-bottom: 15px;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }
        textarea {
            resize: vertical;
            min-height: 120px;
        }
        .btn {
            padding: 12px 20px;
            color: #fff;
            background-color: #4caf50;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .error {
            color: #e53935;
            font-size: 16px;
            margin-top: 20px;
        }
        .success {
            color: #4caf50;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Order</h1>
        <?php if (!empty($order)): ?>
            <form action="update_order.php" method="post">
                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                <label for="user_id">User ID</label>
                <input type="text" name="user_id" id="user_id" value="<?php echo htmlspecialchars($order['user_id']); ?>" required>

                <label for="order_date">Order Date</label>
                <input type="text" name="order_date" id="order_date" value="<?php echo htmlspecialchars($order['order_date']); ?>" required>

                <label for="total_amount">Total Amount</label>
                <input type="text" name="total_amount" id="total_amount" value="<?php echo htmlspecialchars($order['total_amount']); ?>" required>

                <label for="shipping_address">Shipping Address</label>
                <textarea name="shipping_address" id="shipping_address" required><?php echo htmlspecialchars($order['shipping_address']); ?></textarea>

                <label for="billing_address">Billing Address</label>
                <textarea name="billing_address" id="billing_address" required><?php echo htmlspecialchars($order['billing_address']); ?></textarea>

                <button type="submit" class="btn">Update Order</button>
            </form>
        <?php else: ?>
            
            <p class="error">Order not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
