<?php
include 'db_connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, description, type, price, image_path FROM food_and_beverages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="meal-item" data-type="' . strtolower($row["type"]) . '">';
        echo '<img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
        echo '<div class="meal-info">';
        echo '<h3>' . htmlspecialchars($row["name"]) . '</h3>';
        echo '<p>$' . htmlspecialchars($row["price"]) . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No meals found.';
}

$conn->close();
?>