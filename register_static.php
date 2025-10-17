<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (strlen($password) >= 6) {
        $message = "<p style='color: green; padding: 10px; background: #d4edda; border-radius: 5px;'>✅ Registration successful for " . htmlspecialchars($name) . "! <a href='login_static.php'>Login here</a></p>";
    } else {
        $message = "<p style='color: red; padding: 10px; background: #f8d7da; border-radius: 5px;'>❌ Password must be at least 6 characters long.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EventHub (Static Demo)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">🥂🎊EventHub</div>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="login_static.php">Login</a></li>
        </ul>
    </nav>
</header>

<section class="auth-section">
    <div class="auth-container">
        <h2>Create Your Account (Demo Mode)</h2>
        
        <div style="background: #d1ecf1; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p><strong>Note:</strong> This is a demo version. Registration data won't be saved to database.</p>
        </div>
        
        <?php echo $message; ?>
        
        <form action="register_static.php" method="POST" class="auth-form">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required minlength="6">
            <button type="submit" class="btn">Register</button>
        </form>
        
        <p class="auth-link">Already have an account? <a href="login_static.php">Login here</a></p>
    </div>
</section>

<footer>
    <p>© 2025 EventHub | Designed for Memorable Moments 💖</p>
</footer>

</body>
</html>