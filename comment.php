
<?php
include("connection.php");

$sql = "SELECT * FROM user_reviews";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .review-container {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }
        .review-header {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }
        .review-header div {
            flex: 1;
        }
        .review-header .name,
        .review-header .email {
            font-weight: bold;
            margin: 0;
        }
        .review-header .email {
            color: #555;
            font-size: 0.9em;
        }
        .review-header .review-label {
            font-weight: bold;
        }
        .review-content {
            margin-bottom: 10px;
        }
        .review-content .review {
            margin: 0;
        }
        .review-footer {
            font-size: 0.9em;
            color: #999;
            text-align: right;
        }
    </style>
</head>
<body>

<?php
while($row = $result->fetch_assoc()){
    ?>
    <div class="review-container">
        <div class="review-header">
            <div class="name"><?=htmlspecialchars($row['name']);?></div>
            <div class="email"><?=htmlspecialchars($row['email']);?></div>
           
            <div class="review-content">
                <p class="review"><?=htmlspecialchars($row['review']);?></p>
            </div>
            <div class="review-footer"><?=htmlspecialchars($row['time']);?></div>
        </div>
    </div>
    <?php
}
?>

</body>
</html>
