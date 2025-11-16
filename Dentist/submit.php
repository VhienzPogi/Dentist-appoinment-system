<?php
include 'db.php';

// Get and sanitize input
$name    = trim($_POST['name'] ?? '');
$age     = intval($_POST['age'] ?? 0);
$email   = trim($_POST['email'] ?? '');
contact  = trim($_POST['contact'] ?? '');
$date    = trim($_POST['date'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate required fields
if (!$name || !$email || !$contact || !$date) {
    die("Missing required fields.");
}

// Insert into database using prepared statement
$stmt = $conn->prepare("
    INSERT INTO appointments (name, age, email, contact, date, message, status)
    VALUES (?, ?, ?, ?, ?, ?, 'pending')
");
$stmt->bind_param("sissss", $name, $age, $email, $contact, $date, $message);
$stmt->execute();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Appointment Submitted</title>
<link rel="stylesheet" href="style.css">
<style>
body { text-align:center; padding:60px; font-family:Arial; }
a.button { padding:10px 20px; background:#f47c30; color:white; text-decoration:none; border-radius:6px; }
</style>
</head>
<body>
    <h2>✅ Appointment Request Sent!</h2>
    <p>Thank you <strong><?= htmlspecialchars($name) ?></strong>. Our team will contact you soon.</p>
    <a href="index.php" class="button">Back to Appointment Page</a>
</body>
</html>
