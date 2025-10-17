<?php
echo "<h1>PHP Configuration Analysis</h1>";

echo "<h2>Basic Info:</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "PHP SAPI: " . php_sapi_name() . "<br>";
echo "Server Software: " . (isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'Unknown') . "<br>";

echo "<h2>Configuration Files:</h2>";
echo "Loaded php.ini: " . (php_ini_loaded_file() ?: 'None') . "<br>";
echo "Additional ini files: " . (php_ini_scanned_files() ?: 'None') . "<br>";

echo "<h2>Extension Directory:</h2>";
echo "Extension dir: " . ini_get('extension_dir') . "<br>";

echo "<h2>MySQL Related Extensions:</h2>";
$mysql_extensions = ['mysqli', 'pdo', 'pdo_mysql', 'mysql'];
foreach ($mysql_extensions as $ext) {
    $loaded = extension_loaded($ext);
    echo "$ext: " . ($loaded ? '✅ Loaded' : '❌ Not loaded') . "<br>";
}

echo "<h2>All Loaded Extensions:</h2>";
$extensions = get_loaded_extensions();
sort($extensions);
foreach ($extensions as $ext) {
    echo "• $ext<br>";
}

echo "<h2>Possible Solutions:</h2>";
echo "<ol>";
echo "<li>Check if XAMPP's Apache is using the correct PHP version</li>";
echo "<li>Enable extensions in php.ini file</li>";
echo "<li>Restart Apache after making changes</li>";
echo "<li>Use file-based storage instead of database</li>";
echo "</ol>";

echo "<h2>Quick Tests:</h2>";
echo "<a href='login_static.php'>Test Static Login (No Database)</a><br>";
echo "<a href='test.html'>Test HTML Only</a><br>";
echo "<a href='index.html'>Go to Homepage</a><br>";
?>