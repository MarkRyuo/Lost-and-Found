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

// Process the form data
$item_number = $_POST['item_number'];
$item_name = $_POST['item_name'];
$date_found = $_POST['date_found'];

// Insert data into the database
$sql = "INSERT INTO lost_items (item_number, item_name, date_found) VALUES ('$item_number', '$item_name', '$date_found')";

if ($conn->query($sql) === TRUE) {
    echo "Item reported successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
