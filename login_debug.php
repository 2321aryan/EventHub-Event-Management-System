<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!-- Debug: PHP started -->";

$message = "";

echo "<!-- Debug: Variables initialized -->";

try {
    $conn = new PDO("mysql:host=localhost;dbname=eventhub", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<!-- Debug: Database connected -->";
} catch(PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<!-- Debug: POST request received -->";
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $message = "<p style='color: green;'>✅ Login successful for: " . htmlspecialchars($user['name']) . "</p>";
    } else {
        $message = "<p style='color: red;'>❌ Invalid email or password.</p>";
    }
}

echo "<!-- Debug: PHP logic completed -->";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Debug - EventHub</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 400px; margin: 0 auto; }
        input { width: 100%; padding: 10px; margin: 5px 0; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; }
    </style>
</head>
<body>

<div class="container">
    <h2>Login Debug - EventHub</h2>
    
    <?php echo $message; ?>
    
    <form action="login_debug.php" method="POST">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>
    
    <p><a href="register.php">Register here</a></p>
    <p><a href="simple_login.php">Simple Test</a></p>
    <p><a href="test.php">PHP Info</a></p>
</div>

</body>
</html>