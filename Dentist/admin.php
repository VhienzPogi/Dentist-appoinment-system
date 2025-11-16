<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM appointments ORDER BY date, id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard | Urban Smiles</title>
  <link rel="stylesheet" href="style.css">

  <style>
    /* Remove public navigation styling */
    body { background: #f2f2f2; }

    .admin-header {
      width: 100%;
      background: #222;
      color: #fff;
      padding: 18px 40px;
      font-size: 24px;
      font-weight: bold;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .admin-container { 
      width: 95%; 
      margin: 30px auto; 
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      overflow-x: auto; /* Makes admin page scrollable horizontally */
    }

    .admin-container h1 { 
      font-size: 28px; 
      margin-bottom: 20px; 
      color: #f47c30;
    }

    .admin-table { 
      width: 1200px; /* allows scrolling */
      border-collapse: collapse; 
    }

    .admin-table th { 
      background: #f47c30; 
      color: white; 
      padding: 12px; 
      text-align: left;
    }

    .admin-table td { 
      padding: 12px; 
      border-bottom: 1px solid #ddd; 
      background: #fff;
    }

    .status { 
      padding: 6px 10px; 
      border-radius: 6px; 
      font-size: 14px; 
      font-weight: 600; 
      display: inline-block;
      text-transform: capitalize;
    }

    .pending { background: #ffe9b3; color: #8a5a00; }
    .approved { background: #c9ffcb; color: #0c6e00; }
    .cancelled { background: #ffd0d0; color: #9e0000; }

    .admin-btn { 
      padding: 8px 12px; 
      color: white; 
      text-decoration: none; 
      border-radius: 6px; 
      margin-right: 5px; 
      display: inline-block;
    }

    .approve-btn { background: #28a745; }
    .cancel-btn { background: #dc3545; }
    .delete-btn { background: #444; }
  </style>
</head>
<body>

<!-- CLEAN ADMIN HEADER -->
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
        <td><?= htmlspecialchars($row['age']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['contact']) ?></td>
        <td><?= htmlspecialchars($row['date']) ?></td>
        <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>

        <!-- FIXED STATUS WARNING -->
        <td>
          <span class="status <?= $row['status'] ?: 'pending' ?>">
            <?= $row['status'] ?: 'pending' ?>
          </span>
        </td>

        <td>
          <a href="update-status.php?id=<?= $row['id'] ?>&status=approved" class="admin-btn approve-btn">Approve</a>
          <a href="update-status.php?id=<?= $row['id'] ?>&status=cancelled" class="admin-btn cancel-btn">Cancel</a>
          <a href="delete-appointment.php?id=<?= $row['id'] ?>" class="admin-btn delete-btn">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>
  </div>

</div>

</body>
</html>
