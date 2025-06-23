<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $customerName = $_POST['name'] ?? '';
    $contact = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $flavor = $_SESSION['icecream_flavor'] ?? '';
    $size = $_SESSION['icecream_size'] ?? '';
    $toppings = isset($_SESSION['icecream_toppings']) ? implode(', ', $_SESSION['icecream_toppings']) : '';
    $quantity = $_SESSION['icecream_quantity'] ?? 1;
    $price = $_SESSION['icecream_total'] ?? 0;

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'icecreamshop');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Insert query using prepared statement
    $stmt = $conn->prepare("INSERT INTO custom_icecream_order (customername, contact, address, selected_flavor, size, toppings, quantity, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssii", $customerName, $contact, $address, $flavor, $size, $toppings, $quantity, $price);

    if ($stmt->execute()) {
        // Get last inserted ID
        $last_id = $conn->insert_id;

        // Store inserted order ID in session (optional)
        $_SESSION['last_order_id'] = $last_id;

        // Redirect to bill page
        header("Location: Custom_IceCreme_BillPage.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sweet Scoop - Order Details</title>

    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&family=Quicksand:wght@700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

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
            font-family: 'Poppins', sans-serif; /* Changed default font to Poppins for the body */
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

        nav {
            backdrop-filter: blur(12px);
            background: var(--glass);
            border: 1px solid var(--border);
            border-radius: 30px;
            margin: 2rem auto;
            padding: 1.5rem 3rem;
            max-width: 1200px;
            width: calc(100% - 4rem); /* Added for better responsiveness */
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

        /* Responsive Navbar */
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
                margin-top: 10px; /* Space below navbar */
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

        /* --- Actual Page Styles (Order Details) --- */
        .order-container {
            background: white;
            border-radius: 20px;
            max-width: 960px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 40px 50px;
            transition: box-shadow 0.3s ease;
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            box-sizing: border-box;
            flex-direction: row;
            margin: 30px auto; /* Increased margin for space from navbar */
        }

        .order-container:hover {
            box-shadow: 0 14px 40px rgba(0,0,0,0.25);
        }

        .order-container h1 {
            width: 100%;
            text-align: center;
            color: #1f2937;
            font-weight: 700;
            margin-bottom: 35px;
            font-size: 2.4em;
            letter-spacing: 1px;
        }

        .form-section {
            flex: 1 1 400px;
            min-width: 280px;
        }

        .order-container label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            margin-top: 20px;
            font-size: 1.1em;
            letter-spacing: 0.03em;
        }

        .order-container input, .order-container textarea {
            width: 100%;
            padding: 14px 18px;
            font-size: 1em;
            border-radius: 12px;
            border: 1.8px solid #d1d5db;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            color: #374151;
            font-weight: 500;
        }

        .order-container input:focus, .order-container textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 8px rgba(59,130,246,0.4);
            outline: none;
            font-weight: 600;
        }

        .order-container textarea {
            resize: vertical;
            min-height: 100px;
            font-size: 1em;
        }

        #toppings {
            min-height: 120px;
        }

        .submit-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .submit-btn {
            padding: 16px 40px;
            background-color: #3b82f6;
            color: white;
            font-weight: 700;
            font-size: 1.15em;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            letter-spacing: 0.04em;
            box-shadow: 0 6px 12px rgba(59,130,246,0.4);
        }

        .submit-btn:hover {
            background-color: #2563eb;
            box-shadow: 0 8px 16px rgba(37,99,235,0.6);
        }

        footer {
            margin-top: 60px;
            width: 100%;
            background: linear-gradient(135deg, #2a6fdb, #a2f5dc);
            color: #fff;
            padding: 3rem 1.5rem;
            font-family: 'Poppins', sans-serif;
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

        footer a {
            color: white;
            text-decoration: none;
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

        footer div > div {
            flex: 1 1 250px; /* Adjusted flex-basis for better distribution */
        }

        @media (max-width: 768px) {
            .order-container {
                padding: 30px 25px;
                flex-direction: column;
            }

            .order-container h1 {
                font-size: 1.9em;
            }

            .submit-wrapper {
                justify-content: center;
            }

            footer > div {
                flex-direction: column;
                align-items: center;
                text-align: center;
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

    <div style="height: 20px;"></div> 

    <div class="order-container">
        <h1>Order Details</h1>
        <form id="orderForm" method="POST" style="display: contents;">
            <div class="form-section">
                <label for="name">Customer Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Full name" required />

                <label for="phone">Contact Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter 10-digit number" pattern="[0-9]{10}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10);" required />

                <label for="address">Delivery Address</label>
                <textarea id="address" name="address" placeholder="Enter full delivery address" required></textarea>
            </div>

            <div class="form-section">
                <label for="flavor">Your Selected Flavor</label>
                <input type="text" readonly value="<?php echo htmlspecialchars($_SESSION['icecream_flavor'] ?? 'Not set'); ?>" id="flavor" name="flavor" required />

                <label for="size">Size</label>
                <input type="text" readonly value="<?php echo htmlspecialchars($_SESSION['icecream_size'] ?? 'Not set'); ?>" id="size" name="size" required />

                <label for="toppings">Toppings</label>
                <textarea readonly id="toppings" name="toppings" required><?php 
                    echo isset($_SESSION['icecream_toppings']) ? htmlspecialchars(implode(', ', $_SESSION['icecream_toppings'])) : '';
                ?></textarea>

                <label for="quantity">Quantity</label>
                <input type="number" readonly value="<?php echo htmlspecialchars($_SESSION['icecream_quantity'] ?? '1'); ?>" id="quantity" name="quantity" min="1" required />

                <label for="price">Price (in ₹)</label>
                <input type="number" readonly value="<?php echo htmlspecialchars($_SESSION['icecream_total'] ?? '0'); ?>" id="price" name="price" min="1" required />
            </div>

            <div class="submit-wrapper">
                <button type="submit" class="submit-btn">Place Order</button>
            </div>
        </form>
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