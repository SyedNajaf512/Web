<?php
include('db.php');
$host = "localhost";
$user = "root";
$pass = "";
$db = "hotel-management";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(['bookings' => [], 'error' => 'DB connection failed']);
    exit();
}

// Fetch bookings (you can sort by newest too)
$sql = "SELECT id, name, room_type, check_in_date, check_out_date, status FROM bookings ORDER BY created_at DESC";
$result = $conn->query($sql);

$bookings = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

echo json_encode(['bookings' => $bookings]);
$conn->close();
?>