<?php
session_start(); // ✅ Start session

// Connect to database
// Make sure your database credentials are correct.
// For security in a production environment, avoid 'root' and empty password.
$conn = mysqli_connect("localhost", "root", "", "icecreamshop") or die("Connection failed");

// Prices for flavors per size
$flavorPrices = [
  "Vanilla" => [
    "200ml" => 50,
    "500ml" => 90,
    "700ml" => 130,
    "1 Liter" => 170
  ],
  "Chocolate" => [
    "200ml" => 60,
    "500ml" => 100,
    "700ml" => 140,
    "1 Liter" => 180
  ]
];

// Handle form submission
$selectedSize = $_SESSION['icecream_size'] ?? '';
$selectedFlavor = $_SESSION['icecream_flavor'] ?? '';
$selectedToppings = $_SESSION['icecream_toppings'] ?? [];
$quantity = $_SESSION['icecream_quantity'] ?? 1;
$total = $_SESSION['icecream_total'] ?? 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $selectedSize = $_POST['size'] ?? '';
  $selectedFlavor = $_POST['flavor'] ?? '';
  $selectedToppings = $_POST['toppings'] ?? [];
  $quantity = intval($_POST['quantity'] ?? 1);
  $quantity = max(1, $quantity); // Ensure at least 1

  // Base price
  $basePrice = $flavorPrices[$selectedFlavor][$selectedSize] ?? 0;
  $toppingTotal = 0;

  foreach ($selectedToppings as $toppingName) {
    $query = "SELECT price FROM topings WHERE name='" . mysqli_real_escape_string($conn, $toppingName) . "'";
    $res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($res)) {
      $toppingTotal += $row['price'];
    }
  }

  $total = ($basePrice + $toppingTotal) * $quantity;

  // ✅ Store each value in its own session variable
  $_SESSION['icecream_size'] = $selectedSize;
  $_SESSION['icecream_flavor'] = $selectedFlavor;
  $_SESSION['icecream_toppings'] = $selectedToppings;
  $_SESSION['icecream_quantity'] = $quantity;
  $_SESSION['icecream_total'] = $total;

  // Optionally redirect to next page
  header("Location: Custmor_Page.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sweet Scoop - Build Your Custom Ice Cream</title>

  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&family=Quicksand:wght@700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap" rel="stylesheet" />

  <style>
    /* --- Navigation Styles --- */
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

    /* --- Main Page Content Styles --- */
    main {
        padding-top: 2rem; /* Add space between nav and content */
    }

    body {
      background: linear-gradient(to right, #f0f4f8, #e2ecf3);
      font-family: 'Inter', sans-serif;
    }
    .main-title {
      font-size: 3rem;
      font-weight: 800;
      background: linear-gradient(to right, #007bff, #00b4d8);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-align: center;
      margin-bottom: 0.5rem;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1s ease-in-out;
    }
    .section-subtitle {
      text-align: center;
      font-size: 1.25rem;
      color: #6c757d;
      margin-bottom: 2rem;
    }
    .section-label {
      font-size: 2rem;
      font-weight: 700;
      color: #495057;
      margin: 2.5rem 0 1.5rem;
      position: relative;
      padding-left: 2.5rem;
    }
    .section-label::before {
      content: "🍦";
      position: absolute;
      left: 0;
      top: 0;
      font-size: 1.8rem;
    }
    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 1rem;
      border: 2px solid transparent;
      overflow: hidden;
      cursor: pointer;
      user-select: none;
    }
    .size-card:hover,
    .topping-card:hover,
    .flavor-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }
    .size-card.selected,
    .size-card input[type="radio"]:checked + img {
      border-color: #0d6efd;
      background-color: #eaf3ff;
    }
    .topping-card.selected,
    .topping-card input[type="checkbox"]:checked + img {
      border-color: #198754;
      background-color: #e8f6ef;
    }
    .flavor-card.selected,
    .flavor-card input[type="radio"]:checked + img {
      border-color: #fd7e14;
      background-color: #fff3e0;
    }
    input[type="radio"],
    input[type="checkbox"] {
      position: absolute;
      opacity: 0;
      width: 0;
      height: 0;
      pointer-events: none;
    }
    label.card {
      position: relative;
      padding: 0;
    }
    label.card img {
      display: block;
      height: 200px;
      width: 100%;
      object-fit: contain;
      background-color: #ffffff;
      padding: 1rem;
      border-radius: 1rem 1rem 0 0;
      border: 2px solid transparent;
      transition: all 0.3s ease;
    }
    input[type="radio"]:checked + img,
    input[type="checkbox"]:checked + img {
      border-color: #0d6efd;
      background-color: #eaf3ff;
      filter: brightness(1.1);
      box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
    }
    .card-body {
      text-align: center;
      padding: 1rem;
      border-radius: 0 0 1rem 1rem;
      background-color: white;
      border: 2px solid transparent;
      border-top: none;
      transition: border-color 0.3s ease;
    }
    .price {
      font-size: 1rem;
      color: #28a745;
      font-weight: 600;
      margin-top: 0.3rem;
    }
    .glass-button,
    .btn-submit {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.3);
      color: #007bff;
      font-weight: 600;
      font-size: 1.25rem;
      padding: 0.75rem 2rem;
      border-radius: 50px;
      transition: all 0.3s ease;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      text-decoration: none;
      display: inline-block;
      cursor: pointer;
      border-color: transparent;
      background-color: #007bff;
      color: #fff;
      font-weight: 700;
      box-shadow: 0 6px 20px rgba(0,123,255,.4);
    }
    .glass-button:hover,
    .btn-submit:hover {
      background: rgba(0, 123, 255, 0.15);
      color: #0056b3;
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(0, 86, 179, 0.5);
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 768px) {
      .main-title {
        font-size: 2.2rem;
      }
      .section-label {
        font-size: 1.5rem;
      }
      label.card img {
        height: 160px;
      }
    }

    /* --- Footer Styles --- */
    footer {
        background: linear-gradient(135deg, #2a6fdb, #a2f5dc);
        color: #fff;
        padding: 3rem 1.5rem;
        font-family: 'Poppins', sans-serif;
    }
    footer div {
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        gap: 3rem;
    }
    footer h2 {
        font-family: 'Comfortaa', cursive;
        font-size: 2.2rem;
        margin-bottom: 1rem;
    }
    footer h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    footer p {
        font-size: 1.15rem;
        line-height: 1.7;
    }
    footer strong {
        font-weight: bold;
    }
    footer a {
        color: white;
        text-decoration: none;
        transition: transform 0.2s ease-in-out;
    }
    footer a:hover {
        transform: translateY(-3px);
    }
    footer .social-icons {
        display: flex;
        gap: 1.2rem;
    }
    footer .copyright {
        text-align: center;
        margin-top: 3rem;
        border-top: 1px solid rgba(255,255,255,0.3);
        padding-top: 1rem;
        font-size: 1rem;
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

  <main>
    <div class="container py-5">
      <div class="text-center mb-5">
        <h1 class="main-title">🍨 Build Your Custom Ice Cream</h1>
        <p class="section-subtitle">Choose a size, flavor, and toppings to create your favorite treat.</p>
      </div>

      <form method="POST" action="">
        <h4 class="section-label">Choose Ice Cream Size</h4>
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
          <?php
          $sizeImages = [
            "200ml" => "Cup200ml.jpg",
            "500ml" => "Cup500ml.jpg",
            "700ml" => "Cup700ml.jpg",
            "1 Liter" => "Cup1Litter.jpg"
          ];
          foreach ($flavorPrices['Vanilla'] as $size => $price) {
            $imgSrc = $sizeImages[$size] ?? "placeholder.jpg";
            $checked = ($size === $selectedSize) ? "checked" : "";
            echo "
            <div class='col'>
              <label class='card size-card'>
                <input type='radio' name='size' value='$size' required $checked />
                <img src='images/$imgSrc' alt='$size' />
                <div class='card-body'><h5>$size</h5></div>
              </label>
            </div>";
          }
          ?>
        </div>

        <h4 class="section-label">Choose Ice Cream Flavor</h4>
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
          <?php
          $flavors = ["Vanilla" => "Simple Vanilla2.jpg", "Chocolate" => "Simple Choclate.jpg"];
          foreach ($flavors as $flavor => $img) {
            $checked = ($flavor === $selectedFlavor) ? "checked" : "";
            echo "
            <div class='col'>
              <label class='card flavor-card'>
                <input type='radio' name='flavor' value='$flavor' required $checked />
                <img src='images/$img' alt='$flavor' />
                <div class='card-body'><h5>$flavor</h5></div>
              </label>
            </div>";
          }
          ?>
        </div>

        <h4 class="section-label">Add Toppings</h4>
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
          <?php
          $sel = "SELECT * FROM topings";
          $res = mysqli_query($conn, $sel);
          while ($row = mysqli_fetch_assoc($res)) {
            $checked = in_array($row['name'], $selectedToppings) ? "checked" : "";
            echo "
            <div class='col'>
              <label class='card topping-card'>
                <input type='checkbox' name='toppings[]' value='" . htmlspecialchars($row['name']) . "' $checked />
                <img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' />
                <div class='card-body'>
                  <h5>" . htmlspecialchars($row['name']) . "</h5>
                  <p class='price'>₹" . htmlspecialchars($row['price']) . "</p>
                </div>
              </label>
            </div>";
          }
          ?>
        </div>

        <div class="mb-4 text-center">
          <label for="quantity" class="form-label fw-bold fs-5">Quantity</label><br />
          <input type="number" id="quantity" name="quantity" min="1" value="<?= htmlspecialchars($quantity) ?>" class="form-control d-inline-block w-auto" required />
        </div>

        <div class="text-center mb-3">
          <button type="submit" class="btn-submit">Next</button>
        </div>
      </form>
    </div>
  </main>

  <footer>
    <div>
      <div>
        <h2>Sweet Scoop</h2>
        <p>
          Delight in every scoop! Premium handcrafted ice creams made with love and the finest ingredients. Visit us or order online today.
        </p>
      </div>
      <div>
        <h3>Contact Info</h3>
        <p><strong>Address:</strong><br>123 Sweet Street, Candy City</p>
        <p><strong>Email:</strong><br>info@sweetscoop.com</p>
        <p><strong>Phone:</strong><br>+1 (234) 567-890</p>
      </div>
      <div>
        <h3>Follow Us</h3>
        <div class="social-icons">
          <a href="#" target="_blank" aria-label="LinkedIn">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 24 24">
              <path d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8.5h4V24h-4V8.5zM8.5 8.5h3.5v2.25h.05c.49-.94 1.7-2.25 3.45-2.25 3.7 0 4.5 2.44 4.5 5.63V24h-4v-8c0-1.91-.03-4.38-2.67-4.38-2.68 0-3.09 2.09-3.09 4.25V24h-4V8.5z"/>
            </svg>
          </a>
          <a href="#" target="_blank" aria-label="GitHub">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 24 24">
              <path d="M12 .5a12 12 0 00-3.8 23.4c.6.1.8-.2.8-.5v-2.2c-3.3.7-4-1.6-4-1.6-.5-1.3-1.1-1.6-1.1-1.6-.9-.7.1-.7.1-.7 1 .1 1.5 1 1.5 1 .9 1.5 2.3 1 2.9.7.1-.6.3-1 .5-1.2-2.7-.3-5.5-1.3-5.5-5.9 0-1.3.5-2.4 1.2-3.3-.1-.3-.5-1.4.1-2.9 0 0 1-.3 3.3 1.2a11.5 11.5 0 016 0c2.2-1.5 3.2-1.2 3.2-1.2.6 1.5.2 2.6.1 2.9.8.9 1.2 2 1.2 3.3 0 4.6-2.8 5.6-5.5 5.9.4.3.6.8.6 1.6v2.4c0 .3.2.6.8.5A12 12 0 0012 .5z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
    <div class="copyright">
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