<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    // Delete the food item from the database
    $sql = "DELETE FROM food_and_beverages WHERE name='$name'";

    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully!";
        header("Location: add_food.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
