<?php
// delete_item.php

// Check if the item ID is provided
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    // Include the database connection
    require_once("database.php");

    // Fetch the item details before deletion
    $selectSql = "SELECT * FROM items WHERE ItemID = ?";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bind_param("i", $itemId);
    $selectStmt->execute();
    $selectedItem = $selectStmt->get_result()->fetch_assoc();
    $selectStmt->close();

    // Insert the deleted item into another table or log file
    $insertSql = "INSERT INTO deleted_items (ItemID, ItemName, FoundDate) VALUES (?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("iss", $selectedItem['ItemID'], $selectedItem['ItemName'], $selectedItem['FoundDate']);
    $insertStmt->execute();
    $insertStmt->close();

    // Delete the item from the original table
    $deleteSql = "DELETE FROM items WHERE ItemID = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $itemId);
    $deleteStmt->execute();
    $deleteStmt->close();

    // Close the database connection
    $conn->close();

    // Send a response (you can customize this based on your needs)
    echo "Item deleted successfully!";
} else {
    // If item ID is not provided in the request
    echo "Item ID not provided.";
}
?>
