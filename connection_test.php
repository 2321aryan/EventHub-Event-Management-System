<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Database Connection Test</h1>";

echo "<h2>PHP Extensions:</h2>";
echo "PDO: " . (extension_loaded('pdo') ? '✅ Yes' : '❌ No') . "<br>";
echo "PDO MySQL: " . (extension_loaded('pdo_mysql') ? '✅ Yes' : '❌ No') . "<br>";
echo "MySQLi: " . (extension_loaded('mysqli') ? '✅ Yes' : '❌ No') . "<br>";

echo "<h2>Connection Tests:</h2>";

// Test PDO
if (extension_loaded('pdo_mysql')) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=eventhub", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "✅ PDO MySQL: Connection successful<br>";
        
        // Test query
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
        $result = $stmt->fetch();
        echo "✅ PDO MySQL: Found " . $result['count'] . " users in database<br>";
        
        $pdo = null;
    } catch(PDOException $e) {
        echo "❌ PDO MySQL: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ PDO MySQL extension not available<br>";
}

// Test MySQLi
if (extension_loaded('mysqli')) {
    $conn = @mysqli_connect("localhost", "root", "", "eventhub");
    if ($conn) {
        echo "✅ MySQLi: Connection successful<br>";
        
        // Test query
        $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM users");
        $row = mysqli_fetch_assoc($result);
        echo "✅ MySQLi: Found " . $row['count'] . " users in database<br>";
        
        mysqli_close($conn);
    } else {
        echo "❌ MySQLi: " . mysqli_connect_error() . "<br>";
    }
} else {
    echo "❌ MySQLi extension not available<br>";
}

echo "<h2>Next Steps:</h2>";
echo "<a href='login.php'>Test Login Page</a><br>";
echo "<a href='register.php'>Test Register Page</a><br>";
echo "<a href='web_php_test.php'>Full PHP Info</a><br>";
?>