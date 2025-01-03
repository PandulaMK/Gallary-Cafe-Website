<?php
include 'db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM orders WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Order canceled!";
    header("Location: view_orders.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
