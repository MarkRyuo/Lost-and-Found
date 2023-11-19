<?php
session_start();

// Perform your login authentication here
// Assuming you have validated the username and password from the form submission

// Replace these values with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nt3102";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace the following with your actual login authentication logic
$input_username = $_POST['username'];
$input_password = $_POST['password'];

$sql = "SELECT Security_Id, Username, Password FROM security_table WHERE Username = '$input_username' AND Password = '$input_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login successful
    $row = $result->fetch_assoc();

    // Store username in a session variable
    $_SESSION['username'] = $row["Username"];

    // Redirect to the user profile page
    header("Location: user_profile.php");
} else {
    echo "Login failed";
}

// Close connection
$conn->close();
?>
