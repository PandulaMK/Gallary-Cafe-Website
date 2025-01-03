<?php
// Assuming you have set up a MySQL database and have a connection file
include 'db_connect.php';

$name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$email = $_POST['email'];

$sql = "INSERT INTO promotions (name, address, contact, email) VALUES ('$name', '$address', '$contact', '$email')";

if (mysqli_query($conn, $sql)) {
    echo "Promotion entry successful!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
