<link rel="stylesheet" href="assets/style.css"/>    
<?php 
    $title = "Storytelling Company";
    require_once "assets/header.php";
?>

<h1>Hello World</h1>

<?php
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

   // Connect to MySQL database
   require_once 'assets/db_connect.php';

// Get the user's details from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);
?>

<!-- HTML landing page -->
<h1>Welcome, <?php echo $user['username']; ?>!</h1>
<p>Your email address is: <?php echo $user['email']; ?></p>
<p><a href="logout.php">Log out</a></p>

