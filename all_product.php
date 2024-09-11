<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .dropdown {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 150px;
        }
        .dropdown-menu a {
            display: block;
            padding: 8px;
            text-decoration: none;
            color: #333;
        }
        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
        .dropdown-button {
            padding: 8px 16px;
            font-size: 14px;
            color: #fff;
            background: blue;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left:1000px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            padding: 8px;
            background-color: #fff;
            width: 100%; /* Full width */
            max-width: 100vw; /* Full viewport width */
            display: flex;
            align-items: center;
            box-sizing: border-box;
            min-height: 80px; /* Minimum height for compactness */
            font-size: 14px;
        }
        .card-img-top {
            width: 60px;
            height: 60px;
            object-fit: cover;
            margin-right: 10px;
        }
        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-body h5 {
            margin: 0;
            font-size: 16px;
        }
        .card-body p {
            margin: 3px 0;
        }
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
        }
        .card-footer .info {
            display: flex;
            flex: 1;
            justify-content: space-between;
        }
        .btn-group {
            display: flex;
            gap: 5px; /* Space between buttons */
        }
        .btn {
            padding: 4px 8px;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-size: 12px;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .hide-comment {
            background-color: #dc3545;
            border: none;
            color: #fff;
            padding: 4px 8px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }
        .text-center {
            text-align: center;
            margin: 0 0 20px 0;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="dropdown">
            <button onclick="toggleDropdown()" class="dropdown-button">Menu</button>
            <div id="dropdown-menu" class="dropdown-menu">
                <a href="add_product.php">Add Product</a>
                <a href="comment.php">Show Comments</a>
            </div>
        </div>
        
        <h1 class="text-center">Product List</h1>
        <div class="content">
            <?php
            include("connection.php");

            if (isset($_GET['show_comments'])) {
                // Show Comments
                $sql = "SELECT * FROM user_reviews WHERE status ='hide review'"; // Fetch only non-hidden comments
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<p class="card-text"><strong>' . htmlspecialchars($row['name']) . ':</strong> ' . htmlspecialchars($row['review']) . '</p>';
                        echo '<button class="hide-comment" data-id="' . $row['id'] . '">Hide</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-center">No comments found.</p>';
                }
            } else {
                // Show Products
                $sql = "SELECT * FROM products_table";
                $result = $conn->query($sql);
                $count = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card">';
                        echo '<img src="' . htmlspecialchars($row['image_url']) . '" class="card-img-top" alt="Product Image">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($row['product_name']) . '</h5>';
                        echo '<div class="card-footer">';
                        echo '<div class="info">';
                        echo '<p class="card-text"><strong>Price:</strong> $' . htmlspecialchars($row['price']) . '</p>';
                        echo '<p class="card-text"><strong>Stock:</strong> ' . htmlspecialchars($row['stock_quantity']) . '</p>';
                        echo '</div>';
                        echo '<div class="btn-group">';
                        echo '<a href="update_product.php?id=' . $row['id'] . '" class="btn btn-primary">Update</a>';
                        echo '<a href="delete_product.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-center">No products found.</p>';
                }
            }

            $conn->close();
            ?>
        </div> 
    </div>

    <script>
        function toggleDropdown() {
            var menu = document.getElementById('dropdown-menu');
            menu.style.display = (menu.style.display === 'block' ? 'none' : 'block');
        }
    </script>
</body>
</html>
