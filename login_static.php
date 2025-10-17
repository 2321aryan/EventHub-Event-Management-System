<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = "";

// Static demo login for testing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Demo credentials
    if ($email === "demo@eventhub.com" && $password === "password") {
        $message = "<p style='color: green; padding: 10px; background: #d4edda; border-radius: 5px;'>✅ Login successful! Welcome Demo User!</p>";
    } else {
        $message = "<p style='color: red; padding: 10px; background: #f8d7da; border-radius: 5px;'>❌ Invalid credentials. Try: demo@eventhub.com / password</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EventHub (Static Demo)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">🥂🎊EventHub</div>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="register_static.php">Register</a></li>
            <li><a href="phpinfo.php">PHP Info</a></li>
        </ul>
    </nav>
</header>

<section class="auth-section">
    <div class="auth-container">
        <h2>Login to EventHub (Demo Mode)</h2>
        
        <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h4>Demo Credentials:</h4>
            <p><strong>Email:</strong> demo@eventhub.com</p>
            <p><strong>Password:</strong> password</p>
        </div>
        
        <?php echo $message; ?>
        
        <form action="login_static.php" method="POST" class="auth-form">
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        
        <p class="auth-link">Don't have an account? <a href="register_static.php">Register here</a></p>
        
        <div style="margin-top: 20px; padding: 10px; background: #e9ecef; border-radius: 5px;">
            <h4>Troubleshooting:</h4>
            <p><a href="phpinfo.php">Check PHP Configuration</a></p>
            <p><a href="test.html">Test HTML</a></p>
        </div>
    </div>
</section>

<footer>
    <p>© 2025 EventHub | Designed for Memorable Moments 💖</p>
</footer>

</body>
</html>