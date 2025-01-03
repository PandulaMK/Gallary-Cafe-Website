<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $selected_items = $_POST['selected_items'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price'];

    foreach ($selected_items as $item) {
        $quantity = $quantities[$item];
        $price = $prices[$item];
        
        $sql = "INSERT INTO cart (user_id, item_name, quantity, price) VALUES ('$user_id', '$item', '$quantity', '$price')";
        
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    echo "<script>alert('Order added successfully!'); window.location.href = 'index.php';</script>";
} else {
    echo "User ID is required.";
}
?>
