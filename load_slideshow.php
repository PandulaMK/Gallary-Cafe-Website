<?php
include 'db_connect.php'; 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_GET['type'];
$sql = "SELECT name, price, image FROM menu_items WHERE type='$type'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='slideshow-item'>";
        echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
        echo "<p>" . $row['name'] . " - $" . $row['price'] . "</p>";
        echo "</div>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
