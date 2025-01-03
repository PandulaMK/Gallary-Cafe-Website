<?php
include 'db_connect.php';

// Retrieve form data
$reservation_id = $_POST['reservation_id']; // Ensure this is how you're receiving the ID
$vehicle_type = $_POST['vehicle_type'];
$license_plate = $_POST['license_plate'];
$parking_date = $_POST['parking_date'];

// Adjust SQL query to use the correct column name
$sql = "INSERT INTO parking_reservations (reservation_id, vehicle_type, license_plate, parking_date)
        VALUES (?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $reservation_id, $vehicle_type, $license_plate, $parking_date);

// Execute and handle success/error
if ($stmt->execute()) {
    echo "<script>alert('Parking reservation added successfully!'); window.location.href = 'index.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
