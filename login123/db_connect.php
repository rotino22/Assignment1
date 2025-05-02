<?php
$server = "localhost";
$user = "root";
$pass = "";
$dbname = "login_db";

// Connect to database
$conn = new mysqli($server, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
