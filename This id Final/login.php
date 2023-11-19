<?php
session_start();

// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'userdb';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize($input) {
    global $conn;
    return mysqli_real_escape_string($conn, $input);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize($_POST['username']);
    $password = md5(sanitize($_POST['password'])); // You should use more secure password hashing

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];

        // Redirect based on role
        if ($row['role'] == 'admin') {
            header("Location: admin_system.php");
        } elseif ($row['role'] == 'security') {
            header("Location: security_system.php");
        } elseif ($row['role'] == 'student') {
            header("Location: student_system.php?sr_code=" . $row['sr_code']);
        }
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>
