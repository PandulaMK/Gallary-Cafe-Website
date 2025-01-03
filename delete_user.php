<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    $sql = "DELETE FROM users WHERE ID='$ID'";

    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully!";
        header("Location: manage_users.php");
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: manage_users.php");
}
?>
