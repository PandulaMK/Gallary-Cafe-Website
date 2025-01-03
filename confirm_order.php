<?php
include 'db_connect.php';

$id = $_GET['id'];
$sql = "UPDATE orders SET status='Confirmed' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Order confirmed!";
    header("Location: view_orders.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
