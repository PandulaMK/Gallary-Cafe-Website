<?php
session_start();
include 'db_connect.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admindashboard.php");
        } elseif ($user['role'] == 'staff') {
            header("Location: staffdashboard.php");
        } elseif ($user['role'] == 'user') {
            header("Location: index.php");
        } else {
            echo "<script>alert('Invalid login credentials.'); 
            window.location.href='login.html';</script> ";
            
        }
    } else {
        echo "<script>alert('Invalid login credentials.'); 
            window.location.href='login.html';</script> ";
        
    }
    mysqli_close($conn);
} else {
    echo "<script>alert('Email and password are required.'); 
            window.location.href='login.html';</script> ";
}
?>
