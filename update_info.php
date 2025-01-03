
<?php
// update_info.php
include 'db_connect.php';

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

// Handle image deletion
if (isset($_POST['deleteImage'])) {
    $imageName = $_POST['imageName'];
    $deleteQuery = "DELETE FROM images WHERE image_name = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "s", $imageName);
    if (mysqli_stmt_execute($stmt)) {
        // echo '<p>Image deleted successfully.</p>';
    } else {
        echo '<p>Error deleting image: ' . mysqli_error($conn) . '</p>';
    }
    mysqli_stmt_close($stmt);
}

// Fetch images for deletion
$fetchImagesQuery = "SELECT image_name FROM images ORDER BY id";
$fetchImagesResult = mysqli_query($conn, $fetchImagesQuery);
if (!$fetchImagesResult) {
    die('Error fetching images: ' . mysqli_error($conn));
}

// Handle image uploads
$imageTypes = []; // Initialize the variable to avoid undefined variable warning

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateAboutImages'])) {
        $imageTypes = ['about'];
    } elseif (isset($_POST['updatePromoImages'])) {
        $imageTypes = ['promo'];
    } elseif (isset($_POST['updateEventImages'])) {
        $imageTypes = ['event'];
    }

    foreach ($imageTypes as $type) {
        for ($i = 1; $i <= 5; $i++) {
            $inputName = $type . 'Image' . $i;
            if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {
                $fileName = $_FILES[$inputName]['name'];
                $fileTmp = $_FILES[$inputName]['tmp_name'];
                $uploadDir = 'images/';
                $filePath = $uploadDir . basename($fileName);
                
                // Move uploaded file to the target directory
                if (move_uploaded_file($fileTmp, $filePath)) {
                    // Update database with new image
                    $stmt = $conn->prepare("INSERT INTO images (image_type, image_name, uploaded_at) VALUES (?, ?, NOW())");
                    $stmt->bind_param("ss", $type, $fileName);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }
    // echo '<p>Images updated successfully!</p>';
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information</title>
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
        <h1>Update Information</h1>
        <p>This section can be used to update any information on the website.</p>
        <div class="update-section">
            <h2>Update About Us Images</h2>
            <form action="update_info.php" method="POST" enctype="multipart/form-data">
                <label for="aboutImage1">About Image 1:</label>
                <input type="file" name="aboutImage1" id="aboutImage1" accept="image/*"><br>

                <label for="aboutImage2">About Image 2:</label>
                <input type="file" name="aboutImage2" id="aboutImage2" accept="image/*"><br>

                <label for="aboutImage3">About Image 3:</label>
                <input type="file" name="aboutImage3" id="aboutImage3" accept="image/*"><br>

                <label for="aboutImage4">About Image 4:</label>
                <input type="file" name="aboutImage4" id="aboutImage4" accept="image/*"><br>

                <label for="aboutImage5">About Image 5:</label>
                <input type="file" name="aboutImage5" id="aboutImage5" accept="image/*"><br>

                <button type="submit" name="updateAboutImages">Update About Us Images</button>
            </form>
        </div>

        <div class="update-section">
            <h2>Update Promotions Images</h2>
            <form action="update_info.php" method="POST" enctype="multipart/form-data">
                <label for="promoImage1">Promotion Image 1:</label>
                <input type="file" name="promoImage1" id="promoImage1" accept="image/*"><br>

                <label for="promoImage2">Promotion Image 2:</label>
                <input type="file" name="promoImage2" id="promoImage2" accept="image/*"><br>

                <label for="promoImage3">Promotion Image 3:</label>
                <input type="file" name="promoImage3" id="promoImage3" accept="image/*"><br>

                <button type="submit" name="updatePromoImages">Update Promotions Images</button>
            </form>
        </div>

        <div class="update-section">
            <h2>Update Events Images</h2>
            <form action="update_info.php" method="POST" enctype="multipart/form-data">
                <label for="eventImage1">Event Image 1:</label>
                <input type="file" name="eventImage1" id="eventImage1" accept="image/*"><br>

                <label for="eventImage2">Event Image 2:</label>
                <input type="file" name="eventImage2" id="eventImage2" accept="image/*"><br>

                <label for="eventImage3">Event Image 3:</label>
                <input type="file" name="eventImage3" id="eventImage3" accept="image/*"><br>

                <label for="eventImage4">Event Image 4:</label>
                <input type="file" name="eventImage4" id="eventImage4" accept="image/*"><br>

                <button type="submit" name="updateEventImages">Update Events Images</button>
            </form>

            <h2>Delete Images</h2>
            <form action="update_info.php" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th>Image Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($fetchImagesResult) > 0) {
                            while ($row = mysqli_fetch_assoc($fetchImagesResult)) {
                                echo '<tr>
                                        <td>' . htmlspecialchars($row['image_name']) . '</td>
                                        <td>
                                            <form action="update_info.php" method="POST" style="display:inline;">
                                                <input type="hidden" name="imageName" value="' . htmlspecialchars($row['image_name']) . '">
                                                <button type="submit" name="deleteImage">Delete</button>
                                            </form>
                                        </td>
                                    </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="2">No images available to delete.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </section>
</body>
</html>
