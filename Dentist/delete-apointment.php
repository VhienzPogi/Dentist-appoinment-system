<?php
include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM appointments WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: admin.php");
exit();
?>
