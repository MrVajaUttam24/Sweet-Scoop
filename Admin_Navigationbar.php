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
      padding: 1rem 2rem;
      max-width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      animation: glowPulse 3s ease-in-out infinite;
      white-space: nowrap;
      gap: 2rem;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 15px;
      flex-shrink: 0;
    }

    .logo img {
      width: 70px;
      height: 70px;
      border-radius: 15px;
      object-fit: cover;
      box-shadow: 0 0 18px var(--blue);
      filter: drop-shadow(0 0 6px var(--blue));
      user-select: none;
    }

    .logo-text {
      font-family: 'Quicksand', sans-serif;
      font-size: 2rem;
      color: var(--blue);
      font-weight: 700;
      letter-spacing: 1px;
      text-shadow: 0 0 5px var(--glow-blue), 0 0 10px var(--glow-mint), 0 0 15px var(--glow-violet);
      user-select: none;
      white-space: nowrap;
    }

    .nav-links {
      display: flex;
      gap: 1.5rem;
      align-items: center;
      flex-grow: 1;
      justify-content: flex-end;
      flex-wrap: nowrap;
    }

    .nav-links a {
      text-decoration: none;
      font-size: 1.1rem;
      color: var(--text);
      position: relative;
      font-weight: 600;
      transition: all 0.3s ease;
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
      transform: scale(1.05);
      text-shadow: 0 0 5px var(--glow-mint), 0 0 10px var(--glow-blue), 0 0 15px var(--glow-violet);
    }

    .admin-button {
      padding: 0.4rem 1rem;
      font-size: 1rem;
      font-weight: 700;
      border-radius: 25px;
      border: 2px solid var(--blue);
      background: var(--blue);
      color: white;
      text-decoration: none;
      backdrop-filter: blur(6px);
      box-shadow: 0 0 8px var(--glow-blue);
      transition: all 0.3s ease;
    }

    .admin-button:hover {
      background: white;
      color: var(--blue);
      border-color: var(--blue);
      box-shadow: 0 0 12px var(--glow-blue), 0 0 24px var(--glow-mint);
      transform: scale(1.05);
    }

    @media (max-width: 1000px) {
      .nav-links {
        gap: 1rem;
      }

      .nav-links a {
        font-size: 1rem;
      }

      .logo-text {
        font-size: 1.6rem;
      }

      .logo img {
        width: 60px;
        height: 60px;
      }

      .admin-button {
        font-size: 0.9rem;
        padding: 0.3rem 0.8rem;
      }
    }

    @media (max-width: 768px) {
      .nav-links {
        gap: 0.8rem;
      }

      .nav-links a {
        font-size: 0.9rem;
      }

      .logo-text {
        font-size: 1.4rem;
      }

      .logo img {
        width: 55px;
        height: 55px;
      }

      .admin-button {
        font-size: 0.85rem;
        padding: 0.3rem 0.6rem;
      }
    }

    @media (max-width: 600px) {
      .nav-links {
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 1rem;
      }

      .nav-links a {
        font-size: 0.8rem;
      }

      .admin-button {
        font-size: 0.8rem;
        padding: 0.25rem 0.6rem;
      }

      .logo-text {
        font-size: 1.2rem;
      }

      .logo img {
        width: 50px;
        height: 50px;
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

    <div class="nav-links" id="navLinks">
      <a href="index.php">Home</a>
      <a href="Add_New_Product.php">Add New Flavor</a>
      <a href="insert_topings.php">Add New Topping</a>
      <a href="Display_Order.php">Orders</a>
      <a href="EditORDelete_Flavors.php">Edit/Delete Flavor</a>
      <a href="EditORDelete_Topings.php">Edit/Delete Topping</a>
    </div>
  </nav>

</body>
</html>
