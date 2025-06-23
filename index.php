<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sweet Scoop - Delicious Ice Cream</title>

    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&family=Quicksand:wght@700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Pacifico&display=swap" rel="stylesheet" />

    <style>
        /* --- Root Variables for both sections --- */
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

            /* Main Content Variables */
            --primary: #2a9df4; /* Similar to --blue, adjusted for content */
            --secondary: #e6f0fb;
            --accent: #a9d1ff;
            --text-primary: #1b2a49;
            --text-secondary: #3a4d7a;
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-blur: 20px;
            --font-main: 'Poppins', sans-serif;
            --font-logo: 'Pacifico', cursive;
            scroll-behavior: smooth;
        }

        /* --- Global Styles --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-main); /* Default to main content font */
            background: linear-gradient(135deg, #d9e9ff 0%, #f2f8ff 100%);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image:
                radial-gradient(circle, #a9d1ff 2px, transparent 2px),
                radial-gradient(circle, #2a9df4 3px, transparent 3px);
            background-position: 0 0, 40px 40px;
            background-size: 80px 80px;
            opacity: 0.12;
            pointer-events: none;
            animation: bubbleMove 80s linear infinite;
            z-index: 0;
        }

        @keyframes bubbleMove {
            0% { background-position: 0 0, 40px 40px; }
            100% { background-position: 80px 80px, 120px 120px; }
        }

        /* --- Navigation Styles --- */
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

        /* --- Main Content Styles --- */
        header {
            max-width: 1300px;
            margin: 4rem auto 3rem; /* Adjusted margin to give space from nav */
            background: var(--glass-bg);
            backdrop-filter: blur(var(--glass-blur));
            border-radius: 32px;
            padding: 3rem 2.5rem 4rem;
            box-shadow: 0 16px 40px rgba(42, 157, 244, 0.25);
            text-align: center;
            z-index: 1;
            position: relative; /* Ensure z-index works */
        }

        .hero-images {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            padding: 0 2rem;
            flex-wrap: nowrap;
        }

        .hero-img {
            max-width: 380px;
            border-radius: 22px;
            box-shadow: 0 12px 30px rgba(42, 157, 244, 0.3);
            animation: floatUpDown 5.5s ease-in-out infinite;
        }

        .center-image {
            flex-shrink: 0;
            margin: 0 2rem;
        }

        @keyframes floatUpDown {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-22px); }
        }

        header h1 {
            font-family: var(--font-logo);
            font-size: 4rem;
            color: var(--primary);
            margin-bottom: 0.6rem;
            text-shadow: 1.5px 1.5px 8px rgba(42, 157, 244, 0.6);
        }

        header p {
            font-size: 1.35rem;
            max-width: 680px;
            color: var(--text-secondary);
            margin: 0 auto 1.5rem;
            font-weight: 500;
            line-height: 1.65;
        }

        .flavor-highlight {
            display: inline-block;
            font-size: 1.25rem;
            font-weight: 700;
            color: #d71c5c;
            background: #fff6f9;
            border: 2px dashed #d71c5c;
            border-radius: 20px;
            padding: 0.6rem 1.2rem;
            margin-bottom: 2.5rem;
            animation: glowPulse 2s infinite; /* Reusing glowPulse animation for highlight */
        }

        @keyframes glowPulseHighlight { /* Renamed to avoid conflict if both used */
            0%, 100% { box-shadow: 0 0 0px rgba(215, 28, 92, 0.6); }
            50% { box-shadow: 0 0 12px rgba(215, 28, 92, 0.75); }
        }
        /* Apply the specific glowPulseHighlight to .flavor-highlight if you want different animation */
        .flavor-highlight {
             animation: glowPulseHighlight 2s infinite;
        }


        .btn-primary {
            background: var(--glass-bg);
            border: 2.5px solid var(--primary);
            color: var(--primary);
            padding: 1rem 3rem;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 0 12px 28px rgba(42, 157, 244, 0.35);
            transition: all 0.35s ease;
            text-decoration: none; /* Add for link styling */
            display: inline-block; /* Ensure padding and margin work */
        }

        .btn-primary:hover {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 18px 44px rgba(42, 157, 244, 0.6);
            transform: scale(1.12);
        }

        section#features {
            max-width: 960px;
            margin: 4rem auto 5rem;
            padding: 0 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .feature-card img {
            width: 200px;
            height: 200px;
            margin-bottom: 1.2rem;
            object-fit: contain;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 0.75rem;
        }

        .feature-card p {
            font-size: 1rem;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        .popup-card {
            position: fixed;
            bottom: 25px;
            right: 25px;
            max-width: 400px;
            padding: 2rem 2.5rem;
            background: rgba(255, 255, 255, 0.25);
            border: 2px solid var(--primary);
            border-radius: 24px;
            backdrop-filter: blur(20px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-primary);
            z-index: 9999;
            display: none;
            animation: slideIn 0.5s ease;
            text-align: center;
        }

        .popup-card span {
            color: #d71c5c;
        }

        .popup-card:hover {
            transform: scale(1.05);
            cursor: pointer;
            background: rgba(255, 255, 255, 0.35);
        }

        .popup-card .cta-button {
            display: inline-block;
            margin-top: 1rem;
            background: var(--primary);
            color: white;
            padding: 0.6rem 1.4rem;
            border-radius: 30px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .popup-card .cta-button:hover {
            background: #1a7dc0;
        }

        @keyframes slideIn {
            from {
                transform: translateY(100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* --- Footer Styles (already inline, but kept here for completeness) --- */
        footer {
            background: linear-gradient(135deg, var(--blue), var(--mint)); /* Used defined variables */
            color: #fff;
            padding: 3rem 1.5rem;
            font-family: var(--font-main);
            margin-top: 5rem; /* Add some space above the footer */
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

        footer a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: var(--accent); /* A subtle hover effect */
        }

        /* --- Responsive Styles --- */
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

            .hero-images {
                flex-direction: column; /* Stack images on smaller screens */
                padding: 0;
            }

            .hero-img {
                max-width: 250px; /* Adjust size for stacked images */
                margin-bottom: 1.5rem; /* Space between stacked images */
            }

            .center-image {
                margin: 0; /* Remove horizontal margin for stacking */
            }

            header h1 {
                font-size: 3.5rem;
            }

            header p {
                font-size: 1.2rem;
            }

            .flavor-highlight {
                font-size: 1.1rem;
                padding: 0.5rem 1rem;
            }

            .btn-primary {
                padding: 0.8rem 2.5rem;
                font-size: 1.1rem;
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

            header {
                padding: 2rem 1.5rem 3rem;
            }

            header h1 {
                font-size: 3rem;
            }

            header p {
                font-size: 1.1rem;
            }

            .hero-img {
                max-width: 200px;
            }

            section#features {
                margin: 3rem auto 4rem;
                padding: 0 0.8rem;
                grid-template-columns: 1fr; /* Stack features on very small screens */
            }

            .feature-card img {
                width: 150px;
                height: 150px;
            }

            .popup-card {
                bottom: 15px;
                right: 15px;
                max-width: 300px;
                padding: 1.5rem 2rem;
                font-size: 1rem;
            }

            footer div {
                flex-direction: column;
                gap: 2rem;
                text-align: center;
            }

            footer h2, footer h3 {
                font-size: 1.8rem;
            }

            footer p {
                font-size: 1rem;
            }

            footer div:last-child {
                justify-content: center; /* Center social icons */
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

            header h1 {
                font-size: 2.5rem;
            }
            header p {
                font-size: 1rem;
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

    <main>
        <header>
            <div class="hero-images">
                <img src="images/HomePage_IceCream2.jpg" alt="Left Side Ice" class="hero-img" />
                <div class="center-image">
                    <img src="images/HomePage_IceCream.jpg" alt="Main Ice Cream" class="hero-img" />
                </div>
                <img src="images/HomePage_IceCream3.jpg" alt="Right Side Ice" class="hero-img" />
            </div>
            <h1>IceCo</h1>
            <p>Experience the purest, crystal-clear ice crafted to elevate your beverages and keep them perfectly chilled.</p>
            <div class="flavor-highlight">Now featuring 100+ premium quality flavors!</div>
            <br />
            <a href="NewProductPage.php" class="btn-primary">Order Now</a>
        </header>

        <section id="features">
            <div class="feature-card">
                <img src="images/Fast_Delivary.jpg" alt="Fast Delivery Icon" />
                <h3>Fast Delivery</h3>
                <p>Get your ice delivered in under 30 minutes. Guaranteed freshness and quality.</p>
            </div>
            <div class="feature-card">
                <img src="images/Quality.jpg" alt="Quality Products Icon" />
                <h3>Quality Products</h3>
                <p>We use filtered, UV-treated water for the cleanest and clearest ice you'll ever taste.</p>
            </div>
            <div class="feature-card">
                <img src="images/LotsOfFlavors.jpg" alt="Lots of Flavors Icon" />
                <h3>Lots of Flavors</h3>
                <p>Choose from over 100 unique flavors — fruity, creamy, exotic, and more!</p>
            </div>
        </section>

        <div id="popupCard" class="popup-card">
            🎉 <span>NEW:</span> Customize your own Ice Cream! <br />
            <a href="Custom_IceCreame.php" class="cta-button">Try Now 🍨</a>
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
        // Navigation JavaScript
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

        // Popup Card JavaScript
        const popup = document.getElementById('popupCard');
        setInterval(() => {
            popup.style.display = 'block';
            setTimeout(() => {
                popup.style.display = 'none';
            }, 3000);
        }, 5000);
    </script>

</body>
</html>