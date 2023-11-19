<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>

<?php
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

// Fetch user data from the security_table
$sql = "SELECT Security_Id, Username, Password FROM security_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<h2>User Profile</h2>";
        echo "<p><strong>Security ID:</strong> " . $row["Security_Id"] . "</p>";
        echo "<p><strong>Username:</strong> " . $row["Username"] . "</p>";
        // Note: In a real-world application, you wouldn't display passwords like this. This is just for demonstration purposes.
        echo "<p><strong>Password:</strong> " . $row["Password"] . "</p>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

</body>
</html>
