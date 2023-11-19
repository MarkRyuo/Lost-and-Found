<?php
// Start a session
session_start();

// Include database connection
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user data from the database
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Authentication successful
        $user = mysqli_fetch_assoc($result);

        // Store user data in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['full_name'];

        // Redirect to user profile page
        header("Location: profile.php");
        exit();
    } else {
        // Authentication failed
        echo "Invalid username or password.";
    }
}
?>
