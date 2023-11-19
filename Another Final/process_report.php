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

// Process the claim request
$itemId = $_GET['id'];
$dateClaimed = date('Y-m-d');

// Update the database to mark the item as claimed
$sql = "UPDATE lost_items SET date_claimed = '$dateClaimed' WHERE id = $itemId";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
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

