<?php
// Start the session and clear the user ID
session_start();
unset($_SESSION['user_id']);

// Redirect the user to the login page
header('Location: login.php');
exit;
?>