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
        echo "<td><button class='deleteButton' onclick='deleteItem(" . $row["ItemID"] . ")'>Claim</button></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No lost items found.";
}

// Close the database connection
$conn->close();
?>

<!-- JavaScript function to delete items -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function deleteItem(itemId) {
        if (confirm("Are you sure you want to delete this item?")) {
            // AJAX request to delete the item
            $.ajax({
                type: "GET",
                url: "delete_item.php?id=" + itemId, // Replace with the path to your PHP delete script
                success: function (response) {
                    if (response.status === "success") {
                        var row = document.getElementById("item-" + itemId);
                        row.parentNode.removeChild(row);
                        alert("Item claimed successfully!");
                    } else {
                        alert("Error: " + response.message);
                    }
                }
            });
        }
    }
</script>

</body>
</html>