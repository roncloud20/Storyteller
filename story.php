<?php
    //Adding the header file
    $title = "User Registration";
    require_once 'assets/header.php'; 

    // Connect to MySQL database
    require_once 'assets/db_connect.php';

    // get story id from URL parameter
    $id = $_GET['id'];

    // fetch story from database
    $stmt = $conn->prepare("SELECT * FROM stories WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $story = $result->fetch_assoc();

    //Adding the header file
    $title = "User Registration";
    require_once 'assets/header.php'; 


    // check if story exists
    if (!$story) {
        echo "Story not found";
        exit();
    }
    
    
?>
<title><?php echo $story['title']; ?></title>
<h1><?php echo $story['title']; ?></h1>
<p>By <?php echo $story['author']; ?></p>
<p>Category: <?php echo $story['category']; ?></p>
<?php if ($story['image']): ?>
    <img src="<?php echo $story['image']; ?>" alt="Story Image">
<?php endif; ?>
<p><?php echo $story['content_html']; ?></p>
<p>Published on <?php echo $story['published_at']; ?></p>