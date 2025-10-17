<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Simple Login Test</h1>";
echo "<p>PHP is working!</p>";

// Test database connection
try {
    $conn = new PDO("mysql:host=localhost;dbname=eventhub", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color: green;'>✅ Database connection successful</p>";
    $conn = null;
} catch(PDOException $e) {
    echo "<p style='color: red;'>❌ Database connection failed: " . $e->getMessage() . "</p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p>Form submitted!</p>";
    echo "<p>Email: " . htmlspecialchars($_POST['email']) . "</p>";
}
?>

<form method="POST">
    <p>Email: <input type="email" name="email" required></p>
    <p>Password: <input type="password" name="password" required></p>
    <p><input type="submit" value="Login"></p>
</form>

<p><a href="login.php">Go to Full Login Page</a></p>