<?php
include 'db_connect.php';

// Check if id is set and not empty
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $quantity = intval($_POST['quantity']);
    $status = $conn->real_escape_string($_POST['status']);

    // Prepare and execute the SQL statement
    $sql = "UPDATE orders SET quantity='$quantity', status='$status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Order modified!";
        header("Location: view_orders.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid ID.";
}

$conn->close();
?>
