<?php
$host = "localhost"; // Change if using a remote server
$user = "root"; // Your MySQL username
$pass = ""; // Your MySQL password
$dbname = "maize_management"; // Database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>