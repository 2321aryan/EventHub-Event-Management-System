<?php
echo "<h1>Web Server PHP Test</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>PHP Path: " . PHP_BINARY . "</p>";
echo "<p>Extensions loaded: " . count(get_loaded_extensions()) . "</p>";

echo "<h2>PDO Extensions:</h2>";
echo "PDO: " . (extension_loaded('pdo') ? '✅ Yes' : '❌ No') . "<br>";
echo "PDO MySQL: " . (extension_loaded('pdo_mysql') ? '✅ Yes' : '❌ No') . "<br>";
echo "MySQLi: " . (extension_loaded('mysqli') ? '✅ Yes' : '❌ No') . "<br>";

if (extension_loaded('pdo_mysql')) {
    echo "<h2>Database Connection Test:</h2>";
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=eventhub", "root", "");
        echo "✅ PDO MySQL connection successful!<br>";
        $pdo = null;
    } catch(PDOException $e) {
        echo "❌ PDO MySQL connection failed: " . $e->getMessage() . "<br>";
    }
}

echo "<h2>All Extensions:</h2>";
$extensions = get_loaded_extensions();
sort($extensions);
foreach($extensions as $ext) {
    echo "• $ext<br>";
}
?>