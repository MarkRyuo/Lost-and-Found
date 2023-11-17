<?php
// Replace these variables with your actual database connection details
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve lost items from the Items table
$sql = "SELECT * FROM Items WHERE OwnerID IS NULL";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Lost Items</title>
</head>
<body>

<h2>Lost Items</h2>

<table border="1">
    <tr>
        <th>Item ID</th>
        <th>Item Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Found Location</th>
        <th>Found Date</th>
    </tr>

    <?php
    // Display lost items in a table
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ItemID"] . "</td>";
            echo "<td>" . $row["ItemName"] . "</td>";
            echo "<td>" . $row["Description"] . "</td>";
            echo "<td>" . $row["Category"] . "</td>";
            echo "<td>" . $row["FoundLocation"] . "</td>";
            echo "<td>" . $row["FoundDate"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No lost items found.</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
