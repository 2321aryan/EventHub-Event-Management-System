<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Read existing users
    $users_data = file_get_contents($users_file);
    $users = json_decode($users_data, true);
    
    // Check if email already exists
    $email_exists = false;
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $email_exists = true;
            break;
        }
    }
    
    if ($email_exists) {
        $message = "<p class='error'>⚠️ Email already registered!</p>";
    } else {
        // Add new user
        $new_user = [
            'id' => count($users) + 1,
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
        $users[] = $new_user;
        
        // Save to file
        if (file_put_contents($users_file, json_encode($users, JSON_PRETTY_PRINT))) {
            $message = "<p class='success'>✅ Registration successful! <a href='login_file.php'>Login here</a></p>";
        } else {
            $message = "<p class='error'>❌ Error saving user data.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EventHub (File-based)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">🥂🎊EventHub</div>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="login_file.php">Login</a></li>
        </ul>
    </nav>
</header>

<section class="auth-section">
    <div class="auth-container">
        <h2>Create Your Account</h2>
        
        <div style="background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p><strong>✅ File-based Registration</strong> - No database required!</p>
        </div>
        
        <?php echo $message; ?>
        
        <form action="register_file.php" method="POST" class="auth-form">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required minlength="6">
            <button type="submit" class="btn">Register</button>
        </form>
        
        <p class="auth-link">Already have an account? <a href="login_file.php">Login here</a></p>
    </div>
</section>

<footer>
    <p>© 2025 EventHub | Designed for Memorable Moments 💖</p>
</footer>

</body>
</html>