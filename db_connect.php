<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "storyteller";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
?>

