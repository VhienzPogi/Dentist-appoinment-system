<?php
include 'db.php';

$id = $_GET['id'];
$status = $_GET['status'];

$query = "UPDATE appointments SET status='$status' WHERE id=$id";
mysqli_query($conn, $query);

header("Location: admin.php");
exit();
?>
