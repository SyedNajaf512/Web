<?php
include 'db.php';

$sql = "SELECT * FROM users ORDER BY name ASC";
$result = $conn->query($sql);

echo "<table>
  <tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Actions</th>
  </tr>";

while ($row = $result->fetch_assoc()) {
  echo "<tr>
    <td>{$row['user_id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['email']}</td>
    <td>
      <form action='update-user.php' method='POST' style='display:inline'>
        <input type='hidden' name='id' value='{$row['user_id']}'>
        <button class='delete' name='delete'>Delete</button>
      </form>
    </td>
  </tr>";
}

echo "</table>";
?>
