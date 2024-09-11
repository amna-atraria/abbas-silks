<?php
include("connection.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM cart_table  WHERE cart_id = '$id'";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: view_cart.php");
    }
    ?>


