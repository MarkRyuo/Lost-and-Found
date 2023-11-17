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

// Retrieve claims information from the Claims table
$sql = "SELECT Claims.ClaimID, Claims.ClaimDate, Claims.ClaimStatus, Items.ItemName, Items.Description, Items.Category, Items.FoundLocation, Items.FoundDate, Users.FirstName, Users.LastName
        FROM Claims
        JOIN Items ON Claims.ItemID = Items.ItemID
        JOIN Users ON Claims.ClaimantID = Users.UserID";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Claims</title>
</head>
<body>

<h2>Claims</h2>

<table border="1">
    <tr>
        <th>Claim ID</th>
        <th>Claim Date</th>
        <th>Claim Status</th>
        <th>Item Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Found Location</th>
        <th>Found Date</th>
        <th>Claimant Name</th>
    </tr>

    <?php
    // Display claims information in a table
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ClaimID"] . "</td>";
            echo "<td>" . $row["ClaimDate"] . "</td>";
            echo "<td>" . $row["ClaimStatus"] . "</td>";
            echo "<td>" . $row["ItemName"] . "</td>";
            echo "<td>" . $row["Description"] . "</td>";
            echo "<td>" . $row["Category"] . "</td>";
            echo "<td>" . $row["FoundLocation"] . "</td>";
            echo "<td>" . $row["FoundDate"] . "</td>";
            echo "<td>" . $row["FirstName"] . " " . $row["LastName"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No claims found.</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
