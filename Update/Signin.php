<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Security Signin/Security.css">
    <title>Security Signin | Lost and Found</title>
</head>
<body>
<?php
session_start();

// Perform your login authentication here
// Assuming you have validated the username and password from the form submission

// Replace these values with your actual database connection details
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

// Replace the following with your actual login authentication logic
$input_username = $conn->real_escape_string($_POST['username']);
$input_password = $conn->real_escape_string($_POST['password']);

$query = "SELECT * FROM security WHERE Username='$username' AND Password='$password'";
$result = $conn->query($query);

// Check for errors in the query execution
if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Login successful
    $row = $result->fetch_assoc();

    // Store username in a session variable
    $_SESSION['username'] = $row["Username"];

    // Redirect to the user profile page
    header("Location: user_profile.php");
} else {
    echo "Login failed";
}

// Close connection
$conn->close();
?>
    <div class="container">
        <section class="sec-form">

            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="Form-Signin">
                <h1>Signin</h1>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required><br>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br>

                <input type="submit" value="Login" class="sign-btn">
            </form>
        </section>
        <div class="blank">
        </div>
    </div>
</body>
</html>
