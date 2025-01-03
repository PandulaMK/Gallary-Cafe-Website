<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
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

    <section id="staff-content">
        <h1>View Orders</h1>
        <?php
        include 'db_connect.php';

        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Name</th><th>Quantity</th><th>User_Email</th><th>Status</th><th>Actions</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["quantity"]. "</td><td>" . $row["email"]. "</td><td>" . $row["status"]. "</td><td><a href='confirm_order.php?id=" . $row["id"]. "'>Confirm</a> | <a href='modify_order_form.php?id=" . $row["id"]. "'>Modify</a> | <a href='cancel_order.php?id=" . $row["id"]. "'>Cancel</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "No orders found";
        }

        $conn->close();
        ?>
    </section>
</body>
</html>
