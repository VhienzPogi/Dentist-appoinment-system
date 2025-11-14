<?php
// === ERROR REPORTING (for debugging) ===
error_reporting(E_ALL);
ini_set('display_errors', 1);

// === CONFIGURATION ===
$recipient = "support@urbansmiles.com.ph";  // Replace with your clinic’s email
$subject   = "New Appointment Request - Urban Smiles";

// === DATABASE CONNECTION ===
$conn = new mysqli("127.0.0.1", "root", "", "urbansmiles_db");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// === GET & SANITIZE FORM DATA ===
$name    = trim($_POST['name'] ?? '');
$age     = intval($_POST['age'] ?? 0);
$email   = trim($_POST['email'] ?? '');
$contact = trim($_POST['contact'] ?? '');
$date    = trim($_POST['date'] ?? '');
$message = trim($_POST['message'] ?? '');

// === BASIC VALIDATION ===
if (!$name || !$email || !$contact || !$date) {
    die("Please fill in all required fields.");
}

// === SAVE TO DATABASE ===
$stmt = $conn->prepare("
    INSERT INTO appointments (name, age, email, contact, date, message)
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("sissss", $name, $age, $email, $contact, $date, $message);

if (!$stmt->execute()) {
    die("Database insert error: " . $stmt->error);
}

// === EMAIL CONTENT ===
$email_content = "New appointment request received:\n\n" .
                 "Name: $name\n" .
                 "Age: $age\n" .
                 "Email: $email\n" .
                 "Contact: $contact\n" .
                 "Preferred Date: $date\n\n" .
                 "Message / Concern:\n$message\n";

// === EMAIL HEADERS ===
$headers  = "From: Urban Smiles Clinic <no-reply@urbansmiles.com.ph>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// === DISABLE mail() FOR LOCAL TESTING ===
// $mail_sent = mail($recipient, $subject, $email_content, $headers);
$mail_sent = true; // Simulate successful email for localhost

// === CLOSE CONNECTIONS ===
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Appointment Request Sent | Urban Smiles Dental Clinic</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      text-align: center;
      font-family: Arial, sans-serif;
      padding: 80px 20px;
    }
    a.button {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background: #d4af37;
      color: #fff;
      border-radius: 6px;
      text-decoration: none;
    }
    img {
      width: 120px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <img src="Logo.jpeg" alt="Urban Smiles Logo">
  
  <?php if ($mail_sent): ?>
    <h2>✅ Appointment Request Sent!</h2>
    <p>Thank you, <strong><?= htmlspecialchars($name) ?></strong>. Our Patient Support Team will contact you soon to confirm your booking.</p>
  <?php else: ?>
    <h2>📬 Appointment Saved!</h2>
    <p>Your request has been saved successfully. However, the email could not be sent right now. Don’t worry — our team will still reach out soon.</p>
  <?php endif; ?>

  <a href="index.html" class="button">Return to Homepage</a>
</body>
</html>
