<?php
include 'db.php';

// Get all approved appointments from database
$result = mysqli_query($conn, "SELECT * FROM appointments WHERE status='approved' ORDER BY date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Schedule | Urban Smiles Dental Clinic</title>
  <link rel="stylesheet" href="style.css" />

  <style>
    .schedule-banner {
      background: #f47c30;
      color: white;
      text-align: center;
      padding: 40px 10px;
      font-size: 28px;
      font-weight: bold;
      margin-top: 80px;
    }

    .schedule-container {
      width: 90%;
      max-width: 1100px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .schedule-container h2 {
      font-size: 28px;
      color: #f47c30;
      margin-bottom: 10px;
    }

    .schedule-description {
      margin-bottom: 20px;
      color: #555;
    }

    .schedule-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    .schedule-table th {
      background: #f47c30;
      color: white;
      padding: 12px;
      font-size: 16px;
    }

    .schedule-table td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      font-size: 15px;
    }

    .schedule-fade {
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.8s ease;
    }

    .schedule-fade.show {
      opacity: 1;
      transform: translateY(0);
    }

    #scrollTopBtn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      padding: 12px 15px;
      background: #f47c30;
      color: white;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      font-size: 18px;
      display: none;
    }

    .schedule-filters input {
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
  </style>
</head>

<body>

  <!-- HEADER -->
  <header class="header">
    <div class="logo">
      <img src="Logo.jpeg" alt="Urban Smiles Logo" />
    </div>

    <nav class="nav">
      <a href="about.html">About</a>
      <a href="services.html">Services</a>
      <a href="clients.html">Clients</a>
      <a href="locations.html">Locations</a>
      <a href="contact.html">Contact Us</a>
      <a href="index.php">Appointment</a>
      <a href="schedule.php" class="active">Schedule</a>
    </nav>

    <div class="contact-number">
      <span>📞 0917 303 8424</span>
    </div>
  </header>

  <!-- BANNER -->
  <div class="schedule-banner">
    Dental Clinic Appointment Schedule
  </div>

  <!-- MAIN CONTENT -->
  <div class="schedule-container schedule-fade">

    <h2>Schedule</h2>

    <p><strong>Prepared By:</strong> <span>Urban Smiles Admin</span></p>

    <p class="schedule-description">
      The schedule below shows all APPROVED appointments from the admin dashboard.
    </p>

    <!-- FILTERS -->
    <div class="schedule-filters" style="margin-bottom: 20px; display:flex; gap:10px;">
      <input type="text" id="searchAppointments" placeholder="🔍 Search..." />
      <input type="date" id="filterDate" />
    </div>

    <p><strong>Total Approved Appointments:</strong> 
      <span id="appointmentCount" style="color:#f47c30; font-weight:bold;"></span>
    </p>

    <!-- TABLE -->
    <table class="schedule-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Name</th>
          <th>Age</th>
          <th>Contact</th>
          <th>Message</th>
        </tr>
      </thead>

      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= htmlspecialchars($row['date']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['age']) ?></td>
            <td><?= htmlspecialchars($row['contact']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>

  <!-- SCROLL TO TOP BUTTON -->
  <button id="scrollTopBtn">↑</button>

  <!-- JAVASCRIPT -->
  <script>
    // Highlight active link
    document.querySelectorAll(".nav a").forEach(link => {
      if (link.href === window.location.href) link.classList.add("active");
    });

    // Fade-in animation
    const scheduleFade = document.querySelector(".schedule-fade");
    const fadeObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show");
        }
      });
    }, { threshold: 0.2 });
    fadeObserver.observe(scheduleFade);

    // Hover effect
    document.querySelectorAll(".schedule-table tbody tr").forEach(row => {
      row.addEventListener("mouseenter", () => row.style.backgroundColor = "#eef7ff");
      row.addEventListener("mouseleave", () => row.style.backgroundColor = "");
    });

    // LIVE SEARCH FILTER
    const searchInput = document.getElementById("searchAppointments");
    searchInput.addEventListener("keyup", () => {
      const filter = searchInput.value.toLowerCase();
      const rows = document.querySelectorAll(".schedule-table tbody tr");
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
      });
    });

    // DATE FILTER
    const dateFilter = document.getElementById("filterDate");
    dateFilter.addEventListener("change", () => {
      const filterDate = dateFilter.value;
      const rows = document.querySelectorAll(".schedule-table tbody tr");

      rows.forEach(row => {
        const rowDate = row.children[0].textContent.trim();
        row.style.display = (filterDate === "" || rowDate === filterDate) ? "" : "none";
      });
    });

    // COUNT APPOINTMENTS
    const rows = document.querySelectorAll(".schedule-table tbody tr");
    document.getElementById("appointmentCount").textContent = rows.length;

    // Scroll to top button
    const scrollTopBtn = document.getElementById("scrollTopBtn");
    window.addEventListener("scroll", () => {
      scrollTopBtn.style.display = window.scrollY > 200 ? "block" : "none";
    });
    scrollTopBtn.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  </script>

</body>
</html>
