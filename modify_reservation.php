<?php
session_start();
include 'db_connect.php';

$id = $_POST['id'];
$table_number = $_POST['table_number'];
$reservation_date = $_POST['reservation_date'];
$guest_number = $_POST['guest_number'];

$sql = "UPDATE reservations SET table_number='$table_number', reservation_date='$reservation_date', guest_number='$guest_number' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    $message = "Reservation modified successfully!\\nTable Number: $table_number\\nReservation Date: $reservation_date\\nNumber of Guests: $guest_number";
    echo "<script type='text/javascript'>
            alert('$message');
            setTimeout(function() {
                window.location.href = 'view_reservations.php';
            }, 1000);
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
