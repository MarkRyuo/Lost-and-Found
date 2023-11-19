<?php
session_start();

// Check if the username session variable is set
if (isset($_SESSION['username'])) {
    // Retrieve the username from the session variable
    $username = $_SESSION['username'];
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login_page.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- ... your head section ... -->
</head>
<body>

  <!-- ... your existing HTML code ... -->

  <div class="input">
    <i class="fa-solid fa-user-shield"></i>
    <!-- Display the username in the input field -->
    <input type="text" placeholder="Username" value="<?php echo $username; ?>" readonly>
  </div>

  <!-- ... the rest of your HTML code ... -->

</body>
</html>
