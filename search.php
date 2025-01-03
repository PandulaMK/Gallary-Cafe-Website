<?php
include 'db_connect.php';  // Make sure this file correctly connects to your database

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
        echo '<div class="meal-item" data-type="' . strtolower($row["type"]) . '">';
        echo '<img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
        echo '<div class="meal-info">';
        echo '<h3>' . htmlspecialchars($row["name"]) . '</h3>';
        echo '<p>Rs.' . htmlspecialchars($row["price"]) . '</p>';
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
