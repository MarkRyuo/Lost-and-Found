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

// Process the form data
$item_number = $_POST['item_number'];
$item_name = $_POST['item_name'];
$date_found = $_POST['date_found'];

// Insert data into the database
$sql = "INSERT INTO lost_items (item_number, item_name, date_found) VALUES ('$item_number', '$item_name', '$date_found')";

if ($conn->query($sql) === TRUE) {
    echo "Item reported successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<script>
    function claimItem(itemId) {
        // Use JavaScript to send a request to the server to mark the item as claimed
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "process_claim.php?id=" + itemId, true);
        xhr.send();

        // Remove the row from the table
        var row = document.querySelector("tr:has(td:contains('" + itemId + "'))");
        row.parentNode.removeChild(row);

        // Reload the View Lost page after a brief delay
        setTimeout(function() {
            location.reload();
        }, 1000);
    }
</script>

