  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sweet Scoop - Responsive Navigation</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&family=Quicksand:wght@700&display=swap" rel="stylesheet" />

    <style>
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
        font-family: 'Comfortaa', cursive;
        background: linear-gradient(to right top, #e7f5ff, #eef8ff);
        min-height: 100vh;
        overflow-x: hidden;
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

      /* Changed logo image from circle to square with rounded corners */
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

      /* Admin button uses same blue as site name */
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

      /* Responsive */
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