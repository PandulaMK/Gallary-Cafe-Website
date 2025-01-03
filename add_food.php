<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food & Beverages</title>
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
            <li><a href="php/logout.php" class="btn">Logout</a></li>
        </ul>
    </nav>

    <section id="admin-content">
        <h1>Add Food & Beverages</h1>
        <form action="addfood.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name" required><br>
            <textarea name="description" placeholder="Description" required></textarea><br>
            <select name="type">
                <option value="Sri_Lankan">Sri Lankan</option>
                <option value="Chinese">Chinese</option>
                <option value="Italian">Italian</option>
                <option value="Beverages">Beverages</option>
            </select><br>
            <input type="number" name="price" placeholder="Price" required><br>
            <input type="file" name="image" accept="image/*" required><br>
            <button type="submit">Add Item</button>
        </form>

        <h2>Food & Beverages List</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM food_and_beverages";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["type"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td>
                                <form action='update_food.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='name' value='" . $row["name"] . "'>
                                    <button type='submit'>Update</button>
                                </form>
                                <form action='delete_food.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='name' value='" . $row["name"] . "'>
                                    <button type='submit'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No food items found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>
