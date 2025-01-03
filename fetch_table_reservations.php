<?php
include 'db_connect.php';

$sql = "SELECT id, table_number, reservation_date FROM reservations";
$result = mysqli_query($conn, $sql);

$data = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            'id' => $row['id'],
            'table_number' => $row['table_number'],
            'reservation_date' => $row['reservation_date']
        );
    }
    echo json_encode($data); // Send JSON data to client-side
} else {
    echo json_encode(array()); // Send empty array if no data
}

mysqli_close($conn);
?>
