<?php
    //Adding the header file
    require_once 'header.html';
    // Start session
    session_start();

    // Check if user is already logged in
    if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
    }

    // Check if the registration form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to MySQL database
    require_once 'db_connect.php';

    // Get form input values
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate form data
    if ($password != $confirm_password) {
        echo "Error: Passwords do not match";
        exit();
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "Error: Email address is already registered";
        exit();
    }

    // Insert user data into database
    $sql = "INSERT INTO users (firstname, lastname, username, email, password) VALUES ('$firstname','$lastname','$username', '$email', '$hashed_password')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to login page
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>

  <title>User Registration</title>

  <h1>User Registration</h1>
  <form method="post" action="register.php">
    <label for="firstname">Firstname:</label>
    <input type="text" name="firstname" required><br><br>

    <label for="lastname">Lastname:</label>
    <input type="text" name="lastname" required><br><br>
    
    <label for="username">Username:</label>
    <input type="text" name="username" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>
    
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required><br><br>
    
    <input type="submit" value="Register">
  </form>
</body>
</html>
