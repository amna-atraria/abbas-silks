<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #333333, #000000); /* Black gradient background */
            color: #f5f5f5; /* Light text color for contrast */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            color: #ffd700; /* Golden color for the heading */
            margin-bottom: 30px;
            font-size: 2.5em;
            font-family: 'Montserrat', sans-serif;
        }
        .form-container {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            padding: 30px;
            background: #222; /* Dark background for the form container */
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4); /* Deeper shadow for modern look */
            overflow: hidden;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-size: 1.1em;
            color: #f5f5f5; /* Light text color for labels */
        }
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="file"] {
            width: calc(100% - 20px);
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #444; /* Dark border color */
            border-radius: 8px;
            background: #333; /* Dark background for inputs */
            color: #f5f5f5; /* Light text color for inputs */
            font-size: 1em;
            transition: all 0.3s ease;
        }
        .form-container input[type="text"]:focus,
        .form-container input[type="number"]:focus {
            border-color: #ffd700; /* Border color change on focus */
            background: #444; /* Slightly lighter dark background on focus */
            outline: none;
        }
        .form-container input[type="submit"] {
            background-color: #ffd700; /* Golden color for the submit button */
            color: #333; /* Dark text color */
            border: none;
            cursor: pointer;
            padding: 12px;
            border-radius: 8px;
            font-size: 1.1em;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }
        .form-container input[type="submit"]:hover {
            background-color: #e5c100; /* Slightly darker golden color on hover */
            transform: scale(1.05); /* Slight scale effect on hover */
        }
        .form-container input[type="file"]::-webkit-file-upload-button {
            background-color: #ffd700; /* Golden color for file input button */
            color: #333; /* Dark text color */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            padding: 12px;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }
        .form-container input[type="file"]::-webkit-file-upload-button:hover {
            background-color: #e5c100; /* Slightly darker golden color on hover */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add Product</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="stock_quantity">Stock Quantity:</label>
            <input type="number" id="stock_quantity" name="stock_quantity" required>

            <label for="image_url">Image:</label>
            <input type="file" id="image_url" name="image_url" required>

            <input type="submit" value="Add Product">
        </form>
    </div>
</body>
</html>
<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];

    
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $file = $_FILES['image_url'];
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        $upload_dir = 'uploads/';  // Directory where the file will be stored

        

    
        $file_name = uniqid() . '-' . basename($file['name']);
        $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($file['tmp_name'], $file_path)) {
    
            $sql = "INSERT INTO products_table (product_name, description, price, stock_quantity, image_url) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $product_name, $description, $price, $stock_quantity, $file_path);

            if ($stmt->execute()) {
    
                header("Location: all_product.php ");
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "No file uploaded or there was an error.";
    }

    $conn->close();
}
?>
