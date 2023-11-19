<?php
session_start();
require_once('db.php'); // Include the database connection file

if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    // Redirect if the user is not an admin
    header('Location: security_system.php');
    exit;
}

// Retrieve user information from the session
$username = $_SESSION['username'];
$fullName = $_SESSION['full_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin System</title>
</head>
<body>
    <h2>Welcome Admin!</h2>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>

    <label for="fullName">Full Name:</label>
    <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($fullName); ?>" readonly>

    <!-- Your admin system content goes here -->
    <a href="/This id Final/Register.html">Register</a>
</body>
</html>

