<?php
include 'db_connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Gallery Cafe</title>
    <link rel="stylesheet" href="css/meals.css">
    <script src="js/scripts.js" defer></script>
    
</head>
<body>
<?php
session_start();
if (isset($_SESSION['email'])) {
    echo '<nav class="navbar">
        <div class="logo">
            <img src="images/logo2.png" alt="Restaurant Logo">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="#menu" class="dropbtn">Menu</a>
                
            </li>
            <li><a href="index.php#about">About Us</a></li>
            <li><a href="index.php#events">Special Events</a></li>
            <li><a href="index.php#promotions">Promotions</a></li>
            <li><a href="index.php#reservations" class="btn">Table Reservations</a></li>
            <li><a href="cart_form.php" class="btn"><i class="fa fa-shopping-cart"></i> Cart</a></li>
            <li><a href="logout.php" class="btn">Logout</a></li>
        </ul>
    </nav>';
} else {
    echo '<nav class="navbar">
        <div class="logo">
            <img src="images/logo2.png" alt="Restaurant Logo">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="#menu" class="dropbtn">Menu</a>
                
            </li>
            <li><a href="index.php#about">About Us</a></li>
            <li><a href="index.php#events">Special Events</a></li>
            <li><a href="index.php#promotions">Promotions</a></li>
            <li><a href="login.html" class="btn">Login</a></li>
        </ul>
    </nav>';
}
?>

        <section class="menu-section">
            <h1>Menu</h1>
            <div class="menu-categories">
                <button class="tablink" onclick="openCategory(event, 'Sri_Lankan')">Sri Lankan</button>
                <button class="tablink" onclick="openCategory(event, 'Chinese')">Chinese</button>
                <button class="tablink" onclick="openCategory(event, 'Italian')">Italian</button>
                <button class="tablink" onclick="openCategory(event, 'Beverages')">Beverages</button>
            </div>

            <?php
            // Fetch data from the database
            $result = $conn->query("SELECT * FROM food_and_beverages");

            $categories = ['Sri_Lankan' => [], 'Chinese' => [], 'Italian' => [], 'Beverages' => []];

            while ($row = $result->fetch_assoc()) {
                if (isset($categories[$row['type']])) {
                    $categories[$row['type']][] = $row;
                } else {
                    $categories['Beverages'][] = $row;
                }
            }
            ?>

            <?php foreach ($categories as $category => $items): ?>
                <div id="<?= $category ?>" class="tabcontent">
                    <h2><?= $category ?></h2>
                    <div class="meal-items">
                        <?php foreach ($items as $item): ?>
                            <div class="meal-item">
                                <img src="<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                                <p><?= htmlspecialchars($item['name']) ?></p>
                                <p><?= htmlspecialchars($item['description']) ?></p>
                                <p>Rs.<?= htmlspecialchars($item['price']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </section>

        <footer>
            <p>&copy; 2024 Gallery Cafe. All rights reserved.</p>
        </footer>
    </div>

    <script>
        function openCategory(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Open the default tab
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementsByClassName("tablink")[0].click();
        });
    </script>
</body>
</html>
