<?php
include("connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cart_table WHERE cart_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['cart_id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE cart_table SET user_id = ?, product_id = ?, quantity = ? WHERE cart_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $user_id, $product_id, $quantity, $id);
    if ($stmt->execute()) {
        header('Location: view_cart.php');
        exit();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Cart Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Cart Item</h1>
        <form method="POST">
            <input type="hidden" name="cart_id" value="<?php echo htmlspecialchars($record['cart_id']); ?>">
            <label for="user_id">User ID</label>
            <input type="number" name="user_id" id="user_id" value="<?php echo htmlspecialchars($record['user_id']); ?>" required>
            <label for="product_id">Product ID</label>
            <input type="number" name="product_id" id="product_id" value="<?php echo htmlspecialchars($record['product_id']); ?>" required>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="<?php echo htmlspecialchars($record['quantity']); ?>" required>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
