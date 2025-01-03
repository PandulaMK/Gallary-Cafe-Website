<?php
// fetch_cart_items.php
include 'db_connect.php'; // Make sure to include your DB connection

// Fetch cart items from the database
$query = "SELECT f.name, f.price, f.image_path, c.quantity, f.id
          FROM food_and_beverages f
          JOIN cart c ON f.id = c.food_id"; // Adjust table and column names as needed

$result = $conn->query($query);

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

header('Content-Type: application/json');
echo json_encode($cartItems);
?>
