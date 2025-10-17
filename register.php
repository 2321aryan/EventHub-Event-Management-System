<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email_exists = false;

    if ($db_type === 'pdo') {
        // PDO method
        $check = $conn->prepare("SELECT * FROM users WHERE email=?");
        $check->execute([$email]);
        $result = $check->fetch();
        $email_exists = (bool)$result;
        
        if (!$email_exists) {
            try {
                $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$name, $email, $password]);
                $message = "<p class='success'>✅ Registration successful! <a href='login.php'>Login here</a></p>";
            } catch(PDOException $e) {
                $message = "<p class='error'>❌ Error: " . $e->getMessage() . "</p>";
            }
        }
    } elseif ($db_type === 'mysqli') {
        // MySQLi method
        $check = $conn->prepare("SELECT * FROM users WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();
        $email_exists = ($result->num_rows > 0);
        
        if (!$email_exists) {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $password);
            if ($stmt->execute()) {
                $message = "<p class='success'>✅ Registration successful! <a href='login.php'>Login here</a></p>";
            } else {
                $message = "<p class='error'>❌ Error: " . $stmt->error . "</p>";
            }
        }
    } elseif ($db_type === 'file') {
        // File-based method
        $users_data = file_get_contents($users_file);
        $users = json_decode($users_data, true);
        
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $email_exists = true;
                break;
            }
        }
        
        if (!$email_exists) {
            $new_user = [
                'id' => count($users) + 1,
                'name' => $name,
                'email' => $email,
                'password' => $password
            ];
            $users[] = $new_user;
            
            if (file_put_contents($users_file, json_encode($users, JSON_PRETTY_PRINT))) {
                $message = "<p class='success'>✅ Registration successful! <a href='login.php'>Login here</a></p>";
            } else {
                $message = "<p class='error'>❌ Error saving user data.</p>";
            }
        }
    }

    if ($email_exists) {
        $message = "<p class='error'>⚠️ Email already registered!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EventHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">🥂🎊EventHub</div>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
</header>

<section class="auth-section">
    <div class="auth-container">
        <h2>Create Your Account</h2>
        
        <div style="background: <?php echo $db_type === 'pdo' ? '#d4edda' : ($db_type === 'mysqli' ? '#fff3cd' : '#f8d7da'); ?>; padding: 10px; border-radius: 5px; margin: 10px 0;">
            <small>
                <?php 
                if ($db_type === 'pdo') echo "✅ Using PDO MySQL Database";
                elseif ($db_type === 'mysqli') echo "⚠️ Using MySQLi Database";
                else echo "📁 Using File-based Storage";
                ?>
            </small>
        </div>
        
        <?php echo $message; ?>
        
        <form action="register.php" method="POST" class="auth-form">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required minlength="6">
            <button type="submit" class="btn">Register</button>
        </form>
        
        <p class="auth-link">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</section>

<footer>
    <p>© 2025 EventHub | Designed for Memorable Moments 💖</p>
</footer>

</body>
</html>
