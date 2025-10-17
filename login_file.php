<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$message = "";
$users_file = 'users.json';

// Create users file if it doesn't exist
if (!file_exists($users_file)) {
    $default_users = [
        [
            'id' => 1,
            'name' => 'Demo User',
            'email' => 'demo@eventhub.com',
            'password' => password_hash('password', PASSWORD_DEFAULT)
        ]
    ];
    file_put_contents($users_file, json_encode($default_users, JSON_PRETTY_PRINT));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Read users from file
    $users_data = file_get_contents($users_file);
    $users = json_decode($users_data, true);
    
    $user_found = false;
    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: dashboard_file.php");
            exit();
        }
    }
    
    if (!$user_found) {
        $message = "<p class='error'>❌ Invalid email or password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EventHub (File-based)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">🥂🎊EventHub</div>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="register_file.php">Register</a></li>
            <li><a href="php_config_check.php">PHP Config</a></li>
        </ul>
    </nav>
</header>

<section class="auth-section">
    <div class="auth-container">
        <h2>Login to EventHub</h2>
        
        <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h4>📋 Demo Account:</h4>
            <p><strong>Email:</strong> demo@eventhub.com</p>
            <p><strong>Password:</strong> password</p>
        </div>
        
        <?php echo $message; ?>
        
        <form action="login_file.php" method="POST" class="auth-form">
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        
        <p class="auth-link">Don't have an account? <a href="register_file.php">Register here</a></p>
        
        <div style="margin-top: 20px; padding: 10px; background: #d4edda; border-radius: 5px;">
            <p><strong>✅ This version uses file-based storage (no database required)</strong></p>
        </div>
    </div>
</section>

<footer>
    <p>© 2025 EventHub | Designed for Memorable Moments 💖</p>
</footer>

</body>
</html>