<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Reservation</title>
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
    <h1>Modify Reservation</h1>
    <form action="modify_reservation.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <label for="table_number">Table Number:</label>
        <input type="text" id="table_number" name="table_number" required><br><br>
        <label for="reservation_date">Reservation Date:</label>
        <input type="date" id="reservation_date" name="reservation_date" required><br><br>
        <label for="guest_number">Number of Guests:</label>
        <select name="guest_number" required>
                    <option value="1">1 Guest</option>
                    <option value="2">2 Guests</option>
                    <option value="3">3 Guests</option>
                    <option value="4">4 Guests</option>
                    <option value="5">5 Guests</option>
                    <option value="6">6 Guests</option>
                    <option value="7">7 Guests</option>
                    <option value="8">8 Guests</option>
                    <option value="9">9 Guests</option>
                    <option value="10">10 Guests</option>
        </select><br><br>
        <button type="submit">Modify Reservation</button>
    </form>
    
</body>
</html>
