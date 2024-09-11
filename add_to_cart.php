<?php
session_start();
include("connection.php");

$response = array('status' => 'error');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($userId > 0 && $productId > 0 && $quantity > 0) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Add or update cart item
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }

        $response['status'] = 'success';
    } else {
        $response['message'] = 'Invalid input';
    }
} else {
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
?>
