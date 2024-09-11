<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $productId = isset($_POST['product_id']) ? $_POST['product_id'] : '';

    if ($action == 'remove' && !empty($productId)) {
        if (isset($_SESSION['cart'][$productId])) {
            // Remove the product from the cart
            unset($_SESSION['cart'][$productId]);

            // Recalculate the total price
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $stmt = $conn->prepare("SELECT price FROM products_table WHERE id = ?");
                $stmt->bind_param('i', $productId);
                $stmt->execute();
                $result = $stmt->get_result();
                $product = $result->fetch_assoc();
                $price = $product['price'];
                $totalPrice += $price * $quantity;
            }

            echo json_encode(['success' => true, 'newTotal' => number_format($totalPrice, 2)]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Product not found in cart']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
