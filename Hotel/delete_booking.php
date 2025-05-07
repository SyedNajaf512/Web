<?php
header('Content-Type: application/json');
include('db.php');
$host = "localhost";
$user = "root";
$pass = "";
$db = "hotel-management";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'DB connection failed']);
    exit();
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);
$booking_id = isset($data['booking_id']) ? (int)$data['booking_id'] : 0;

if ($booking_id > 0) {
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $booking_id);
    $success = $stmt->execute();
    echo json_encode(['success' => $success]);
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid ID']);
}

$conn->close();
?>