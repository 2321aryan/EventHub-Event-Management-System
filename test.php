<?php
echo "<h1>PHP Extension Check</h1>";
echo "PHP Version: " . phpversion() . "<br><br>";

echo "<h2>Available Extensions:</h2>";
$extensions = get_loaded_extensions();
sort($extensions);
foreach($extensions as $ext) {
    echo "✅ " . $ext . "<br>";
}

echo "<br><h2>MySQL Related Extensions:</h2>";
echo "MySQLi: " . (extension_loaded('mysqli') ? '✅ Yes' : '❌ No') . "<br>";
echo "PDO: " . (extension_loaded('pdo') ? '✅ Yes' : '❌ No') . "<br>";
echo "PDO MySQL: " . (extension_loaded('pdo_mysql') ? '✅ Yes' : '❌ No') . "<br>";
echo "MySQL (old): " . (extension_loaded('mysql') ? '✅ Yes' : '❌ No') . "<br>";

echo "<br><h2>Database Connection Tests:</h2>";

// Test PDO
if (extension_loaded('pdo_mysql')) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=eventhub", "root", "");
        echo "✅ PDO connection: Success<br>";
        $pdo = null;
    } catch(PDOException $e) {
        echo "❌ PDO connection: Failed - " . $e->getMessage() . "<br>";
    }
}

// Test MySQLi
if (extension_loaded('mysqli')) {
    $conn = @mysqli_connect("localhost", "root", "", "eventhub");
    if ($conn) {
        echo "✅ MySQLi connection: Success<br>";
        mysqli_close($conn);
    } else {
        echo "❌ MySQLi connection: Failed - " . mysqli_connect_error() . "<br>";
    }
}

echo "<br><a href='simple_login.php'>Test Simple Login</a><br>";
echo "<a href='login_debug.php'>Test Debug Login</a><br>";
?>