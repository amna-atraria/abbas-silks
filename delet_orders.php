<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "office_data"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$order_id = isset($_POST['order_id']) ? trim($_POST['order_id']) : '';
if (empty($order_id)) {
    echo "Order ID not provided.";
    exit();
}
$sql = "DELETE FROM orders_table WHERE order_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Failed to prepare the SQL statement: " . $conn->error);
}


$stmt->bind_param("i", $order_id);
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {

        echo "Order deleted successfully!";
    } else {

        echo "No order found with ID: " . htmlspecialchars($order_id);
    }
} else {

    echo "Error deleting order: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
