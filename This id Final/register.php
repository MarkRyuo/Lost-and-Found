<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare('INSERT INTO users (full_name, username, password, email, role) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $full_name, $username, $password, $email, $role);

    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error during registration: " . $stmt->error;
    }

    $stmt->close();
}
?>
