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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/x-icon" href="/assets/Images/Batstatelogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/Aside-Nav/Aside.css">
    <link rel="stylesheet" href="/ReportMissing/Reportmissing.css">
    <!-- btn Logout Connection -->
    <link rel="stylesheet" href="/assets/css/btn-LogoutView.css">
    <!-- btn save connection -->
    <link rel="stylesheet" href="/assets/css/btn-save.css">
    <!-- Add CSS for success message -->
    <title>Report Missing Item | Lost and Found</title>
</head>
<body>

<form method="post" class="report-section" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Item Name: <input type="text" name="item_name" required><br>
    Found Date: <input type="date" name="found_date" required><br>
  
    <input type="submit" value="Report Item">
</form>

</body>
</html>
