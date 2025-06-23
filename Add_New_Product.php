<?php
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // DB connection settings
    $host = 'localhost';
    $db   = 'icecreamshop';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        die("DB Connection failed: " . $e->getMessage());
    }

    // Collect form data
    $name = $_POST['product-name'] ?? '';
    $discription = $_POST['product-description'] ?? '';
    $cone = $_POST['cone'] ?? 0;
    $candy = $_POST['candy'] ?? 0;
    $cup = $_POST['cup'] ?? 0;
    $familypack = $_POST['family-pack'] ?? 0;

    $image_path = '';

    if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['product-image']['tmp_name'];
        $fileName = $_FILES['product-image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExts)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadDir = './uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $image_path = $uploadDir . $newFileName;

            if (!move_uploaded_file($fileTmpPath, $image_path)) {
                $message = "Failed to upload image.";
            }
        } else {
            $message = "Invalid image file type.";
        }
    }

    // Insert into DB if image uploaded or no error
    if ($message === '') {
        $stmt = $pdo->prepare("INSERT INTO flavors (name, image, discription, cone, candy, cup, familypack)
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $image_path, $discription, $cone, $candy, $cup, $familypack]);
        $message = "Product added successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sweet Scoop - Add New Product</title>

  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&family=Quicksand:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

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
      display: flex; /* Added for layout */
      flex-direction: column; /* Added for layout */
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
      margin: 2rem auto 0 auto; /* Adjusted margin-bottom to 0 */
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

    /* Styles for the form section */
    .form-container {
      background: #fff;
      border-radius: 20px;
      padding: 40px;
      width: 100%;
      max-width: 500px;
      margin: 40px auto; /* Added margin-top to create space */
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.8s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    h1 {
      text-align: center;
      color: #ff6a00;
      margin-bottom: 30px;
      font-size: 2em;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
      margin-top: 10px;
    }
    input[type="text"],
    input[type="file"],
    input[type="number"],
    textarea {
      width: 100%;
      padding: 14px 16px;
      border: 2px solid transparent;
      border-radius: 12px;
      background: #f8f8f8;
      font-size: 1em;
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }
    input:focus, textarea:focus {
      border-color: #ff6a00;
      background: #fff7f1;
      outline: none;
    }
    textarea { min-height: 90px; resize: vertical; }
    button {
      background: linear-gradient(to right, #ff6a00, #f97316);
      color: #fff;
      border: none;
      padding: 16px;
      font-weight: 600;
      font-size: 1.1em;
      border-radius: 50px;
      width: 100%;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(255, 106, 0, 0.3);
      transition: all 0.3s ease;
      margin-top: 10px;
    }
    button:hover {
      background: linear-gradient(to right, #f97316, #ff6a00);
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(255, 106, 0, 0.5);
    }
    button:active { transform: scale(0.97); }
    ::placeholder { color: #aaa; }
    #image-preview {
      display: block;
      width: 100%;
      max-height: 250px;
      object-fit: contain;
      border-radius: 12px;
      margin-top: -15px;
      margin-bottom: 20px;
      box-shadow: 0 4px 15px rgba(255, 106, 0, 0.3);
      background: #fff7f1;
    }
    .message {
      text-align: center;
      font-weight: 600;
      color: green;
      margin-bottom: 20px;
    }
    footer {
      background: linear-gradient(135deg, #2a6fdb, #a2f5dc);
      color: #fff;
      padding: 3rem 1.5rem;
      font-family: 'Poppins', sans-serif;
      margin-top: auto; /* Pushes the footer to the bottom */
    }
    footer h2, footer h3, footer p {
      margin: 0 0 1rem;
    }
    footer a { color: white; }
    footer svg { vertical-align: middle; }
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

  <div class="form-container">
    <h1>🍦 Add Ice Cream</h1>

    <?php if (!empty($message)): ?>
      <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form id="new-product-form" method="post" enctype="multipart/form-data">
      <label for="product-name">Product Name</label>
      <input type="text" id="product-name" name="product-name" placeholder="e.g. Mango Delight" required />

      <label for="product-image">Choose Image</label>
      <input type="file" id="product-image" name="product-image" accept="image/*" required />
      <img id="image-preview" src="" alt="Image preview" style="display:none;" />

      <label for="product-description">Description</label>
      <textarea id="product-description" name="product-description" placeholder="Short product description" required></textarea>

      <label for="cone">Cone Price (₹)</label>
      <input type="number" id="cone" name="cone" placeholder="Enter price for cone" min="0" required />

      <label for="candy">Candy Price (₹)</label>
      <input type="number" id="candy" name="candy" placeholder="Enter price for candy" min="0" required />

      <label for="cup">Cup Price (₹)</label>
      <input type="number" id="cup" name="cup" placeholder="Enter price for cup" min="0" required />

      <label for="family-pack">Family Pack Price (₹)</label>
      <input type="number" id="family-pack" name="family-pack" placeholder="Enter price for family pack" min="0" required />

      <button type="submit">Add Product</button>
    </form>
  </div>

  <footer>
    <div style="max-width: 1200px; margin: auto; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 3rem;">
      <div style="flex: 1 1 300px;">
        <h2 style="font-family: 'Comfortaa', cursive; font-size: 2.2rem;">Sweet Scoop</h2>
        <p style="font-size: 1.15rem;">Delight in every scoop! Premium handcrafted ice creams made with love and the finest ingredients. Visit us or order online today.</p>
      </div>
      <div style="flex: 1 1 250px;">
        <h3 style="font-size: 1.5rem;">Contact Info</h3>
        <p style="font-size: 1.15rem;"><strong>Address:</strong><br>123 Sweet Street, Candy City</p>
        <p style="font-size: 1.15rem;"><strong>Email:</strong><br>info@sweetscoop.com</p>
        <p style="font-size: 1.15rem;"><strong>Phone:</strong><br>+1 (234) 567-890</p>
      </div>
      <div style="flex: 1 1 200px;">
        <h3 style="font-size: 1.5rem;">Follow Us</h3>
        <div style="display: flex; gap: 1.2rem;">
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
    <div style="text-align: center; margin-top: 3rem; border-top: 1px solid rgba(255,255,255,0.3); padding-top: 1rem; font-size: 1rem;">
      &copy; <?php echo date("Y"); ?> Sweet Scoop. All rights reserved.
    </div>
  </footer>

  <script>
    const imageInput = document.getElementById('product-image');
    const imagePreview = document.getElementById('image-preview');

    imageInput.addEventListener('change', () => {
      const file = imageInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          imagePreview.src = e.target.result;
          imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        imagePreview.src = '';
        imagePreview.style.display = 'none';
      }
    });
  </script>
</body>
</html>