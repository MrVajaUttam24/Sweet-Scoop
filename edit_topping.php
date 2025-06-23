<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "icecreamshop");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['sr']) || !is_numeric($_GET['sr'])) {
    die("Invalid topping ID.");
}

$sr = (int)$_GET['sr'];

// Fetch existing data
$sql = "SELECT name, image, price FROM topings WHERE sr = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sr);
$stmt->execute();
$stmt->bind_result($name, $image, $price);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $price = floatval($_POST["price"]);
    $newImage = $image; // default to old image

    if (!empty($name) && $price > 0) {
        // Handle file upload
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES["image"]["tmp_name"];
            $fileName = basename($_FILES["image"]["name"]);
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array($ext, $allowed)) {
                $newFileName = uniqid("top_", true) . '.' . $ext;
                $destination = "uploads/" . $newFileName;

                if (move_uploaded_file($fileTmp, $destination)) {
                    $newImage = $destination;
                }
            }
        }

        // Update record
        $updateSql = "UPDATE topings SET name = ?, image = ?, price = ? WHERE sr = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ssdi", $name, $newImage, $price, $sr);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: EditOrDelete_Topings.php");
            exit;
        } else {
            echo "Update failed.";
        }
    } else {
        echo "All fields are required and price must be greater than 0.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Topping</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f0f4f8;
      padding: 50px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      font-size: 2.2em;
      margin-bottom: 30px;
      color: #333;
    }

    form {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: 600;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1em;
    }

    button {
      background-color: #0ea5e9;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 8px;
      font-size: 1.1em;
      cursor: pointer;
      font-weight: 600;
    }

    button:hover {
      background-color: #0284c7;
    }

    .back-link {
      margin-top: 20px;
      font-size: 1em;
      color: #555;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    .preview-img {
      max-width: 100%;
      margin-bottom: 15px;
      border-radius: 10px;
    }

    .spacer {
      height: 60px;
    }
  </style>
</head>
<body>

  <h1>Edit Topping</h1>

  <form method="POST" enctype="multipart/form-data">
    <label for="name">Topping Name:</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>

    <label>Current Image:</label>
    <img src="<?= htmlspecialchars($image) ?>" alt="Current Image" class="preview-img">

    <label for="image">Upload New Image:</label>
    <input type="file" id="image" name="image" accept="image/*">

    <label for="price">Price (₹):</label>
    <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($price) ?>" required>

    <button type="submit">Update</button>
  </form>

  <a class="back-link" href="EditOrDelete_Topings.php">← Back to Toppings</a>

  <div class="spacer"></div>

  <!-- Footer Starts Here -->
  <footer style="background: linear-gradient(135deg, #2a6fdb, #a2f5dc); color: #fff; padding: 3rem 1.5rem; font-family: 'Poppins', sans-serif;">
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
          <a href="" target="_blank" aria-label="LinkedIn" style="color: white;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 24 24">
              <path d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8.5h4V24h-4V8.5zM8.5 8.5h3.5v2.25h.05c.49-.94 1.7-2.25 3.45-2.25 3.7 0 4.5 2.44 4.5 5.63V24h-4v-8c0-1.91-.03-4.38-2.67-4.38-2.68 0-3.09 2.09-3.09 4.25V24h-4V8.5z"/>
            </svg>
          </a>
          <a href="" target="_blank" aria-label="GitHub" style="color: white;">
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

</body>
</html>
