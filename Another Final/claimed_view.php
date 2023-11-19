<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claimed View</title>
</head>
<body>
    <h2>Claimed View</h2>

    <?php
    // Connect to your MySQL database (replace with your actual credentials)
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve claimed items from the database
    $sql = "SELECT * FROM lost_items WHERE date_claimed IS NOT NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>Item Number</th><th>Item Name</th><th>Date Found</th><th>Date Claimed</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["item_number"] . "</td><td>" . $row["item_name"] . "</td><td>" . $row["date_found"] . "</td><td>" . $row["date_claimed"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No claimed items found.";
    }

    $conn->close();
    ?>
</body>
</html>
