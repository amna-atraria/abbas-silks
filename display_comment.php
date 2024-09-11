<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .message {
            font-size: 1.2em;
            color: #333;
        }
        .btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Reviews</h1>

        <?php
        // Database connection parameters
        $host = 'localhost';     // Database host
        $dbname = 'office_data'; // Database name
        $user = 'root';  // Database username
        $pass = '';  // Database password

        // Create a new mysqli instance
        $conn = new mysqli($host, $user, $pass, $dbname);

        // Check connection
        if ($conn->connect_error) {
            echo "<p class='message'>Connection failed: " . $conn->connect_error . "</p>";
            exit();
        }

        // Handle deletion request
        if (isset($_POST['delete'])) {
            $sql = "DELETE FROM user_reviews";
            if ($conn->query($sql) === TRUE) {
                echo "<p class='message'>All rows deleted successfully.</p>";
            } else {
                echo "<p class='message'>Error executing query: " . $conn->error . "</p>";
            }
        }

        // Fetch and display existing data
        $sql = "SELECT id, name, email, review, time FROM user_reviews";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Review</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['review']}</td>
                        <td>{$row['time']}</td>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='message'>No data found.</p>";
        }

        // Close the connection
        $conn->close();
        ?>

        <form method="post">
            <button type="submit" name="delete" class="btn">Delete All Data</button>
        </form>
    </div>
</body>
</html>
