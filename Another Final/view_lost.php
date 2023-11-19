<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lost Items</title>
</head>
<body>
    <h2>View Lost Items</h2>

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

    // Retrieve lost items from the database
    $sql = "SELECT * FROM lost_items WHERE date_claimed IS NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' id='lostItemsTable'><tr><th>Item Number</th><th>Item Name</th><th>Date Found</th><th>Claim</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["item_number"] . "</td><td>" . $row["item_name"] . "</td><td>" . $row["date_found"] . "</td><td><button onclick='claimItem(" . $row["id"] . ")'>Claim</button></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No lost items found.";
    }

    $conn->close();
    ?>

    <script>
        function claimItem(itemId) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "process_claim.php?id=" + itemId, true);
            xhr.send();

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);

                    if (response.status === "success") {
                        // Remove the row from the table
                        var row = document.querySelector("tr:has(td:contains('" + itemId + "'))");
                        row.parentNode.removeChild(row);
                    } else {
                        console.error("Error claiming item: " + response.message);
                    }
                }
            };
        }
    </script>
</body>
</html>
