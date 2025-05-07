<?php
include 'db.php';

$sql = "SELECT * FROM rooms ORDER BY room_id ASC";
$result = $conn->query($sql);

echo "<table>
  <tr>
    <th>ID</th><th>Room Type</th><th>Price</th><th>Status</th><th>Actions</th>
  </tr>";

while ($row = $result->fetch_assoc()) {
  echo "<tr>
    <td>{$row['room_id']}</td>
    <td>{$row['room_type']}</td>
    <td>\${$row['price']}</td>
    <td>{$row['status']}</td>
    <td>
      <form action='update-room.php' method='POST' style='display:inline'>
        <input type='hidden' name='room_id' value='{$row['room_id']}'>
        <button class='edit'>Edit</button>
      </form>
      <form action='update-room.php' method='POST' style='display:inline'>
        <input type='hidden' name='room_id' value='{$row['room_id']}'>
        <button class='delete' name='delete'>Delete</button>
      </form>
    </td>
  </tr>";
}

echo "</table>";
?>
