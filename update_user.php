<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    $sql = "SELECT * FROM users WHERE ID='$ID'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
} else if (isset($_POST['update'])) {
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET name='$name', telephone='$telephone', email='$email', role='$role', password='$passwordHash' WHERE ID='$ID'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User updated successfully!'); window.location.href='manage_users.php';</script>";
    } else {
        echo "Error updating user: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: manage_users.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="css/admin_styles.css">
</head>
<body>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="admindashboard.php">Dashboard</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="add_food.php">Add Food & Beverages</a></li>
            <li><a href="update_info.php">Update Information</a></li>
            <li><a href="logout.php" class="btn">Logout</a></li>
        </ul>
    </nav>

    <section id="admin-content">
        <h1>Update User</h1>
        <form action="update_user.php" method="POST">
            <input type="hidden" name="ID" value="<?php echo $user['ID']; ?>">
            <input type="text" name="name" placeholder="Name" value="<?php echo $user['name']; ?>" required><br>
            <input type="text" name="telephone" placeholder="Mobile Number" value="<?php echo $user['telephone']; ?>" required><br>
            <input type="email" name="email" placeholder="Email" value="<?php echo $user['email']; ?>" required><br>
            <select name="role">
                <option value="user"  <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="staff" <?php echo $user['role'] == 'staff' ? 'selected' : ''; ?>>Operational Staff</option>
            </select><br>
            <input type="password" name="password" placeholder="New Password (leave blank to keep current)"><br>
            <button type="submit" name="update">Update User</button>
        </form>
    </section>
</body>
</html>
