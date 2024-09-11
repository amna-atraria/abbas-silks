<?php
include("connection.php");
$id = $_GET['id'];
$sql = "DELETE FROM `products_table` WHERE id = '$id'";
$result = $conn->query($sql);
if ($result) {
    header("Location: all_product.php");
}
?>


