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
// mysqli_close($conn);
?>

<!-- HTML landing page -->
<h1>Welcome, <?php echo $user['username']; ?>!</h1>
<p>Your email address is: <?php echo $user['email']; ?></p>
<p><a href="logout.php">Log out</a></p>

<?php
  // Connect to MySQL database
  // require_once 'assets/db_connect.php';

  // fetch all stories from database
  $stmt = $conn->prepare("SELECT * FROM stories ORDER BY created_at DESC");
  $stmt->execute();
  $result = $stmt->get_result();
  $stories = $result->fetch_all(MYSQLI_ASSOC);
?>

<h1>Latest Stories</h1>
	<div>
		<?php foreach ($stories as $story): ?>
			<div>
				<h2><?php echo $story['title']; ?></h2>
				<p>By <?php echo $story['author']; ?></p>
				<?php if ($story['image']): ?>
					<img src="<?php echo $story['image']; ?>" alt="Story Image">
				<?php endif; ?>
				<p><?php echo substr($story['content'], 0, 200); ?>...</p>
				<p><a href="story.php?id=<?php echo $story['id']; ?>">Read more</a></p>
			</div>
		<?php endforeach; ?>
	</div>