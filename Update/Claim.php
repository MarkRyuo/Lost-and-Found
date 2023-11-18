<!DOCTYPE html>
<html>
<head>
    <title>Claim Lost Items</title>
</head>
<body>

<h2>Claim View Lost Item</h2>

<?php
require_once("database.php");

// Fetch lost items from the database
$sql = "SELECT ItemID, ItemName, FoundDate FROM items"; // Replace 'items' with your actual table name
$result = $conn->query($sql);

// Display lost items if there are any
if ($result->num_rows > 0) {
    echo "<table class='parent-Table'>";
    echo "<tr class='table-Header'>";
    echo "<th>Item ID</th>";
    echo "<th>Item Name</th>";
    echo "<th>Found Date</th>";
    echo "<th>Action</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='table-Data' id='item-" . $row["ItemID"] . "'>";
        echo "<td><input type='text' value='" . $row["ItemID"] . "' readonly></td>";
        echo "<td><input type='text' value='" . $row["ItemName"] . "' readonly></td>";
        echo "<td><input type='text' value='" . $row["FoundDate"] . "' readonly></td>";
        echo "<td><button class='claimButton' onclick='claimItem(" . $row["ItemID"] . ")'>Claim</button></td>";
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
<!-- JavaScript function to claim items -->
<script>
    function claimItem(itemId) {
        if (confirm("Are you sure you want to claim this item?")) {
            // AJAX request to claim the item
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var row = document.getElementById("item-" + itemId);
                    row.parentNode.removeChild(row);
                    alert("Item claimed successfully!");
                }
            };
            xhttp.open("GET", "claim_item.php?id=" + itemId, true); // Replace with the path to your PHP claim script
            xhttp.send();
        }
    }
</script>
</html>
