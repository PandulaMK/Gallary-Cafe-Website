<?php
include 'db_connect.php';

$id = $_GET['id'];
$sql = "UPDATE reservations SET status='Confirmed' WHERE id=$id";

if ($conn->query($sql) == TRUE) {
    echo "Reservation confirmed!";
    header("Location: view_reservations.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
