<?php

include('db.php');
$host = "localhost";
$user = "root";
$pass = "";
$db = "hotel-management";
$conn = new mysqli($host, $user, $pass, $db);

/// Fallback JSON response
$response = [
    'total_bookings' => 0,
    'total_users' => 0,
    'available_rooms' => 0,
    'pending_requests' => 0
];

if ($conn->connect_error) {
    echo json_encode($response);
    exit();
}

// Queries with fallback
function getCount($conn, $query) {
    $result = $conn->query($query);
    return $result ? (int) $result->fetch_assoc()['total'] : 0;
}

$response['total_bookings'] = getCount($conn, "SELECT COUNT(*) AS total FROM bookings");
$response['total_users'] = getCount($conn, "SELECT COUNT(*) AS total FROM users");
$response['available_rooms'] = getCount($conn, "SELECT COUNT(*) AS total FROM rooms WHERE status = 'Available'");
$response['pending_requests'] = getCount($conn, "SELECT COUNT(*) AS total FROM bookings WHERE status IS NULL OR LOWER(TRIM(status)) = 'pending'");

echo json_encode($response);
$conn->close();
?>