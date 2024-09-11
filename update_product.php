<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        .form-container input[type="text"], 
        .form-container input[type="file"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-container .image-preview {
            margin-bottom: 12px;
        }
        .form-container .image-preview img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Update Product</h1>
        <?php
        include("connection.php");

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM products_table WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $product = $stmt->get_result()->fetch_assoc();
            $stmt->close();
        }
        ?>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="<?php echo isset($product['id']) ? $product['id'] : ''; ?>">

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo isset($product['product_name']) ? htmlspecialchars($product['product_name']) : ''; ?>" required>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?php echo isset($product['description']) ? htmlspecialchars($product['description']) : ''; ?>" required>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo isset($product['price']) ? htmlspecialchars($product['price']) : ''; ?>" required>

            <label for="stock_quantity">Stock Quantity:</label>
            <input type="text" id="stock_quantity" name="stock_quantity" value="<?php echo isset($product['stock_quantity']) ? htmlspecialchars($product['stock_quantity']) : ''; ?>" required>

            <label for="image_url">Image URL:</label>
            <input type="file" id="image_url" name="image_url">

            <?php if (isset($product['image_url']) && !empty($product['image_url'])): ?>
                <div class="image-preview">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="Product Image">
                </div>
            <?php endif; ?>

            <input type="submit" value="Update Product">
        </form>
    </div>
</body>
</html>








<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];


    $image_url = "";
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $upload_dir = 'uploads/'; 
        $tmp_name = $_FILES['image_url']['tmp_name'];
        $file_name = basename($_FILES['image_url']['name']);
        $file_path = $upload_dir . $file_name;

    
        if (move_uploaded_file($tmp_name, $file_path)) {
            $image_url = $file_path;
        } else {
            echo "Failed to upload image.";
            exit();
        }
    } else {
    
        $sql = "SELECT image_url FROM products_table WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $image_url = $result['image_url'];
        $stmt->close();
    }

        if (empty($id) || empty($product_name) || empty($description) || empty($price) || empty($stock_quantity)) {
        echo "Please fill in all fields.";
        exit();
    }
    $sql = "UPDATE products_table SET product_name = ?, description = ?, price = ?, stock_quantity = ?, image_url = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $product_name, $description, $price, $stock_quantity, $image_url, $id);

    if ($stmt->execute()) {
        // echo "Product updated successfully!";
        header("Location: all_product.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
