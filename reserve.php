<?php
include 'db_connect.php';
session_start(); // Start the session to access session variables

// Retrieve form data
$table_number = $_POST['table_number'];
$reservation_date = $_POST['reservation_date'];
$guest_number = $_POST['guest_number'];
$email = $_SESSION['email']; // Get the logged-in user's email

// Adjust SQL query to use the correct column names and include email
$sql = "INSERT INTO reservations (table_number, reservation_date, guest_number, user_email)
        VALUES (?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("isis", $table_number, $reservation_date, $guest_number, $email);

// Execute and handle success/error
if ($stmt->execute()) {
    echo "<script>alert('Reservation added successfully!'); window.location.href = 'index.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
