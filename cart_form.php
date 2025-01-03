<?php
session_start();
include 'db_connect.php';

// Fetch food items from the database
$sql = "SELECT name, description, type, price, image_path FROM food_and_beverages";
$result = $conn->query($sql);

// Get the logged-in user's ID from the session
$user_id = isset($_SESSION['email']) ? $_SESSION['email'] : null;

if ($user_id === null) {
    // If user is not logged in, redirect to login page or show an error
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Gallary Cafe</title>
    <link rel="stylesheet" href="css/cart_styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/cart_scripts.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="images/logo2.png" alt="Restaurant Logo">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <!-- Add other navigation links as needed -->
            <li><a href="logout.php" class="btn">Logout</a></li>
        </ul>
    </nav>

    <section id="cart" class="section cart">
        <h2>Your Cart</h2>
        <form id="cartForm" action="process_cart.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
            <div class="cart-items">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="cart-item">
                            <input type="checkbox" name="selected_items[]" value="' . $row['name'] . '" class="item-checkbox">
                            <img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">
                            <div class="item-details">
                                <h3>' . $row['name'] . '</h3>
                                <p>' . $row['description'] . '</p>
                                <p>Rs.' . number_format($row['price'], 2) . '</p>
                                <input type="number" name="quantity[' . $row['name'] . ']" min="1" placeholder="Quantity" disabled>
                                <input type="hidden" name="price[' . $row['name'] . ']" value="' . $row['price'] . '">
                            </div>
                        </div>';
                    }
                } else {
                    echo '<p>No items available.</p>';
                }
                ?>
            </div>
            <div class="total-price">
                <p class="footer-cont">Total: Rs.<span id="total">0.00</span></p>
            </div>
            <button type="submit">Submit Cart</button>
        </form>
    </section>


    <footer>
    <div class="footer-container">
        <div class="footer-left">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.903852278385!2d90.39196367420747!3d23.750903229898396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x374f9c94204dbd15%3A0x54cdeed4d1193f21!2sRestaurant!5e0!3m2!1sen!2sbd!4v1675470048999!5m2!1sen!2sbd" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="footer-right">
            <h2>Gallary Cafe</h2><br><br>
            <p class="footer-cont">123 Main Street, City, Country</p>
            <p class="footer-cont">Contact: +1 234 567 890</p>
            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
    <div class="all-rights">
        <p>&copy; 2023 Gallary Cafe. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
