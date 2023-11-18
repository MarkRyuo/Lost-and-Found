<?php
require_once("database.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect user input
    $itemName = $_POST["item_name"];
    $foundDate = $_POST["found_date"];

    // Insert the new item into the Items table
    $sql = "INSERT INTO items (ItemName, FoundDate)
            VALUES ('$itemName', '$foundDate')";

    if ($conn->query($sql) === TRUE) {
        $response = array("status" => "success", "message" => "Item reported successfully!");
    } else {
        $response = array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error);
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);

    // Close the database connection
    $conn->close();
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- ... (head section remains unchanged) ... -->
<body>

<form method="post" class="report-section" id="reportForm">
    Item Name: <input type="text" name="item_name" required><br>
    Found Date: <input type="date" name="found_date" required><br>

    <input type="button" value="Report Item" onclick="reportItem()">
</form>

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function reportItem() {
        // Use AJAX to submit the form data
        $.ajax({
            type: "POST",
            url: "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>",
            data: $("#reportForm").serialize(),
            success: function (response) {
                if (response.status === "success") {
                    alert(response.message);
                    // You can add further actions here if needed
                } else {
                    alert(response.message);
                }
            }
        });
    }
</script>

</body>
</html>
