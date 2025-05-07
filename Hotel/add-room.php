<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $sql = "INSERT INTO rooms (room_type, price, status) VALUES ('$room_type', $price, '$status')";

    if ($conn->query($sql)) {
        header("Location: index.html#rooms");
        exit;
    } else {
        echo "Error adding room: " . $conn->error;
    }
}
$sql = "SELECT id, type, price, status FROM rooms";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['type']}</td>
    <td>\${$row['price']}</td>
    <td>{$row['status']}</td>
    <td><button>Edit</button>
    <form action='delete-room.php' method='POST' style='display:inline'>
        <input type='hidden' name='id' value='{$row['id']}'>
        <button class='delete'>Delete</button>
    </form></td>
  </tr>";
}
?>
