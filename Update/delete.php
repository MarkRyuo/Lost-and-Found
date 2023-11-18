<?php
// database.php file containing database connection
require_once("database.php");

// Check if the ID is provided via GET request
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $itemId = $_GET['id'];

    // Fetch the item details before deletion
    $selectSql = "SELECT * FROM items WHERE ItemID = $itemId";
    $result = $conn->query($selectSql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Insert the item into deleted_items table
        $insertSql = "INSERT INTO deleted_items (ItemID, ItemName, FoundDate) 
                      VALUES ('$itemId', '{$row['ItemName']}', '{$row['FoundDate']}', 'User deleted')";

        if ($conn->query($insertSql) === TRUE) {
            // Proceed with the deletion from the items table
            $deleteSql = "DELETE FROM items WHERE ItemID = $itemId";

            if ($conn->query($deleteSql) === TRUE) {
                // Return a success response (HTTP status 200 OK)
                http_response_code(200);
                echo "Item deleted successfully";
            } else {
                // Return an error response (HTTP status 500 Internal Server Error)
                http_response_code(500);
                echo "Error deleting item: " . $conn->error;
            }
        } else {
            // Return an error response (HTTP status 500 Internal Server Error)
            http_response_code(500);
            echo "Error inserting into deleted_items: " . $conn->error;
        }
    } else {
        // Return an error response (HTTP status 404 Not Found)
        http_response_code(404);
        echo "Item not found";
    }
} else {
    // Return a bad request response (HTTP status 400 Bad Request)
    http_response_code(400);
    echo "Invalid request";
}

// Close the database connection
$conn->close();
?>
