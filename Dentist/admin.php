<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM appointments ORDER BY date ASC, id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard | Urban Smiles</title>
<link rel="stylesheet" href="style.css">
<style>
body { background:#f2f2f2; font-family:Arial; }

.admin-header {
    background:#222; color:white; padding:20px 40px;
    font-size:26px; font-weight:bold; position:sticky; top:0; z-index:1000;
}

.admin-container {
    width:95%; margin:30px auto;
    background:white; padding:20px; border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

.admin-table { width:100%; border-collapse:collapse; min-width:1100px; }
.admin-table th { background:#f47c30; color:white; padding:12px; text-align:left; }
.admin-table td { padding:12px; border-bottom:1px solid #ddd; }

.status { padding:6px 10px; border-radius:6px; font-size:14px; }
.pending { background:#ffe9b3; color:#8a5a00; }
.approved { background:#c9ffcb; color:#0c6e00; }
.cancelled { background:#ffd0d0; color:#9e0000; }

.admin-btn { padding:8px 12px; color:white; border-radius:6px; text-decoration:none; }
.approve-btn { background:#28a745; }
.cancel-btn { background:#dc3545; }
.delete-btn { background:#444; }
</style>
</head>
<body>

<div class="admin-header">Urban Smiles | Admin Dashboard</div>

<div class="admin-container">
<h1>Appointment Management</h1>

<div style="overflow-x:auto;">
<table class="admin-table">
<tr>
  <th>Name</th>
  <th>Age</th>
  <th>Email</th>
  <th>Contact</th>
  <th>Date</th>
  <th>Message</th>
  <th>Status</th>
  <th>Actions</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
  <td><?= htmlspecialchars($row['name']) ?></td>
  <td><?= $row['age'] ?></td>
  <td><?= $row['email'] ?></td>
  <td><?= $row['contact'] ?></td>
  <td><?= $row['date'] ?></td>
  <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>

  <td><span class="status <?= $row['status'] ?>"><?= $row['status'] ?></span></td>

  <td>
    <a class="admin-btn approve-btn" 
       href="update-status.php?id=<?= $row['id'] ?>&status=approved">Approve</a>

    <a class="admin-btn cancel-btn"
       href="update-status.php?id=<?= $row['id'] ?>&status=cancelled">Cancel</a>

    <a class="admin-btn delete-btn"
       href="delete-appointment.php?id=<?= $row['id'] ?>"
       onclick="return confirm('Delete this appointment?');">Delete</a>
  </td>
</tr>
<?php } ?>
</table>
</div>
</div>

</body>
</html>
