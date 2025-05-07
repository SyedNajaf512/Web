<?php
include('db.php');
$host = "localhost";
$user = "root";
$pass = "";
$db = "hotel-management";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$check_in_date = $_POST['check_in_date'] ?? '';
$check_out_date = $_POST['check_out_date'] ?? '';
$room_type = $_POST['room_type'] ?? '';
$guests = $_POST['guests'] ?? '';
$message = $_POST['message'] ?? '';

// Basic validation
if ($name && $email && $check_in_date && $check_out_date && $room_type && $guests) {
    // Prepare SQL
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, check_in_date, check_out_date, room_type, guests, message, status, created_at)
                            VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', NOW())");

    $stmt->bind_param("sssssis", $name, $email, $check_in_date, $check_out_date, $room_type, $guests, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Error saving booking.'); window.history.back();</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
}

$conn->close();
?>