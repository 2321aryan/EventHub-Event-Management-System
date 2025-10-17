<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$message = "";

// Try multiple database connection methods
$conn = null;
$db_type = '';

// Method 1: Try PDO MySQL
if (extension_loaded('pdo_mysql')) {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=eventhub", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db_type = 'pdo';
    } catch(PDOException $e) {
        $conn = null;
    }
}

// Method 2: Try MySQLi
if (!$conn && extension_loaded('mysqli')) {
    $conn = @mysqli_connect("localhost", "root", "", "eventhub");
    if ($conn) {
        $db_type = 'mysqli';
    }
}

// Method 3: Fallback to file-based system
if (!$conn) {
    $db_type = 'file';
    $users_file = 'users.json';
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
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $user = null;

    if ($db_type === 'pdo') {
        // PDO method
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } elseif ($db_type === 'mysqli') {
        // MySQLi method
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    } elseif ($db_type === 'file') {
        // File-based method
        $users_data = file_get_contents($users_file);
        $users = json_decode($users_data, true);
        foreach ($users as $u) {
            if ($u['email'] === $email) {
                $user = $u;
                break;
            }
        }
    }

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "<p class='error'>❌ Invalid email or password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EventHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">🥂🎊EventHub</div>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>
</header>

<section class="auth-section">
    <div class="auth-container">
        <h2>Login to EventHub</h2>
        
        <div style="background: <?php echo $db_type === 'pdo' ? '#d4edda' : ($db_type === 'mysqli' ? '#fff3cd' : '#f8d7da'); ?>; padding: 10px; border-radius: 5px; margin: 10px 0;">
            <small>
                <?php 
                if ($db_type === 'pdo') echo "✅ Using PDO MySQL Database";
                elseif ($db_type === 'mysqli') echo "⚠️ Using MySQLi Database";
                else echo "📁 Using File-based Storage (Demo: demo@eventhub.com / password)";
                ?>
            </small>
        </div>
        
        <?php echo $message; ?>
        
        <form action="login.php" method="POST" class="auth-form">
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        
        <p class="auth-link">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</section>

<footer>
    <p>© 2025 EventHub | Designed for Memorable Moments 💖</p>
</footer>

</body>
</html>
