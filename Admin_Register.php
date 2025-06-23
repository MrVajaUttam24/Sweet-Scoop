<?php
// DB credentials - update if needed
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "icecreamshop";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['sub'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (strlen($username) > 30) {
        $message = "Username cannot exceed 30 characters.";
    } elseif (strlen($password) > 12) {
        $message = "Password cannot exceed 12 characters.";
    } else {
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            $message = "Connection failed: " . $conn->connect_error;
        } else {
            $stmt = $conn->prepare("INSERT INTO admintbl (username, password) VALUES (?, ?)");
            if ($stmt) {
                $stmt->bind_param("ss", $username, $password);
                if ($stmt->execute()) {
                    $message = "Registration successful!";
                } else {
                    $message = "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $message = "Prepare failed: " . $conn->error;
            }
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            font-size: 18px;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: url('https://images.unsplash.com/photo-1505253210349-640a9f1f6b40?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
            background-size: cover;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(224, 247, 250, 0.7);
            z-index: 0;
        }

        .login-box {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 500px;
            background: #ffffffcc;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 3px solid #7ed6c1;
            backdrop-filter: blur(10px);
            margin: auto;
        }

        .login-box h2 {
            color: #1e5ba0;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .form-control {
            height: 55px;
            font-size: 18px;
            border-radius: 12px;
            border: 2px solid #b2ebf2;
            padding-right: 45px;
        }

        input[type="submit"] {
            background-color: #1e5ba0;
            color: white;
            font-size: 20px;
            height: 50px;
            border-radius: 12px;
            border: none;
            width: 180px;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #144275;
        }

        .ice-cream-icon {
            width: 80px;
            margin-bottom: 10px;
        }

        .table td {
            padding: 15px 0;
        }

        .password-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 25px;
            height: 25px;
            fill: #1e5ba0;
            transition: fill 0.3s ease;
        }

        .toggle-password:hover {
            fill: #144275;
        }

        .register-text {
            margin-top: 20px;
            font-size: 16px;
        }

        .register-text a {
            color: #1e5ba0;
            text-decoration: none;
            font-weight: 600;
        }

        .register-text a:hover {
            color: #144275;
            text-decoration: underline;
        }

        .message {
            margin-bottom: 15px;
            font-weight: 600;
            color: green;
        }

        .error {
            color: red;
        }

        footer {
            background: linear-gradient(135deg, #1e5ba0, #7ed6c1);
            color: #fff;
            padding: 3rem 1.5rem;
            font-family: 'Poppins', sans-serif;
        }

        footer h2, footer h3 {
            margin-bottom: 1rem;
        }

        footer p {
            font-size: 1.15rem;
            line-height: 1.7;
        }

        footer .social-icons a {
            color: white;
        }

        footer .social-icons a:hover {
            opacity: 0.85;
        }

        footer .footer-bottom {
            text-align: center;
            margin-top: 3rem;
            border-top: 1px solid rgba(255,255,255,0.3);
            padding-top: 1rem;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="https://cdn-icons-png.flaticon.com/512/2351/2351628.png" alt="Ice Cream Icon" class="ice-cream-icon" />
        <h2><u>ADMIN REGISTER</u><br><br>Welcome to <br><font size="32px"> Sweet Scoop</font></h2>

        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'successful') !== false ? '' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <table width="100%" class="table">
                <tr>
                    <td colspan="2">
                        <input type="text" maxlength="30" class="form-control" name="username" placeholder="Enter Your Name" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="password-wrapper">
                            <input type="password" maxlength="12" class="form-control" name="password" id="password" placeholder="Enter Your Password" required />
                            <svg class="toggle-password" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="togglePassword" aria-label="Toggle password visibility" role="button" tabindex="0">
                                <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-3.3137 0-6-2.6863-6-6s2.6863-6 6-6 6 2.6863 6 6-2.6863 6-6 6zm0-10a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                                <circle cx="12" cy="12" r="2.5"/>
                            </svg>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Register" id="sub" name="sub"/>
                    </td>
                </tr>
            </table>
        </form>

        <div class="register-text">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>

    <footer>
        <div style="max-width: 1200px; margin: auto; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 3rem;">
            <div style="flex: 1 1 300px;">
                <h2 style="font-family: 'Comfortaa', cursive; font-size: 2.2rem;">Sweet Scoop</h2>
                <p>Delight in every scoop! Premium handcrafted ice creams made with love and the finest ingredients. Visit us or order online today.</p>
            </div>

            <div style="flex: 1 1 250px;">
                <h3>Contact Info</h3>
                <p><strong>Address:</strong><br>123 Sweet Street, Candy City</p>
                <p><strong>Email:</strong><br>info@sweetscoop.com</p>
                <p><strong>Phone:</strong><br>+1 (234) 567-890</p>
            </div>

            <div style="flex: 1 1 200px;">
                <h3>Follow Us</h3>
                <div class="social-icons" style="display: flex; gap: 1.2rem;">
                    <a href="#" aria-label="LinkedIn" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 24 24">
                            <path d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8.5h4V24h-4V8.5zM8.5 8.5h3.5v2.25h.05c.49-.94 1.7-2.25 3.45-2.25 3.7 0 4.5 2.44 4.5 5.63V24h-4v-8c0-1.91-.03-4.38-2.67-4.38-2.68 0-3.09 2.09-3.09 4.25V24h-4V8.5z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="GitHub" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 24 24">
                            <path d="M12 .5a12 12 0 00-3.8 23.4c.6.1.8-.2.8-.5v-2.2c-3.3.7-4-1.6-4-1.6-.5-1.3-1.1-1.6-1.1-1.6-.9-.7.1-.7.1-.7 1 .1 1.5 1 1.5 1 .9 1.5 2.3 1 2.9.7.1-.6.3-1 .5-1.2-2.7-.3-5.5-1.3-5.5-5.9 0-1.3.5-2.4 1.2-3.3-.1-.3-.5-1.4.1-2.9 0 0 1-.3 3.3 1.2a11.5 11.5 0 016 0c2.2-1.5 3.2-1.2 3.2-1.2.6 1.5.2 2.6.1 2.9.8.9 1.2 2 1.2 3.3 0 4.6-2.8 5.6-5.5 5.9.4.3.6.8.6 1.6v2.4c0 .3.2.6.8.5A12 12 0 0012 .5z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?php echo date("Y"); ?> Sweet Scoop. All rights reserved.
        </div>
    </footer>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            togglePassword.style.fill = type === 'text' ? '#144275' : '#1e5ba0';
        });

        togglePassword.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                togglePassword.click();
            }
        });
    </script>
</body>
</html>
