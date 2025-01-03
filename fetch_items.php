<?php

include 'db_connect.php';

// Fetch items from the food_and_beverages table
$sql = "SELECT name, price FROM food_and_beverages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<option value="' . $row["name"] . '" data-price="' . $row["price"] . '">' . $row["name"] . ' - $' . $row["price"] . '</option>';
    }
} else {
    echo '<option value="">No items available</option>';
}
$conn->close();
?>
