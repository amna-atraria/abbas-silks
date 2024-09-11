<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "office_data";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'], $_POST['password'])) {
        $user_username = $_POST['username'];
        $user_password = $_POST['password'];

       $stmt = $conn->prepare("SELECT password FROM user_table WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $user_username);


            $stmt->execute();
            $stmt->store_result();
            

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();
                

                if (password_verify($user_password, $hashed_password)) {
                    // echo "Login successful!";
                    header("Location: add_product.php");
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "Username does not exist.";
            }


            $stmt->close();
        } else {
            echo "Prepare failed: " . $conn->error;
        }
    } else {
        echo "Username and password are required.";
    }
} else {
    echo "Invalid request method.";
}
$conn->close();
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000000; /* Black background for the body */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #222; /* Dark background for the container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.3); /* Golden shadow */
            width: 100%;
            max-width: 400px;
        }
        h1 {
            margin-bottom: 20px;
            color: #ffd700; /* Golden color for the heading */
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #ffd700; /* Golden color for labels */
        }
        input[type="text"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #444; /* Dark border color */
            border-radius: 4px;
            background: #333; /* Dark background for inputs */
            color: #fff; /* White text color */
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100px;
            padding: 10px;
            margin-top:20px;
            border: none;
            border-radius: 4px;
            background-color: #ffd700; /* Golden color for the submit button */
            color: #000; /* Black text color */
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #e5c100; /* Slightly darker golden color on hover */
        }
    </style>
</head> 
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
