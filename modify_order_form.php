<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Order</title>
    <link rel="stylesheet" href="css/common_styles.css">
    <link rel="stylesheet" href="css/staff_styles.css">
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
    <h1>Modify Order</h1>
    <form action="modify_order.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Cancelled">Cancelled</option>
        </select><br><br>
        <button type="submit">Modify Order</button>
    </form>
</body>
</html>
