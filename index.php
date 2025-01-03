
<?php
// index.php
include 'db_connect.php';

// Fetch images for "About Us" section
$aboutQuery = "SELECT * FROM images WHERE image_type = 'about' ORDER BY id";
$aboutResult = mysqli_query($conn, $aboutQuery);
if (!$aboutResult) {
    die('Error fetching About Us images: ' . mysqli_error($conn));
}

// Fetch images for "Special Events" section
$eventsQuery = "SELECT * FROM images WHERE image_type = 'event' ORDER BY id";
$eventsResult = mysqli_query($conn, $eventsQuery);
if (!$eventsResult) {
    die('Error fetching Special Events images: ' . mysqli_error($conn));
}

// Fetch images for "Promotions" section
$promotionsQuery = "SELECT * FROM images WHERE image_type = 'promo' ORDER BY id";
$promotionsResult = mysqli_query($conn, $promotionsQuery);
if (!$promotionsResult) {
    die('Error fetching Promotions images: ' . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallary Cafe</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    
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
            <li><a href="#home">Home</a></li>
            <li class="dropdown">
                <a href="#menu" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                    <a href="#search-meal">Search Meal</a>
                    <a href="meals.php">Meals</a>
                    
                </div>
            </li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#events">Special Events</a></li>
            <li><a href="#promotions">Promotions</a></li>
             <li class="dropdown">
                <a href="#reservations" class="dropbtn">Reservations</a>
                <div class="dropdown-content">
                    <a href="#reservations">Table Reservations</a>
                    <a href="#parking-reservation">Parking Reservation</a>
                    <a href="#pre-order">Pre Orders</a>
                </div>
            </li>
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
            <li><a href="#home">Home</a></li>
            <li class="dropdown">
                <a href="#menu" class="dropbtn">Menu</a>
                <div class="dropdown-content">
                    <a href="#search-meal">Search Meal</a>
                    <a href="meals.php">Meals</a>
                    
                </div>
            </li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#events">Special Events</a></li>
            <li><a href="#promotions">Promotions</a></li>
            <li><a href="login.html" class="btn">Login</a></li>
        </ul>
    </nav>';
}
?>



<section id="home" class="section home">
    <div class="overlay">
    <div class="hero">

        <video autoplay loop muted plays-inline class="backvideo">
            <source src="images/galvid.mp4" type="video/mp4">`
        </video>
    </div>

        <img src="images/logo.png" alt="Gallery Cafe Logo" class="logo">
    </div>
</section>

    <section id="menu" class="section menu">
        <h2>Menu</h2>
        <div class="categories">
            <button id="meals" class="category" onclick="location.href='meals.php';">Meals</button>
            <!-- <button id="sfb" class="category" onclick="location.href='meals.php'; alert('Special Food & Beverages button clicked!')">Special Food & Beverages</button> -->
        </div>
    </section>

    <section id="search-meal" class="section search-meal">
    <h2>Search Meal</h2>
    <form id="searchForm" method="POST">
        <select name="meal_type">
            <option value="None">None</option>
            <option value="Sri_Lankan">Sri Lankan</option>
            <option value="Chinese">Chinese</option>
            <option value="Italian">Italian</option>
            <option value="Beverages">Beverages</option>
        </select>
        <input type="text" id="search-meal-txt" name="search_query" placeholder="Search for a meal...">
        <button type="submit">Search</button>
    </form>
    <div id="search-results" class="meal-items">
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include 'search.php';
        }
        ?>
    </div>
</section>



<section id="about" class="section about">
    <h2>About Us</h2>
    <p class="cont">Welcome to Gallery Cafe, where culinary passion meets a warm and inviting atmosphere. Established in 1985, our mission is to provide an unforgettable dining 
        experience that combines exceptional food, outstanding service, and a cozy ambiance.</p>

    <p class="cont">Our story began with a simple idea: to create a place where friends and family can gather to enjoy delicious, freshly prepared meals. We take pride in our 
        diverse menu, which features a fusion of traditional Sri Lankan, Chinese, Italian flavors and innovative culinary techniques. Each dish is crafted with the 
        finest locally sourced ingredients, ensuring a delightful taste in every bite.</p>
    <div class="image-boxes">
        <?php
        while ($row = mysqli_fetch_assoc($aboutResult)) {
            echo '<div class="box"><img src="images/' . htmlspecialchars($row['image_name']) . '" alt="About Image"></div>';
        }
        ?>
    </div>
</section>

<section id="events" class="section events">
    <h2>Special Events</h2>
    <div class="image-boxes">
        <?php
        while ($row = mysqli_fetch_assoc($eventsResult)) {
            echo '<div class="box"><img src="images/' . htmlspecialchars($row['image_name']) . '" alt="Event Image"></div>';
        }
        ?>
    </div>
</section>

<section id="promotions" class="section promotions">
    <h2>Promotions</h2>
    <div class="promo-boxes">
        <?php
        while ($row = mysqli_fetch_assoc($promotionsResult)) {
            echo '<div class="box" onclick="alert(\'Promotion clicked!\')"><img src="images/' . htmlspecialchars($row['image_name']) . '" alt="Promo Image"></div>';
        }
        ?>
    </div>
</section>



    <?php if (isset($_SESSION['email'])): ?>
    <section id="reservations" class="section reservations">   
    <h2>Table Reservations</h2>
    <div class="reservation-container">
        <div class="left-side">
            <form id="reservationForm" action="reserve.php" method="POST">
                <table>
                    <!-- Table buttons with onClick handlers -->
                    <tr>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(1)">1</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(2)">2</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(3)">3</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(4)">4</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(5)">5</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(6)">6</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(7)">7</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(8)">8</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(9)">9</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(10)">10</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(11)">11</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(12)">12</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(13)">13</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(14)">14</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(15)">15</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(16)">16</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(17)">17</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(18)">18</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(19)">19</button></td>
                        <td><button type="button" class="table-btn" onclick="setTableNumber(20)">20</button></td>
                    </tr>
                </table>
                <input type="hidden" name="table_number" id="table_number">
                <input type="date" name="reservation_date" required>
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
                </select>
                <button type="submit" onclick="return confirmReservation()">Reserve</button>
            </form>
        </div>
        <div class="right-side">
            <!-- Additional content here -->
        </div>
    </div>
</section>

<script>
function confirmReservation() {
    const tableNumber = document.getElementById('table_number').value;
    const reservationDate = document.querySelector('input[name="reservation_date"]').value;
    const guestNumber = document.querySelector('select[name="guest_number"]').value;
    
    if (tableNumber && reservationDate && guestNumber) {
        const message = `Table Number: ${tableNumber}\nReservation Date: ${reservationDate}\nNumber of Guests: ${guestNumber}`;
        return confirm(message + "\n\nDo you want to proceed with the reservation?");
        
    } else {
        alert('Please fill in all the fields.');
        return false; // Prevent form submission
    }
}
</script>


<script>
    function setTableNumber(tableNumber) {
        document.getElementById('table_number').value = tableNumber;
        alert("Selected table number is " + tableNumber);
    }
</script>

<section id="parking-reservation" class="section parking-reservation">
    <h2>Parking Reservation</h2>
    <form id="parkingReservationForm" class="small-form" action="reserve_parking.php" method="POST">
        <label for="table-reservation" class="black-label">Table Reservation:</label>
        <select id="table-reservation" name="reservation_id" required onchange="updateParkingDate()">
            <option value="">Select a reservation</option>
            <!-- Options will be populated by JavaScript -->
        </select>

        <label for="parking-date" class="black-label">Parking Date:</label>
        <input type="text" id="parking-date" name="parking_date" readonly required>

        <label for="vehicle-type" class="black-label">Vehicle Type:</label>
        <input type="text" id="vehicle-type" name="vehicle_type" placeholder="Vehicle Type" required>

        <label for="license-plate" class="black-label">License Plate:</label>
        <input type="text" id="license-plate" name="license_plate" placeholder="License Plate" required>

        <button type="submit" onclick="return confirmParkingReservation()">Submit Parking Reservation</button>
    </form>
</section>

<script>
// Function to update table reservation options and dates
function populateTableReservations() {
    fetch('fetch_table_reservations.php')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('table-reservation');
            select.innerHTML = '<option value="">Select a reservation</option>'; // Clear existing options

            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = `Table ${item.table_number} - ${item.reservation_date}`;
                select.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching reservations:', error));
}

// Function to update parking date based on selected table reservation
function updateParkingDate() {
    const select = document.getElementById('table-reservation');
    const selectedValue = select.value;
    const parkingDateInput = document.getElementById('parking-date');
    
    if (selectedValue) {
        const reservationDate = select.options[select.selectedIndex].text.split(' - ')[1];
        parkingDateInput.value = reservationDate;
    } else {
        parkingDateInput.value = '';
    }
}

// Initial population of table reservations
populateTableReservations();

function confirmParkingReservation() {
    const tableReservationSelect = document.getElementById('table-reservation');
    const vehicleTypeInput = document.getElementById('vehicle-type');
    const licensePlateInput = document.getElementById('license-plate');
    const parkingDateInput = document.getElementById('parking-date');
    const tableReservation = tableReservationSelect.options[tableReservationSelect.selectedIndex].text;
    const vehicleType = vehicleTypeInput.value;
    const licensePlate = licensePlateInput.value;
    const parkingDate = parkingDateInput.value;

    if (tableReservation && vehicleType && licensePlate && parkingDate) {
        alert(`Table Reservation: ${tableReservation}, Vehicle Type: ${vehicleType}, License Plate: ${licensePlate}, Parking Date: ${parkingDate}`);
        return true; // Proceed with form submission
    } else {
        alert('Please fill in all fields.');
        return false; // Prevent form submission
    }
}
</script>

<section id="pre-order" class="section pre-order ">
<h2><center>Pre-Order</center></h2>
<form id="preOrderForm" action="addorder.php" method="POST">
    <label for="item" class="black-label">Select Item:</label>
    <select id="item" name="item_name" required>
        <option value="">Select an item</option>
        <?php include 'fetch_items.php'; ?>
    </select>

    <label for="quantity" class="black-label">Quantity:</label>
    <input type="number" id="quantity" name="quantity" placeholder="Quantity" required>

    <button type="submit" onclick="return confirmPreOrder()">Submit Pre-order</button>
</form>
</section>

<script>
function confirmPreOrder() {
    const itemSelect = document.getElementById('item');
    const quantityInput = document.getElementById('quantity');
    const itemName = itemSelect.options[itemSelect.selectedIndex].text;
    const quantity = quantityInput.value;

    if (itemSelect.value && quantity) {
        alert(`Selected item: ${itemName}, Quantity: ${quantity}`);
        return true; // Proceed with form submission
    } else {
        alert('Please select an item and enter a quantity.');
        return false; // Prevent form submission
    }
}
</script>
<?php endif; ?>



<footer>
    <div class="footer-container">
        <div class="footer-left">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.903852278385!2d90.39196367420747!3d23.750903229898396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x374f9c94204dbd15%3A0x54cdeed4d1193f21!2sRestaurant!5e0!3m2!1sen!2sbd!4v1675470048999!5m2!1sen!2sbd" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="footer-right">
            <h2>Gallery Cafe</h2><br><br>
            <p class="footer-cont">123 Main Street, City, Colombo</p>
            <p class="footer-cont">Contact: +1 234 567 890</p>
            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
    <div class="all-rights">
        <p>&copy; 2023 Gallery Cafe. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
