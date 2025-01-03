<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $sql = "SELECT * FROM food_and_beverages WHERE name='$name'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Food & Beverages</title>
    <link rel="stylesheet" href="css/admin_styles.css">
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
        <h1>Update Food & Beverages</h1>
        <form action="updatefood.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="original_name" value="<?php echo $row['name']; ?>">
            <input type="text" name="name" placeholder="Name" value="<?php echo $row['name']; ?>" required><br>
            <textarea name="description" placeholder="Description" required><?php echo $row['description']; ?></textarea><br>
            <select name="type">
                <option value="Sri_Lankan" <?php echo $row['type'] == 'Sri_Lankan' ? 'selected' : ''; ?>>Sri Lankan</option>
                <option value="Chinese" <?php echo $row['type'] == 'Chinese' ? 'selected' : ''; ?>>Chinese</option>
                <option value="Italian" <?php echo $row['type'] == 'Italian' ? 'selected' : ''; ?>>Italian</option>
                <option value="Beverages" <?php echo $row['type'] == 'Beverages' ? 'selected' : ''; ?>>Beverages</option>
            </select><br>
            <input type="number" name="price" placeholder="Price" value="<?php echo $row['price']; ?>" required><br>
            <input type="file" name="image" accept="image/*"><br>
            <button type="submit">Update Item</button>
        </form>
    </section>
</body>
</html>
