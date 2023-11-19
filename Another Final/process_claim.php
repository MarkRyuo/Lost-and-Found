<?php
// Connect to your MySQL database (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nt3102";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the claim request
$itemId = $_GET['id'];
$dateClaimed = date('Y-m-d');

// Update the database to mark the item as claimed
$sql = "UPDATE lost_items SET date_claimed = '$dateClaimed' WHERE id = $itemId";

if ($conn->query($sql) === TRUE) {
    echo "Item claimed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
