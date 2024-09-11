<?php

include("connection.php");

$sql = "SELECT * FROM orders_table"; 
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4a261;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .no-results {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #555;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons form {
            display: inline;
        }
        .btn {
            padding: 8px 12px;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-update {
            background-color: #4caf50;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .btn-update:hover {
            background-color: #45a049;
        }
        .btn-delete:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Orders List</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Shipping Address</th>
                        <th>Billing Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["order_id"]); ?></td>
                            <td><?php echo htmlspecialchars($row["user_id"]); ?></td>
                            <td><?php echo htmlspecialchars($row["order_date"]); ?></td>
                            <td><?php echo htmlspecialchars($row["total_amount"]); ?></td>
                            <td><?php echo htmlspecialchars($row["shipping_address"]); ?></td>
                            <td><?php echo htmlspecialchars($row["billing_address"]); ?></td>
                            <td class="action-buttons">
                               
                                <form action="update_order.php" method="get">
                                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($row['order_id']); ?>">
                                    <button type="submit" class="btn btn-update">Update</button>
                                </form>
                               
                                <form action="delet_orders.php" method="post" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($row['order_id']); ?>">
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-results">0 results</div>
        <?php endif; ?>
    </div>
    <?php $conn->close(); ?>
</body>
</html>
