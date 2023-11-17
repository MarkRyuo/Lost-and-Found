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

// Check if the form is submitted (item claimed)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemID = $_POST["item_id"];

    // Update the item in the Items table to mark it as claimed
    $sqlUpdate = "UPDATE Items SET ClaimantName = 'Claimed' WHERE ItemID = $itemID";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Claim confirmation successful!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve lost items from the Items table
$sql = "SELECT * FROM Items WHERE OwnerID IS NULL AND ClaimantName IS NULL";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .claim-button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Lost Items</h2>

<?php
// Display lost items in a table with a claim button
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Item ID</th>";
    echo "<th>Item Name</th>";
    echo "<th>Description</th>";
    echo "<th>Category</th>";
    echo "<th>Found Location</th>";
    echo "<th>Found Date</th>";
    echo "<th>Action</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ItemID"] . "</td>";
        echo "<td>" . $row["ItemName"] . "</td>";
        echo "<td>" . $row["Description"] . "</td>";
        echo "<td>" . $row["Category"] . "</td>";
        echo "<td>" . $row["FoundLocation"] . "</td>";
        echo "<td>" . $row["FoundDate"] . "</td>";
        echo "<td><button class='claim-button' onclick='claimItem(" . $row["ItemID"] . ")'>Claim</button></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No available lost items.";
}

// Close the database connection
$conn->close();
?>

<script>
    function claimItem(itemId) {
        // Send an AJAX request to claim the item without refreshing the page
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Display the response message
                alert(this.responseText);
                // Remove the row from the table
                var row = document.getElementById("row-" + itemId);
                row.parentNode.removeChild(row);
            }
        };
        xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("item_id=" + itemId);
    }
</script>

</body>
</html>
