<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include_once("connection.php");

    // Get user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query the database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // Check if the user exists
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session and redirect to a secure page
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: user_profile.php");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid password";
        }
    } else {
        // User does not exist
        echo "Invalid username";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
