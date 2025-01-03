<?php
include 'db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM reservations WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Reservation canceled!";
    header("Location: view_reservations.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
