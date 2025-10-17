<?php
echo "<h1>Path Test</h1>";
echo "<p><strong>Current Directory:</strong> " . __DIR__ . "</p>";
echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p><strong>Script Name:</strong> " . $_SERVER['SCRIPT_NAME'] . "</p>";
echo "<p><strong>Request URI:</strong> " . $_SERVER['REQUEST_URI'] . "</p>";

echo "<h2>Correct URLs for your setup:</h2>";
$folder_name = basename(__DIR__);
echo "<ul>";
echo "<li><a href='http://localhost/" . urlencode($folder_name) . "/index.php'>Welcome Page</a></li>";
echo "<li><a href='http://localhost/" . urlencode($folder_name) . "/index.html'>Homepage</a></li>";
echo "<li><a href='http://localhost/" . urlencode($folder_name) . "/setup.php'>Database Setup</a></li>";
echo "</ul>";

echo "<h3>Copy these URLs:</h3>";
echo "<code>http://localhost/" . urlencode($folder_name) . "/index.php</code><br>";
echo "<code>http://localhost/" . urlencode($folder_name) . "/index.html</code><br>";
?>