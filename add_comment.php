<?php
include("connection.php");

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $review = $conn->real_escape_string($_POST['review']);
    
    $sql = "INSERT INTO comments (name, email, review, time) VALUES ('$name', '$email', '$review', NOW())";
    
    if ($conn->query($sql) === TRUE) {
        echo "New comment added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch comments from the database
$sql = "SELECT * FROM user_reviews ORDER BY time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comment Section</title>
</head>
<body>
    <h1>Comment Section</h1>
    
    <!-- Comment Form -->
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="review">Review:</label><br>
        <textarea id="review" name="review" rows="5" cols="40" required></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
    
    <hr>
    
    <!-- Display Comments -->
    <h2>Comments:</h2>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<strong>" . htmlspecialchars($row['name']) . "</strong> (" . htmlspecialchars($row['email']) . ")<br>";
            echo "<p>" . htmlspecialchars($row['review']) . "</p>";
            echo "<small>Posted on " . $row['time'] . "</small>";
            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "No comments yet.";
    }
    ?>

    <?php $conn->close(); ?>
</body>
</html>
