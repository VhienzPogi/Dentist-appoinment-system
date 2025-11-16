<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Appointment | Urban Smiles Dental Clinic</title>
  <link rel="stylesheet" href="style.css" />
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
      <a href="locations.html" >Locations</a>
      <a href="contact.html">Contact Us</a>
      <a href="index.php" class="active">Appointment</a>
      <a href="schedule.html">Schedule</a>
    </nav>
    <div class="contact-number">
      <span>📞 0917 303 8424</span>
    </div>
  </header>

  <!-- HERO SECTION / BACKGROUND -->
  <section class="hero">
    <div class="overlay"></div>

    <!-- APPOINTMENT FORM -->
    <div class="form-container">
      <div class="form-header">
        <img src="logo-gold.jpg" alt="Urban Smiles Gold Logo" class="form-logo" />
        <h2>Appointment Request Form</h2>
        <p>
          Please be informed that this is not yet a confirmed booking.
          Our Patient Support Team will contact you to confirm your appointment.
          Thank you.
        </p>
      </div>

      <form action="submit.php" method="POST" class="appointment-form" id="appointmentForm">
        <label for="name">Name *</label>
        <input type="text" id="name" name="name" required maxlength="255" />

        <label for="age">Age *</label>
        <input type="number" id="age" name="age" required />

        <label for="email">Email *</label>
        <input type="email" id="email" name="email" required />

        <label for="contact">Contact Number *</label>
        <input type="tel" id="contact" name="contact" required pattern="[0-9]{11}" placeholder="09171234567" />

        <label for="date">Preferred Date *</label>
        <input type="date" id="date" name="date" required />

        <label for="message">Message / Concern</label>
        <textarea id="message" name="message" rows="4" placeholder="Describe your concern..."></textarea>

        <button type="submit">Submit Request</button>
      </form>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <p>&copy; 2025 Urban Smiles Dental Clinic. All rights reserved.</p>
  </footer>

  <!-- JAVASCRIPT -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const form = document.getElementById("appointmentForm");
      const dateInput = document.getElementById("date");

      // Disable past dates
      const today = new Date().toISOString().split("T")[0];
      dateInput.min = today;

      // Validate form before submission
      form.addEventListener("submit", (e) => {
        const name = form.name.value.trim();
        const age = form.age.value.trim();
        const email = form.email.value.trim();
        const contact = form.contact.value.trim();
        const date = form.date.value.trim();

        if (!name || !age || !email || !contact || !date) {
          e.preventDefault();
          alert("⚠️ Please fill in all required fields before submitting.");
          return;
        }

        // Basic email check
        const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!email.match(emailPattern)) {
          e.preventDefault();
          alert("⚠️ Please enter a valid email address.");
          return;
        }

        // Contact number validation (11 digits)
        if (!/^[0-9]{11}$/.test(contact)) {
          e.preventDefault();
          alert("⚠️ Please enter a valid 11-digit contact number (e.g., 09171234567).");
          return;
        }

        // Optional: show a brief loading state
        alert("✅ Your appointment request is being submitted...");
      });

      // Fade-in effect for the form
      const formContainer = document.querySelector(".form-container");
      formContainer.style.opacity = 0;
      formContainer.style.transition = "opacity 1s ease";
      setTimeout(() => {
        formContainer.style.opacity = 1;
      }, 200);
    });
  </script>
</body>
</html>
