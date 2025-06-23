<?php
// PHP backend code for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["name"] ?? '');
  $email = trim($_POST["email"] ?? '');
  $description = trim($_POST["message"] ?? '');

  if ($name && $email && $description) {
    $servername = "localhost";
    $username = "root";        // Change as per your setup
    $password = "";            // Change as per your setup
    $dbname = "icecreamshop";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO customer (name, email, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $description);

    if ($stmt->execute()) {
      echo "<script>alert('Message sent successfully!');</script>";
    } else {
      echo "<script>alert('Failed to send message. Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
  } else {
    echo "<script>alert('Please fill in all fields.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sweet Scoop - Contact Us</title>

  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&family=Quicksand:wght@700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Comfortaa:wght@700&display=swap" rel="stylesheet" />

  <style>
    /* Navigation Styles */
    :root {
      --blue: #2a6fdb;
      --mint: #a2f5dc;
      --violet: #b5b8ff;
      --text: #1a1a1a;
      --glass: rgba(255, 255, 255, 0.3);
      --border: rgba(255, 255, 255, 0.2);
      --glow-blue: rgba(42, 111, 219, 0.7);
      --glow-mint: rgba(162, 245, 220, 0.5);
      --glow-violet: rgba(181, 184, 255, 0.5);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Comfortaa', cursive; /* Default font from navigation */
      background: linear-gradient(to right top, #e7f5ff, #eef8ff); /* Background from navigation */
      min-height: 100vh;
      overflow-x: hidden;
      display: flex; /* For overall layout */
      flex-direction: column; /* For overall layout */
    }

    @keyframes glowPulse {
      0%, 100% {
        box-shadow: 0 0 10px var(--glow-blue), 0 0 20px var(--glow-mint), 0 0 30px var(--glow-violet);
      }
      50% {
        box-shadow: 0 0 20px var(--glow-blue), 0 0 40px var(--glow-mint), 0 0 60px var(--glow-violet);
      }
    }

    nav {
      backdrop-filter: blur(12px);
      background: var(--glass);
      border: 1px solid var(--border);
      border-radius: 30px;
      margin: 2rem auto;
      padding: 1.5rem 3rem;
      max-width: 1200px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      transition: all 0.5s ease;
      animation: glowPulse 3s ease-in-out infinite;
      z-index: 1000;
      white-space: nowrap; /* Prevent wrapping */
    }

    nav.scrolled .logo {
      transform: scale(0.9);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 20px;
      transition: transform 0.3s ease;
      flex-shrink: 0;
    }

    .logo img {
      width: 100px;
      height: 100px;
      border-radius: 15px; /* rounded corners */
      object-fit: cover;
      box-shadow: 0 0 18px var(--blue);
      filter: drop-shadow(0 0 6px var(--blue));
      user-select: none;
      transition: filter 0.3s ease, box-shadow 0.3s ease;
    }

    .logo img:hover {
      filter: drop-shadow(0 0 14px var(--glow-mint));
      box-shadow: 0 0 25px var(--glow-blue);
    }

    .logo-text {
      font-family: 'Quicksand', sans-serif;
      font-size: 3rem;
      color: var(--blue);
      font-weight: 700;
      letter-spacing: 1px;
      opacity: 0;
      transform: translateY(-10px);
      animation: fadeInSlide 1.2s ease-in-out forwards;
      text-shadow: 0 0 5px var(--glow-blue), 0 0 10px var(--glow-mint), 0 0 15px var(--glow-violet);
      white-space: nowrap;
      user-select: none;
      /* Add margin-right to create space */
      margin-right: 40px; /* Adjust this value as needed */
    }

    @keyframes fadeInSlide {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .nav-links {
      display: flex;
      gap: 2.5rem;
      align-items: center;
      font-weight: 600;
      user-select: none;
    }

    .nav-links a {
      text-decoration: none;
      font-size: 1.4rem;
      color: var(--text);
      position: relative;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .nav-links a::before {
      content: "";
      position: absolute;
      width: 0%;
      height: 3px;
      left: 0;
      bottom: -6px;
      background: linear-gradient(to right, var(--mint), var(--blue), var(--violet));
      border-radius: 10px;
      transition: width 0.4s ease;
      box-shadow: 0 0 5px var(--glow-mint), 0 0 10px var(--glow-blue), 0 0 15px var(--glow-violet);
    }

    .nav-links a:hover::before {
      width: 100%;
    }

    .nav-links a:hover {
      color: var(--blue);
      transform: scale(1.08);
      text-shadow: 0 0 5px var(--glow-mint), 0 0 10px var(--glow-blue), 0 0 15px var(--glow-violet);
    }

    .admin-button {
      padding: 0.5rem 1.6rem;
      font-size: 1.2rem;
      font-weight: 700;
      border-radius: 25px;
      border: 2px solid var(--blue);
      background: var(--blue);
      color: white;
      text-decoration: none;
      backdrop-filter: blur(6px);
      box-shadow: 0 0 8px var(--glow-blue);
      transition: all 0.3s ease;
      white-space: nowrap;
      user-select: none;
    }

    .admin-button:hover {
      background: white;
      color: var(--blue);
      border-color: var(--blue);
      box-shadow: 0 0 12px var(--glow-blue), 0 0 24px var(--glow-mint);
      transform: scale(1.05);
    }

    .hamburger {
      display: none;
      font-size: 2.5rem;
      cursor: pointer;
      color: var(--blue);
      background: transparent;
      border: none;
      user-select: none;
      margin-left: 1rem;
      transition: filter 0.3s ease;
      z-index: 1100;
      flex-shrink: 0;
    }

    .hamburger:hover {
      filter: drop-shadow(0 0 12px var(--glow-mint));
    }

    /* Responsive Navigation */
    @media (max-width: 900px) {
      nav {
        padding: 1rem 2rem;
      }

      .logo img {
        width: 80px;
        height: 80px;
        border-radius: 12px;
      }

      .logo-text {
        font-size: 2.4rem;
        margin-right: 20px; /* Adjust for smaller screens */
      }

      .nav-links a {
        font-size: 1.2rem;
      }
    }

    @media (max-width: 650px) {
      .nav-links {
        display: none; /* Hide links initially */
        position: absolute;
        top: 100%;
        right: 1rem;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 1rem 2rem;
        box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        gap: 1.5rem;
        flex-direction: column;
        width: max-content;
        white-space: normal;
      }

      .nav-links.show {
        display: flex;
      }

      .nav-links a, .admin-button {
        font-size: 1.2rem;
        padding: 0.5rem 0;
        width: 100%;
        white-space: normal;
      }

      .hamburger {
        display: block;
      }
    }

    @media (max-width: 480px) {
      .logo img {
        width: 60px;
        height: 60px;
        border-radius: 10px;
      }

      .logo-text {
        font-size: 1.8rem;
        margin-right: 10px; /* Adjust for very small screens */
      }
    }

    /* Space between navigation and actual page code */
    .content-area {
      padding-top: 2rem; /* Adjust as needed for more space */
    }

    /* Contact Page Specific Styles */
    body {
      font-family: 'Poppins', sans-serif; /* Override for contact section */
      background: linear-gradient(135deg, #e7f5ff, #eef8ff); /* Keep consistent with nav body background or adjust */
      color: #222;
    }
    .contact-wrapper {
      background: #fff;
      border-radius: 20px;
      max-width: 900px;
      width: 100%;
      margin: 2rem auto;
      box-shadow: 0 15px 30px rgba(42, 111, 219, 0.3);
      overflow: hidden;
      display: flex;
      flex-wrap: wrap;
      animation: fadeInUp 1s ease forwards;
      opacity: 0;
      transform: translateY(30px);
    }
    .contact-info {
      flex: 1 1 320px;
      background: linear-gradient(135deg, #2a6fdb, #a2f5dc);
      color: #eef8ff;
      padding: 3rem 2rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .contact-info h2 {
      font-family: 'Comfortaa', cursive;
      font-weight: 700;
      font-size: 2.8rem;
      margin-bottom: 1rem;
      text-shadow: 0 0 10px rgba(255 255 255 / 0.6);
      user-select: none;
    }
    .contact-info p {
      font-weight: 500;
      font-size: 1.1rem;
      line-height: 1.6;
      margin-bottom: 2rem;
      opacity: 0.9;
      user-select: none;
      text-shadow: 0 0 6px rgba(0 0 0 / 0.1);
    }
    .info-item {
      margin-bottom: 1.4rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      font-size: 1.1rem;
      font-weight: 600;
      user-select: none;
    }
    .info-item svg {
      width: 24px;
      height: 24px;
      fill: #eef8ff;
      flex-shrink: 0;
      filter: drop-shadow(0 0 3px #a2f5dc);
      transition: transform 0.3s ease;
    }
    .info-item:hover svg {
      transform: scale(1.2);
      filter: drop-shadow(0 0 6px #2a6fdb);
    }
    .contact-form {
      flex: 1 1 480px;
      padding: 3rem 2.5rem;
      background: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .contact-form h3 {
      font-family: 'Comfortaa', cursive;
      font-weight: 700;
      font-size: 2rem;
      margin-bottom: 1.5rem;
      color: #2a6fdb;
      user-select: none;
      text-align: center;
    }
    form { width: 100%; }
    label {
      font-weight: 600;
      margin-bottom: 0.5rem;
      display: block;
      color: #222;
    }
    input[type="text"], input[type="email"], textarea {
      width: 100%;
      padding: 0.85rem 1.2rem;
      margin-bottom: 1.5rem;
      border: 2px solid #a2f5dc;
      border-radius: 12px;
      font-size: 1rem;
      font-family: 'Poppins', sans-serif;
      resize: vertical;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      outline-offset: 2px;
    }
    input[type="text"]:focus, input[type="email"]:focus, textarea:focus {
      border-color: #2a6fdb;
      box-shadow: 0 0 10px #2a6fdbaa;
      outline: none;
    }
    textarea { min-height: 140px; }
    button {
      background: #2a6fdb;
      color: #eef8ff;
      font-weight: 700;
      font-size: 1.2rem;
      padding: 0.9rem 0;
      width: 100%;
      border: none;
      border-radius: 14px;
      cursor: pointer;
      box-shadow: 0 6px 15px rgba(42, 111, 219, 0.5);
      user-select: none;
      transition: background 0.3s ease, box-shadow 0.3s ease;
    }
    button:hover {
      background: #1e53b3;
      box-shadow: 0 8px 25px rgba(30, 83, 179, 0.8);
    }
    @media (max-width: 800px) {
      .contact-wrapper {
        flex-direction: column;
      }
      .contact-info, .contact-form {
        flex: 1 1 100%;
        padding: 2.5rem 1.5rem;
      }
      .contact-info { text-align: center; }
    }
    @media (max-width: 480px) {
      body { padding: 1.5rem; } /* This might conflict with nav's margin auto - consider removing from body and applying to main content wrapper */
      .contact-info h2 { font-size: 2rem; }
      .contact-form h3 { font-size: 1.6rem; }
      input[type="text"], input[type="email"], textarea { font-size: 0.95rem; }
      button { font-size: 1rem; }
    }
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

  <nav id="navbar" role="navigation" aria-label="Primary Navigation">
    <div class="logo">
      <img src="images/WebsiteIcon.jpg" alt="Sweet Scoop Logo" />
      <div class="logo-text">Sweet Scoop</div>
    </div>

    <button class="hamburger" aria-label="Toggle menu" aria-expanded="false" aria-controls="navLinks" onclick="toggleMenu()">☰</button>

    <div class="nav-links" id="navLinks">
      <a href="index.php">Home</a>
      <a href="NewProductPage.php">Product</a>
      <a href="About_Us.php">About</a>
      <a href="Contact_Us.php">Contact</a>
      <a href="login.php" class="admin-button">Admin</a>
    </div>
  </nav>

  <div class="content-area">

    <div class="contact-wrapper" role="main" aria-label="Contact Sweet Scoop">
      <section class="contact-info" aria-labelledby="contact-info-title">
        <h2 id="contact-info-title">Get In Touch</h2>
        <p>We’d love to hear from you! Whether you have questions about our flavors, want to book an event, or just want to say hi, drop us a message below.</p>

        <div class="info-item">
          <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M21 8v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8m2-4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"/></svg>
          <span>info@sweetscoop.com</span>
        </div>

        <div class="info-item">
          <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M6.6 10.8a15.333 15.333 0 006.6 6.6l2.4-2.4a1.2 1.2 0 011.2-.3 10.2 10.2 0 003.1.5 1.2 1.2 0 011.2 1.2v3a1.2 1.2 0 01-1.2 1.2A18 18 0 013 6.6 1.2 1.2 0 014.2 5.4h3a1.2 1.2 0 011.2 1.2 10.2 10.2 0 00.5 3.1 1.2 1.2 0 01-.3 1.2z"/></svg>
          <span>+1 (234) 567-890</span>
        </div>
      </section>

      <section class="contact-form" aria-labelledby="contact-form-title">
        <h3 id="contact-form-title">Send Us a Message</h3>
        <form action="" method="POST" novalidate>
          <label for="name">Full Name</label>
          <input id="name" name="name" type="text" placeholder="Your full name" required autocomplete="name" />

          <label for="email">Email Address</label>
          <input id="email" name="email" type="email" placeholder="you@example.com" required autocomplete="email" />

          <label for="message">Message</label>
          <textarea id="message" name="message" placeholder="Write your message here..." required></textarea>

          <button type="submit" aria-label="Send Message">Send Message</button>
        </form>
      </section>
    </div>

  </div> <footer style="background: linear-gradient(135deg, #2a6fdb, #a2f5dc); color: #fff; padding: 3rem 1.5rem; font-family: 'Poppins', sans-serif; margin-top: auto;">
    <div style="max-width: 1200px; margin: auto; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 3rem;">
      <div style="flex: 1 1 300px;">
        <h2 style="font-family: 'Comfortaa', cursive; font-size: 2.2rem; margin-bottom: 1rem;">Sweet Scoop</h2>
        <p style="font-size: 1.15rem; line-height: 1.7;">
          Delight in every scoop! Premium handcrafted ice creams made with love and the finest ingredients. Visit us or order online today.
        </p>
      </div>

      <div style="flex: 1 1 250px;">
        <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">Contact Info</h3>
        <p style="font-size: 1.15rem;"><strong>Address:</strong><br>123 Sweet Street, Candy City</p>
        <p style="font-size: 1.15rem;"><strong>Email:</strong><br>info@sweetscoop.com</p>
        <p style="font-size: 1.15rem;"><strong>Phone:</strong><br>+1 (234) 567-890</p>
      </div>

      <div style="flex: 1 1 200px;">
        <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">Follow Us</h3>
        <div style="display: flex; gap: 1.2rem;">
          <a href="#" target="_blank" aria-label="LinkedIn" style="color: white;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 24 24">
              <path d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8.5h4V24h-4V8.5zM8.5 8.5h3.5v2.25h.05c.49-.94 1.7-2.25 3.45-2.25 3.7 0 4.5 2.44 4.5 5.63V24h-4v-8c0-1.91-.03-4.38-2.67-4.38-2.68 0-3.09 2.09-3.09 4.25V24h-4V8.5z"/>
            </svg>
          </a>
          <a href="#" target="_blank" aria-label="GitHub" style="color: white;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 24 24">
              <path d="M12 .5a12 12 0 00-3.8 23.4c.6.1.8-.2.8-.5v-2.2c-3.3.7-4-1.6-4-1.6-.5-1.3-1.1-1.6-1.1-1.6-.9-.7.1-.7.1-.7 1 .1 1.5 1 1.5 1 .9 1.5 2.3 1 2.9.7.1-.6.3-1 .5-1.2-2.7-.3-5.5-1.3-5.5-5.9 0-1.3.5-2.4 1.2-3.3-.1-.3-.5-1.4.1-2.9 0 0 1-.3 3.3 1.2a11.5 11.5 0 016 0c2.2-1.5 3.2-1.2 3.2-1.2.6 1.5.2 2.6.1 2.9.8.9 1.2 2 1.2 3.3 0 4.6-2.8 5.6-5.5 5.9.4.3.6.8.6 1.6v2.4c0 .3.2.6.8.5A12 12 0 0012 .5z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>

    <div style="text-align: center; margin-top: 3rem; border-top: 1px solid rgba(255,255,255,0.3); padding-top: 1rem; font-size: 1rem;">
      &copy; <?php echo date("Y"); ?> Sweet Scoop. All rights reserved.
    </div>
  </footer>

  <script>
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.getElementById('navLinks');

    function toggleMenu() {
      navLinks.classList.toggle('show');
      const expanded = hamburger.getAttribute('aria-expanded') === 'true';
      hamburger.setAttribute('aria-expanded', !expanded);
    }

    window.addEventListener('scroll', () => {
      const navbar = document.getElementById('navbar');
      navbar.classList.toggle('scrolled', window.scrollY > 50);
    });

    document.addEventListener('click', (e) => {
      if (!navLinks.contains(e.target) && !hamburger.contains(e.target) && navLinks.classList.contains('show')) {
        navLinks.classList.remove('show');
        hamburger.setAttribute('aria-expanded', false);
      }
    });
  </script>

</body>
</html>