<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_styles.css">
    <script src="admin_scripts.js" defer></script>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: login.html");
        exit();
    }
    ?>
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
        <h1>Welcome to the Admin Dashboard</h1>
        <p>Select an option from the menu to get started.</p>
    </section>
</body>
</html>
