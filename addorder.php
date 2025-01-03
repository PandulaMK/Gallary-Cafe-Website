<?php
include 'db_connect.php';
session_start(); // Start the session to access session variables

// Get form data
$item_name = $_POST['item_name'];
$quantity = $_POST['quantity'];
$status = 'pending'; // Default status, adjust as needed
$email = $_SESSION['email']; // Get the logged-in user's email

// Prepare and execute a query to check if the item exists
$stmt = $conn->prepare("SELECT name FROM food_and_beverages WHERE name = ?");
$stmt->bind_param("s", $item_name);
$stmt->execute();
$result_item = $stmt->get_result();

if ($result_item->num_rows > 0) {
    // Item exists, insert order into the orders table
    $stmt_order = $conn->prepare("INSERT INTO orders (quantity, status, name, email) VALUES (?, ?, ?, ?)");
    $stmt_order->bind_param("isss", $quantity, $status, $item_name, $email);

    if ($stmt_order->execute()) {
        // Order added successfully, redirect with JavaScript
        echo '<script>
                alert("Order added successfully!");
                window.location.href = "index.php";
              </script>';
    } else {
        echo "Error: " . $stmt_order->error;
    }
    
    $stmt_order->close();
} else {
    echo "Item not found";
}

$stmt->close();
$conn->close();
?>
