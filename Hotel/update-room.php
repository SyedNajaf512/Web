<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = intval($_POST['room_id']);

    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM rooms WHERE room_id=$room_id";
    }

    if ($conn->query($sql)) {
        header("Location: index.html#rooms");
        exit;
    } else {
        echo "Error deleting room: " . $conn->error;
    }
}
?>
