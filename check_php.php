<?php
echo "<h1>PHP Configuration Check</h1>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p><strong>Current Script:</strong> " . $_SERVER['SCRIPT_NAME'] . "</p>";

// Check if MySQL extension is loaded
if (extension_loaded('mysqli')) {
    echo "<p style='color: green;'>✅ MySQLi extension is loaded</p>";
} else {
    echo "<p style='color: red;'>❌ MySQLi extension is NOT loaded</p>";
}

// Test database connection
try {
    $conn = new mysqli("localhost", "root", "", "eventhub");
    if ($conn->connect_error) {
        echo "<p style='color: red;'>❌ Database connection failed: " . $conn->connect_error . "</p>";
    } else {
        echo "<p style='color: green;'>✅ Database connection successful</p>";
        $conn->close();
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Database error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h2>Next Steps:</h2>";
echo "<ol>";
echo "<li><a href='setup.php'>Setup Database</a></li>";
echo "<li><a href='index.html'>Go to Homepage</a></li>";
echo "<li><a href='login.php'>Test Login Page</a></li>";
echo "</ol>";
?>