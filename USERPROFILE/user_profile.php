<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

// Include your database connection file
include_once("db_connection.php");

// Get the user information from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching user information";
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h2>User Profile</h2>
    <p>Welcome, <?php echo $user['username']; ?>!</p>
    <!-- Display other user information as needed -->
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Full Name: <?php echo $user['full_name']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
