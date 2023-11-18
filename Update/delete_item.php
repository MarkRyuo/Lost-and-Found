<?php
// database.php file containing database connection
require_once("database.php");

// Check if the ID is provided via GET request
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $itemId = $_GET['id'];

    // SQL query to delete the item from the database
    $sql = "DELETE FROM items WHERE ItemID = $itemId"; // Replace 'items' with your actual table name

    // Execute the delete query
    if ($conn->query($sql) === TRUE) {
        // Return a success response (HTTP status 200 OK)
        http_response_code(200);
        echo "Item deleted successfully";
    } else {
        // Return an error response (HTTP status 500 Internal Server Error)
        http_response_code(500);
        echo "Error deleting item: " . $conn->error;
    }
} else {
    // Return a bad request response (HTTP status 400 Bad Request)
    http_response_code(400);
    echo "Invalid request";
}

$sqlRenumber = "SET @count = 0;
                UPDATE items SET ItemID = @count:= @count + 1;
                ALTER TABLE items AUTO_INCREMENT = 1;";
if ($conn->multi_query($sqlRenumber)) {
    do {
        // Ensure all results are fetched
    } while ($conn->more_results() && $conn->next_result());
} else {
    echo "Error renumbering ItemIDs: " . $conn->error;
}

// Close the database connection
$conn->close();
?>