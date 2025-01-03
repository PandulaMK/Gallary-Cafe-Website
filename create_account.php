<?php
include 'db_connect.php';

$name = $_POST['name'];
$telephone =$_POST['telephone'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = "user";
$sql = "INSERT INTO users (email, password,role,name,telephone) VALUES ('$email', '$password','$role','$name','$telephone')";

if (mysqli_query($conn, $sql)) {
    echo "Account created successfully!";
    header("Location: login.html");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
