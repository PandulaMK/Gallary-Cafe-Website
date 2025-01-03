<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/admin_styles.css">
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: login.html");
        exit();
    }
    include 'db_connect.php';
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
        <h1>Manage Users</h1>
        <form action="create_user.php" method="POST">
            <input type="text" name="name" placeholder="Name" required><br>
            <input type="text" name="telephone" placeholder="Mobile Number" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <select name="role">
                
                <option value="admin">Admin</option>
                <option value="staff">Operational Staff</option>
            </select><br>
            <button type="submit">Create User</button>
        </form>

        <h2>Existing Users</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['telephone']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['role']}</td>
                            <td>
                                <a href='update_user.php?ID={$row['ID']}'>Update</a> |
                                <a href='delete_user.php?ID={$row['ID']}'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </section>
</body>
</html>
