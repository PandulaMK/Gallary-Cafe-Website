<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="css/staff_styles.css">
    <script src="staff_scripts.js" defer></script>
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
            <li><a href="staffdashboard.php">Dashboard</a></li>
            <li><a href="view_reservations.php">View Reservations</a></li>
            <li><a href="view_orders.php">View Orders</a></li>
            <li><a href="logout.php" class="btn">Logout</a></li>
        </ul>
    </nav>

    <section id="staff-content">
        <h1>Welcome to the Staff Dashboard</h1>
        <p>Select an option from the menu to get started.</p>
    </section>
</body>
</html>
