<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sweet Scoop - Manage Flavors</title>

  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&family=Quicksand:wght@700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

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
      font-family: 'Poppins', sans-serif; /* Changed to Poppins for the main body */
      background: linear-gradient(to right top, #e7f5ff, #eef8ff);
      min-height: 100vh;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    @keyframes glowPulse {
      0%, 100% {
        box-shadow: 0 0 10px var(--glow-blue), 0 0 20px var(--glow-mint), 0 0 30px var(--glow-violet);
      }
      50% {
        box-shadow: 0 0 20px var(--glow-blue), 0 0 40px var(--glow-mint), 0 0 60px var(--glow-violet);
      }
    }

    /* Navigation Bar Styles */
    nav {
      backdrop-filter: blur(12px);
      background: var(--glass);
      border: 1px solid var(--border);
      border-radius: 30px;
      margin: 2rem auto;
      padding: 1rem 2rem;
      max-width: calc(100% - 4rem); /* Adjust max-width to account for margin */
      display: flex;
      justify-content: space-between;
      align-items: center;
      animation: glowPulse 3s ease-in-out infinite;
      white-space: nowrap;
      gap: 2rem;
      flex-wrap: wrap; /* Allow wrapping on smaller screens */
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

    /* Main Content Styles */
    .content-wrapper {
      width: 100%;
      padding: 40px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px; /* Space between the heading and the table */
    }

    h1 {
      font-size: 2.5em;
      color: #0f172a;
      margin-bottom: 20px; /* Adjust margin to work with gap */
      text-align: center;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      max-width: 1200px;
      background: #fff;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      border-radius: 14px;
      overflow: hidden;
      font-size: 1em;
    }

    thead {
      background: linear-gradient(45deg, #6366f1, #3b82f6);
      color: white;
    }

    th, td {
      padding: 16px 12px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }

    img {
      max-width: 90px;
      height: auto;
      border-radius: 8px;
    }

    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .action-buttons a,
    .action-buttons form button {
      text-decoration: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-weight: 600;
      font-size: 0.95em;
      cursor: pointer;
      border: none;
      transition: background-color 0.3s ease;
    }

    .edit-btn {
      background-color: #22c55e;
      color: white;
    }

    .edit-btn:hover {
      background-color: #16a34a;
    }

    .delete-btn {
      background-color: #ef4444;
      color: white;
    }

    .delete-btn:hover {
      background-color: #dc2626;
    }

    .action-buttons form {
      margin: 0;
    }

    tbody tr:hover {
      background-color: #f0f9ff;
    }

    /* Footer Styles */
    footer {
      background: linear-gradient(135deg, #2a6fdb, #a2f5dc);
      color: #fff;
      padding: 3rem 1.5rem;
      font-family: 'Poppins', sans-serif;
      margin-top: auto; /* Pushes the footer to the bottom */
      width: 100%;
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
      margin-bottom: 0.5rem;
    }

    footer > div {
      max-width: 1200px;
      margin: auto;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: flex-start;
      gap: 3rem;
    }

    footer > div > div {
      flex: 1 1 250px; /* Adjusted base flex-basis for columns */
    }

    footer .social-icons {
      display: flex;
      gap: 1.2rem;
    }

    footer .social-icons a {
      color: white;
    }

    footer .copyright {
      text-align: center;
      margin-top: 3rem;
      border-top: 1px solid rgba(255,255,255,0.3);
      padding-top: 1rem;
      font-size: 1rem;
    }

    /* Media Queries for Navigation */
    @media (max-width: 1000px) {
      nav {
        gap: 1rem;
        padding: 1rem 1.5rem;
      }
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
      nav {
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem 1rem;
        margin: 1.5rem auto;
      }
      .logo {
        margin-bottom: 1rem;
      }
      .nav-links {
        justify-content: center;
        width: 100%;
        flex-wrap: wrap;
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

      /* Media Queries for Table */
      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead {
        display: none;
      }

      tr {
        margin-bottom: 20px;
        background: #fff;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        border-radius: 10px;
        padding: 15px;
      }

      td {
        padding: 12px 10px;
        text-align: right;
        position: relative;
        font-size: 0.95em;
      }

      td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        top: 12px;
        font-weight: bold;
        color: #3b82f6;
        text-align: left;
      }

      .action-buttons {
        justify-content: flex-end;
      }

      /* Media Queries for Footer */
      footer > div {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      footer > div > div {
        margin-bottom: 1.5rem;
      }
      footer h2, footer h3 {
        text-align: center;
      }
    }

    @media (max-width: 600px) {
      .nav-links {
        gap: 0.5rem;
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

  <div class="content-wrapper">
    <h1>Manage Ice Cream Flavors</h1>

    <?php
      $conn = new mysqli("localhost", "root", "", "icecreamshop");

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
        $deleteId = (int)$_POST['delete_id'];
        $deleteSql = "DELETE FROM flavors WHERE sr = ?";
        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param("i", $deleteId);
        $stmt->execute();
        $stmt->close();
      }

      $sql = "SELECT sr, name, image, discription, cone, candy, cup, familypack FROM flavors";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo '<table>';
        echo '<thead>
                <tr>
                  <th>Sr No</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Cone (₹)</th>
                  <th>Candy (₹)</th>
                  <th>Cup (₹)</th>
                  <th>Family Pack (₹)</th>
                  <th>Actions</th>
                </tr>
              </thead><tbody>';

        while ($row = $result->fetch_assoc()) {
          echo '<tr>
                  <td data-label="Sr No">' . htmlspecialchars($row["sr"]) . '</td>
                  <td data-label="Name">' . htmlspecialchars($row["name"]) . '</td>
                  <td data-label="Image"><img src="' . htmlspecialchars($row["image"]) . '" alt="Flavor Image" /></td>
                  <td data-label="Description">' . htmlspecialchars($row["discription"]) . '</td>
                  <td data-label="Cone">₹' . number_format($row["cone"], 2) . '</td>
                  <td data-label="Candy">₹' . number_format($row["candy"], 2) . '</td>
                  <td data-label="Cup">₹' . number_format($row["cup"], 2) . '</td>
                  <td data-label="Family Pack">₹' . number_format($row["familypack"], 2) . '</td>
                  <td data-label="Actions">
                    <div class="action-buttons">
                      <a href="edit_flavor.php?sr=' . $row["sr"] . '" class="edit-btn">Edit</a>
                      <form method="POST" onsubmit="return confirm(\'Are you sure you want to delete this flavor?\');">
                        <input type="hidden" name="delete_id" value="' . $row["sr"] . '">
                        <button type="submit" class="delete-btn">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>';
        }

        echo '</tbody></table>';
      } else {
        echo "<p style='font-size: 1.2em;'>No flavors found.</p>";
      }

      $conn->close();
    ?>
  </div>

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
  </body>
</html>