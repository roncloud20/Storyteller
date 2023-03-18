<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo "<title>" .$title ."</title>" ?>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>Logo</h1>
        <div class="searchBar">
            <input type="search"/> |
            <img src="assets/searchbar.png" alt="search" height="20px"/>            
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="create_story.php">Create Story</a></li>
                <?php
                // // Check if user is already logged in
                if (isset($_SESSION["user_id"])) {
                    echo("<li><a href='#'>Create Story</a></li>");
                    exit;
                }
            
                ?>
                <li><a href="#">About Us</a></li>
                <li><a href="register.php">Sign In/Up</a></li>
            </ul>
        </nav>
    </header>