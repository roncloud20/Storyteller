<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<h1>Create Story</h1>
<form action="create_story.php" method="post" enctype="multipart/form-data">

  <label for="title">Title:</label>
  <input type="text" id="title" name="title"><br><br>

  <label for="author">Author:</label>
  <input type="text" id="author" name="author"><br><br>

  <label for="category">Category:</label>
  <input type="text" id="category" name="category"><br><br>

  <label for="content">Content:</label><br>
  <div id="editor"></div>
  <input type="hidden" id="content" name="content"><br>

  <label for="image">Image:</label>
  <input type="file" id="image" name="image"><br><br>

  <input type="submit" value="Create Story">

</form>

<script>
  // initialize WYSIWYG editor
  var quill = new Quill('#editor', {
    theme: 'snow'
  });
  // when form is submitted, set hidden input to HTML content of editor
  var form = document.querySelector('form');
  form.onsubmit = function() {
    var content = document.querySelector('input[name=content]');
    content.value = quill.root.innerHTML;
  };
</script>
<?php
  $title = "Create Story";
  require_once 'assets/header.php'; 

  // Start the session and check if the user is logged in
  session_start();
  if (!isset($_SESSION['user_id'])) {
      header('Location: login.php');
      exit;
  }

  // Connect to MySQL database
  require_once 'assets/db_connect.php';

  // get form data
  $title = $_POST['title'];
  $author = $_POST['author'];
  $category = $_POST['category'];
  $content_html = $_POST['content'];
  $published_at = date('Y-m-d H:i:s');
  $image = $_FILES['image'];

  // handle image upload
  if ($image['size'] > 0) {
      $image_path = 'images/' . $image['name'];
      move_uploaded_file($image['tmp_name'], $image_path);
  } else {
      $image_path = null;
  }

  // insert story into database
  $stmt = $conn->prepare("INSERT INTO stories (title, author, category, content_html, image, published_at) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $title, $author, $category, $content_html, $image_path, $published_at);
  $stmt->execute();

  // redirect to homepage
  header('Location: index.php');
  exit();
?>
