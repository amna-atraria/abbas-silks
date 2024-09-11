<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="email"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 16px;
            width: 100%;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            color: #d9534f;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update User</h1>
        <?php
       include("connection.php");
            $message = '';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $user_id = intval($_POST['user_id']);
            $username = $conn->real_escape_string($_POST['username']);
            $email = $conn->real_escape_string($_POST['email']);
            $first_name = $conn->real_escape_string($_POST['first_name']);
            $last_name = $conn->real_escape_string($_POST['last_name']);
            $address = $conn->real_escape_string($_POST['address']);
            $phone_number = $conn->real_escape_string($_POST['phone_number']);

    
            $sql = "UPDATE user_table SET username = ?, email = ?, first_name = ?, last_name = ?, address = ?, phone_number = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $username, $email, $first_name, $last_name, $address, $phone_number, $user_id);

            if ($stmt->execute()) {
    
                header("Location:view_users.php");
            } else {
                $message = "<p class='message'>Error updating user: " . $conn->error . "</p>";
            }

            $stmt->close();
        }

    
        if (!isset($_POST['user_id']) && isset($_GET['id'])) {
            $user_id = intval($_GET['id']);

    
            $sql = "SELECT * FROM user_table WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                ?>
                <form action="update_user.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">
                    
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                    
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                    
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                    
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
                    
                    <button type="submit">Update User</button>
                </form>
                <?php
            } else {
                $message = "<p class='message'>User not found.</p>";
            }

            $stmt->close();
        } elseif (isset($_POST['user_id'])) {
                echo $message;
        } else {
            echo "<p class='message'>No user ID provided.</p>";
        }

            $conn->close();
        ?>
    </div>
</body>
</html>
