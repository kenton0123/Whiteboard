<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Whiteboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.10);
            width: 100%;
            max-width: 400px;
            padding: 40px 32px 32px;
            border-top: 4px solid #292961;
        }

        .brand {
            text-align: center;
            margin-bottom: 8px;
        }

        .brand i {
            font-size: 48px;
            color: #292961;
        }

        .brand h1 {
            font-size: 26px;
            color: #292961;
            margin-top: 6px;
        }

        .brand h1 span {
            font-weight: 700;
        }

        .subtitle {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            font-size: 15px;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            outline: none;
        }

        .form-group input:focus {
            border-color: #292961;
            box-shadow: 0 0 0 3px rgba(41, 41, 97, 0.15);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background-color: #292961;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 4px;
        }

        .btn-login:hover {
            background-color: #1e1e4a;
        }

        .links {
            text-align: center;
            margin-top: 22px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .links a {
            color: #292961;
            text-decoration: none;
            font-size: 14px;
            transition: text-decoration 0.2s;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .error-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #fef2f2;
            border-left: 4px solid #dc2626;
            color: #b91c1c;
            padding: 12px 14px;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .error-box i {
            font-size: 18px;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand">
            <i class="fas fa-chalkboard"></i>
            <h1><span>Whiteboard</span></h1>
        </div>
        <p class="subtitle">Sign in to your account</p>

        <?php
        if (isset($_COOKIE['loginError'])) {
            $errorMessage = $_COOKIE['loginError'];
            setcookie('loginError', '', time() - 600, '/');
        }

        if (isset($errorMessage)) {
            echo '<div class="error-box"><i class="fas fa-exclamation-circle"></i> ' . htmlspecialchars($errorMessage) . '</div>';
        }
        ?>

        <form method="post" action="validateLogin.php">
            <div class="form-group">
                <label for="id">Student ID</label>
                <input type="text" id="id" name="id" placeholder="Enter your student ID" required>
            </div>

            <div class="form-group">
                <label for="pw">Password</label>
                <input type="password" id="pw" name="pw" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="links">
            <a href="forgot_password.php">Forgot your password?</a>
            <a href="Createacc.php">Don't have an account?</a>
        </div>
    </div>

</body>
</html>
