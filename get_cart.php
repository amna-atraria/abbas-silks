<?php
session_start();
include("connection.php");

$response = array('cartItems' => array(), 'cartTotal' => 0);

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
    $totalPrice = 0;

    foreach ($cartItems as $productId => $quantity) {
        // Fetch product details from the database
        $sql = "SELECT price FROM products_table WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if ($product) {
            $price = $product['price'];
            $totalPrice += $price * $quantity;
            $response['cartItems'][$productId] = array('quantity' => $quantity, 'price' => $price);
        }
    }

    $response['cartTotal'] = $totalPrice;
}

echo json_encode($response);
?>
