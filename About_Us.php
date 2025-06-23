<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>About Us - Sweet Scoop</title>

    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600;700&family=Quicksand:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

    <style>
        /* Variables from Navigation */
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

        /* Reset and base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif; /* Adjusted for consistency with main page */
            background: linear-gradient(to right top, #e7f5ff, #eef8ff); /* Background from Navigation */
            color: #222;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
            min-height: 100vh; /* Ensure body takes full height */
            display: flex;
            flex-direction: column;
        }

        a {
            color: #2a6fdb;
            text-decoration: none;
            transition: color 0.4s ease;
        }

        a:hover {
            color: #a2f5dc;
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
            margin-right: 40px; /* Added space here */
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

        /* --- About Us Page Styles --- */
        .container {
            max-width: 1100px;
            margin: 2.5rem auto 5rem;
            padding: 0 1.5rem;
            flex-grow: 1; /* Allows the container to push the footer down */
            margin-top: 5rem; /* Added space between navigation and actual design */
        }

        /* Header */
        header {
            text-align: center;
            margin-bottom: 3rem;
            animation: headerZoomIn 1.5s ease forwards;
            opacity: 0;
            transform: scale(0.8);
        }

        header h1 {
            font-family: 'Comfortaa', cursive;
            font-size: 3.4rem;
            color: #2a6fdb;
            text-shadow:
                0 0 10px rgba(42, 111, 219, 0.5);
        }

        header p {
            margin-top: 0.8rem;
            font-size: 1.25rem;
            color: #555;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            font-weight: 500;
        }

        /* About Section */
        .about-section {
            display: flex;
            gap: 3rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .about-text,
        .about-image {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .about-text.visible,
        .about-image.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .about-text {
            flex: 1 1 480px;
        }

        .about-text h2 {
            font-family: 'Comfortaa', cursive;
            font-size: 2.4rem;
            margin-bottom: 1rem;
            color: #2a6fdb;
            text-shadow: 0 0 5px rgba(42, 111, 219, 0.7);
        }

        .about-text p {
            font-size: 1.15rem;
            margin-bottom: 1.3rem;
            color: #444;
            letter-spacing: 0.02em;
        }

        .about-text ul {
            list-style: none;
            padding-left: 0;
            margin-top: 1rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
        }

        .about-text ul li {
            background: #a2f5dc;
            color: #0c3f34;
            padding: 0.7rem 1.2rem;
            border-radius: 25px;
            font-weight: 600;
            box-shadow: 0 0 8px #a2f5dcaa;
            font-size: 1rem;
            user-select: none;
            cursor: default;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .about-text ul li:hover {
            box-shadow: 0 0 18px #2a6fdb;
            transform: translateY(-5px);
        }

        /* Image */
        .about-image {
            flex: 1 1 420px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 24px rgba(42, 111, 219, 0.3);
            cursor: pointer;
            animation: float 6s ease-in-out infinite;
            will-change: transform;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .about-image img {
            width: 100%;
            display: block;
            object-fit: cover;
            height: 320px;
            border-radius: 16px;
            filter: drop-shadow(0 4px 10px rgba(162, 245, 220, 0.5));
            transition: filter 0.3s ease;
            will-change: filter, transform;
        }

        .about-image:hover {
            box-shadow: 0 18px 36px rgba(42, 111, 219, 0.6);
            transform: scale(1.05);
            animation-play-state: paused;
        }

        .about-image:hover img {
            filter: drop-shadow(0 8px 20px rgba(162, 245, 220, 0.8));
        }

        /* Our Story Section */
        .story-section {
            margin-top: 5rem;
            background: linear-gradient(135deg, #b5b8ff, #a2f5dc);
            border-radius: 20px;
            padding: 3rem 2rem;
            color: #0c3f34;
            box-shadow: 0 8px 25px rgba(42, 111, 219, 0.3);
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .story-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .story-section h2 {
            font-family: 'Comfortaa', cursive;
            font-size: 2.6rem;
            margin-bottom: 1.5rem;
            text-align: center;
            text-shadow: 0 0 7px #0c3f34cc;
        }

        .story-section p {
            max-width: 900px;
            margin: 0 auto;
            font-size: 1.2rem;
            font-weight: 500;
            line-height: 1.8;
            letter-spacing: 0.015em;
            text-align: center;
        }

        /* Footer placeholder */
        footer {
            background: linear-gradient(135deg, #2a6fdb, #a2f5dc);
            color: #fff;
            padding: 3rem 1.5rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            user-select: none;
            box-shadow: 0 -5px 15px rgba(42, 111, 219, 0.7);
            margin-top: 8rem; /* Added space between actual design and footer */
            font-family: 'Poppins', sans-serif; /* Keep consistent with the main body */
        }

        footer .footer-content {
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

        footer .social-icons {
            display: flex;
            gap: 1.2rem;
        }

        footer .social-icons a {
            color: white; /* Ensure icons are white as per original footer */
        }

        footer .copyright {
            text-align: center;
            margin-top: 3rem;
            border-top: 1px solid rgba(255,255,255,0.3);
            padding-top: 1rem;
            font-size: 1rem;
        }

        /* Animations */
        @keyframes headerZoomIn {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-12px);
            }
        }

        /* Responsive About Us Page */
        @media (max-width: 900px) {
            .about-section {
                flex-direction: column;
                text-align: center;
            }
            .about-text ul {
                justify-content: center; /* Center list items when stacked */
            }
            .about-text ul li {
                margin: 0.4rem 0.6rem 0.6rem 0.6rem;
            }
            .about-image {
                max-width: 320px;
                margin: 0 auto;
            }
            footer .footer-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            footer .footer-content > div {
                margin-bottom: 2rem;
            }
            footer .social-icons {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 2.4rem;
            }

            .about-text h2 {
                font-size: 2rem;
            }

            .story-section h2 {
                font-size: 2rem;
            }
            footer h2 {
                font-size: 1.8rem;
            }
            footer h3 {
                font-size: 1.3rem;
            }
            footer p {
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

    <div class="container">

        <header>
            <h1>About Sweet Scoop</h1>
            <p>Discover our passion for crafting the creamiest, most delightful ice cream that brings smiles to every scoop.</p>
        </header>

        <section class="about-section">
            <div class="about-text">
                <h2>Who We Are</h2>
                <p>Sweet Scoop is more than just an ice cream shop. We are a team of passionate artisans dedicated to creating the freshest and most flavorful ice cream using only the finest ingredients. Each scoop is made with love, creativity, and a sprinkle of magic.</p>
                <p>Our mission is to make every visit a joyful and delicious experience, bringing people together with the sweet taste of happiness.</p>
                <ul>
                    <li>Locally Sourced Ingredients</li>
                    <li>Unique and Classic Flavors</li>
                    <li>Handcrafted in Small Batches</li>
                    <li>Committed to Sustainability</li>
                    <li>Friendly Community Vibes</li>
                </ul>
            </div>
            <div class="about-image" aria-label="Ice cream display">
                <img src="images/AboutUsImage.jpg" alt="Assorted ice cream scoops in waffle cones" />
            </div>
        </section>

        <section class="story-section" aria-label="Our story">
            <h2>Our Story</h2>
            <p>
                Founded in 2010, Sweet Scoop started as a small neighborhood ice cream cart with a big dream — to create unforgettable flavors that remind people of their fondest memories. Over the years, our commitment to quality and community has made us a beloved local staple. From classic vanilla bean to adventurous lavender honey, our flavors celebrate both tradition and innovation.
            </p>
        </section>

    </div>

    <footer>
        <div class="footer-content">

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
            &copy; 2025 Sweet Scoop. All rights reserved.
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

        // Scroll-triggered animation for fade-in
        function onEntry(entry) {
            entry.forEach(change => {
                if (change.isIntersecting) {
                    change.target.classList.add('visible');
                }
            });
        }

        let options = { threshold: [0.2] };
        let observer = new IntersectionObserver(onEntry, options);

        document.querySelectorAll('.about-text, .about-image, .story-section').forEach(el => {
            observer.observe(el);
        });
    </script>

</body>
</html>