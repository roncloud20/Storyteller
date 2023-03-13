<?php
    //Adding the header file
    $title = "User Login";
    require_once 'assets/header.php'; 
?>
<?php
    // Start the session and check if the user is already logged in
    session_start();
    if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
    }

       // Connect to MySQL database
       require_once 'assets/db_connect.php';

    // Check if the login form was submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email and password are valid
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
        // Login successful, save the user ID in the session
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit;
        }
    }

    // Login failed, show an error message
    $error = 'Invalid email or password.';
    }

    // Close the database connection
    mysqli_close($conn);
?>

<!-- HTML login form -->
<h1>Login</h1>
<?php if (isset($error)) { ?>
<p><?php echo $error; ?></p>
<?php } ?>
<form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required>
    <br>
    <label>Password:</label>
    <input type="password" name="password" required>
    <br>
    <button type="submit">Log in</button>
</form>