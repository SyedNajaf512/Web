<?php
include 'db.php';

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm = $_POST["confirm_password"];

if ($password !== $confirm) {
    echo "Passwords do not match!";
    exit;
}

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful!";
    header("Location: login.html");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
