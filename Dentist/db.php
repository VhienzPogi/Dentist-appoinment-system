<?php
// Database Connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "urbansmiles_db";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
