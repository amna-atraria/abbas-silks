<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>
            
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>
            
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
            
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" required>
            
            <input type="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>


<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['address'], $_POST['phone_number'])) {

        $user_username = $_POST['username'];
        $user_password = $_POST['password'];
        $user_email = $_POST['email'];
        $user_first_name = $_POST['first_name'];
        $user_last_name = $_POST['last_name'];
        $user_address = $_POST['address'];
        $user_phone_number = $_POST['phone_number'];


        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);


        $stmt = $conn->prepare("INSERT INTO user_table (username, password, email, first_name, last_name, address, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssssss", $user_username, $hashed_password, $user_email, $user_first_name, $user_last_name, $user_address, $user_phone_number);


            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }


            $stmt->close();
        } else {
            echo "Prepare failed: " . $conn->error;
        }
    } else {
        echo "All form fields are required.";
    }
} else {
    echo "Invalid request method.";
}
$conn->close();
?>
