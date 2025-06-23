<?php
    if(isset($_POST['login']))
    {
        $conn = mysqli_connect("localhost","root","","icecreamshop")
        or
        die();

        $nm = $_POST['username'];
        $pass = $_POST['password'];

        $str = "select * from admintbl where username='$nm' AND password='$pass'";

        $res = mysqli_query($conn,$str);
        $row = mysqli_fetch_array($res);

        if(isset($row))
        {
            header("Location:Display_Order.php");		
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Ice Cream Login</title>
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
            align-items: center;
            justify-content: center;
            background: url('https://images.unsplash.com/photo-1505253210349-640a9f1f6b40?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
            background-size: cover;
            position: relative;
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
            border: 3px solid #b2dfdb;
            backdrop-filter: blur(10px);
        }

        .login-box h2 {
            color: #0077b6;
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
            background-color: #0077b6;
            color: white;
            font-size: 20px;
            height: 50px;
            border-radius: 12px;
            border: none;
            width: 180px;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #005f8a;
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
            fill: #0077b6;
            transition: fill 0.3s ease;
        }

        .toggle-password:hover {
            fill: #005f8a;
        }

        .register-text {
            margin-top: 20px;
            font-size: 16px;
        }

        .register-text a {
            color: #0077b6;
            text-decoration: none;
            font-weight: 600;
        }

        .register-text a:hover {
            color: #005f8a;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="https://cdn-icons-png.flaticon.com/512/2351/2351628.png" alt="Ice Cream Icon" class="ice-cream-icon" />
        <h2><u>ADMIN LOGIN</u><br><br>Welcome to <br><font size="32px"> Sweet Scoop</font></h2>

        <form method="POST">
            <table width="100%" class="table">
                <tr>
                    <td colspan="2">
                        <input type="text" class="form-control" name="username" placeholder="Enter Your Name" required />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="password-wrapper">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password" required />
                            <svg class="toggle-password" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="togglePassword" aria-label="Toggle password visibility" role="button" tabindex="0">
                                <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-3.3137 0-6-2.6863-6-6s2.6863-6 6-6 6 2.6863 6 6-2.6863 6-6 6zm0-10a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                                <circle cx="12" cy="12" r="2.5"/>
                            </svg>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="login" value="Login" />
                    </td>
                </tr>
            </table>
        </form>

        <div class="register-text">
            No account? <a href="admin_register.php">Register</a>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            togglePassword.style.fill = type === 'text' ? '#005f8a' : '#0077b6';
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
