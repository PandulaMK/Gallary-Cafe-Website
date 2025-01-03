<?php
include 'db_connect.php';

$name = $_POST['name'];
$telephone =$_POST['telephone'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

$sql = "INSERT INTO users (email, password,role,name,telephone) VALUES ('$email', '$password','$role','$name','$telephone')";

if ($conn->query($sql) === TRUE) {
    echo "User created successfully!";
    header("Location: manage_users.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
