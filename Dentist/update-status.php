<?php
include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID");
}

$id = intval($_GET['id']);
$allowed = ["approved", "cancelled"];

if (!isset($_GET['status']) || !in_array($_GET['status'], $allowed)) {
    die("Invalid status");
}

$status = $_GET['status'];

$stmt = $conn->prepare("UPDATE appointments SET status=? WHERE id=?");
$stmt->bind_param("si", $status, $id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: admin.php");
exit();
?>
