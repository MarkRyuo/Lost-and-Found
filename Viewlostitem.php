<?php
// Replace these variables with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lostandfound";

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
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Lost Items</h2>

<?php
// Display lost items in a table
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Item ID</th>";
    echo "<th>Item Name</th>";
    echo "<th>Description</th>";
    echo "<th>Category</th>";
    echo "<th>Found Location</th>";
    echo "<th>Found Date</th>";
    echo "</tr>";

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

    echo "</table>";
} else {
    echo "No lost items found.";
}

// Close the database connection
$conn->close();
?>

</body>
</html>
