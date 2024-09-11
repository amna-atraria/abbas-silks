<?php
include("connection.php");

$product_id = $_POST['product_id'];

$sql = "SELECT name AS product_name, price FROM products_table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

echo json_encode($product);
?>
