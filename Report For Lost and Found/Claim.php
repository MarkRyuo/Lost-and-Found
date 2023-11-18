<?php
// Replace these variables with your actual database connection details
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

// Retrieve lost items from the Items table
$sql = "SELECT * FROM Items ";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Lost Items</title>
    <style>
        .parent-Table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-Header th {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .table-Data td {
            border: 1px solid black;
            padding: 8px;
        }

        input[type="text"] {
            width: 100%;
            box-sizing: border-box;
        }

        .removeButton {
            cursor: pointer;
            background-color: #ff6666;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>View Lost Item</h2>

<?php
// Display lost items
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
        echo "<td><button class='removeButton' onclick='removeItem(" . $row["ItemID"] . ")'>Remove</button></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No lost items found.";
}

// Close the database connection
$conn->close();
?>

<script>
    function removeItem(itemId) {
        var confirmation = confirm("Are you sure you want to remove this item?");
        if (confirmation) {
            var itemElement = document.getElementById("item-" + itemId);
            if (itemElement) {
                itemElement.remove();
            }

            // You can add an AJAX call here to update the database and remove the item
            // Example AJAX code:
            // var xhr = new XMLHttpRequest();
            // xhr.open("POST", "remove_item.php", true);
            // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // xhr.send("item_id=" + itemId);
        }
    }
</script>

</body>
</html>
