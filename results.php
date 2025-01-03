<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Gallary Cafe</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['email'])) {
        echo '<nav class="navbar">
            <div class="logo">
                <img src="logo.png" alt="Restaurant Logo">
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li class="dropdown">
                    <a href="#menu" class="dropbtn">Menu</a>
                    <div class="dropdown-content">
                        <a href="#search-meal">Search Meal</a>
                        <a href="#meals">Meals</a>
                        <a href="#beverages">Beverages</a>
                    </div>
                </li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#events">Special Events</a></li>
                <li><a href="#promotions">Promotions</a></li>
                <li><a href="#reservations" class="btn">Table Reservations</a></li>
                <li><a href="logout.php" class="btn">Logout</a></li>
            </ul>
        </nav>';
    } else {
        echo '<nav class="navbar">
            <div class="logo">
                <img src="logo.png" alt="Restaurant Logo">
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li class="dropdown">
                    <a href="#menu" class="dropbtn">Menu</a>
                    <div class="dropdown-content">
                        <a href="#search-meal">Search Meal</a>
                        <a href="#meals">Meals</a>
                        <a href="#beverages">Beverages</a>
                    </div>
                </li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#events">Special Events</a></li>
                <li><a href="#promotions">Promotions</a></li>
                <li><a href="#reservations" class="btn">Table Reservations</a></li>
                <li><a href="login.html" class="btn">Login</a></li>
            </ul>
        </nav>';
    }
    ?>

    <section id="search-meal" class="section search-meal">
        <h2>Search Results</h2>
        <div id="search-results" class="search-results">
            <?php
            include 'db_connect.php';  // Ensure this file connects to your database

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get the search query and meal type from the form
            $meal_type = $_POST['meal_type'];
            $search_query = $_POST['search_query'];

            // Prepare the SQL statement
            $sql = "SELECT name, description, type, price, image_path FROM food_and_beverages WHERE type = ? AND name LIKE ?";
            $stmt = $conn->prepare($sql);

            // Add wildcards to the search query for partial matching
            $search_query = '%' . $search_query . '%';

            // Bind parameters to the prepared statement
            $stmt->bind_param("ss", $meal_type, $search_query);

            // Execute the statement
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Check if there are any results
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="meal-item">';
                    echo '<img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
                    echo '<div class="meal-info">';
                    echo '<h3>' . htmlspecialchars($row["name"]) . '</h3>';
                    echo '<p>$' . htmlspecialchars($row["price"]) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'No meals found matching your search criteria.';
            }

            // Close the statement and connection
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </section>

    <footer>
        <div class="footer-part">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.903852278385!2d90.39196367420747!3d23.750903229898396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x374f9c94204dbd15%3A0x54cdeed4d1193f21!2sRestaurant!5e0!3m2!1sen!2sbd!4v1675470048999!5m2!1sen!2sbd" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="footer-part">
            <p>123 Main Street, City, Country</p>
            <p>Contact: +1 234 567 890</p>
            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
        <div class="all-rights">
            <p>&copy; 2023 Gallary Cafe. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
