<?php
// Replace these variables with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lostandfound";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect user input
    $itemName = $_POST["item_name"];
    $foundDate = $_POST["found_date"];  

    // Insert the new item into the Items table
    $sql = "INSERT INTO Items (ItemName, FoundDate)
            VALUES ('$itemName', '$foundDate')";

    if ($conn->query($sql) === TRUE) {
        echo "Item reported successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Missing Item</title>
</head>
<body>

<h2>Report Missing Item</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Item Name: <input type="text" name="item_name" required><br>
    Description: <textarea name="description" required></textarea><br>
    Category: <input type="text" name="category" required><br>
    Found Location: <input type="text" name="found_location" required><br>
    Found Date: <input type="date" name="found_date" required><br>
    <!-- You might want to use a session variable or other means to get the user's ID -->
    Owner ID: <input type="text" name="owner_id" required><br>
    <input type="submit" value="Report Item">
</form>

</body>
</html>
