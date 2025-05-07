<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);

    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM users WHERE id=$id";
    }

    if ($conn->query($sql)) {
        header("Location: index.html#users");
        exit;
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}
?>
