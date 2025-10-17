<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub Troubleshooting</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; }
        .success { color: #155724; background: #d4edda; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { color: #721c24; background: #f8d7da; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .info { color: #0c5460; background: #d1ecf1; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .step { background: #e9ecef; padding: 15px; margin: 10px 0; border-left: 4px solid #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 EventHub Troubleshooting Guide</h1>
        
        <?php
        echo "<h2>System Check</h2>";
        
        // Check PHP
        if (function_exists('phpversion')) {
            echo "<div class='success'>✅ PHP is working - Version: " . phpversion() . "</div>";
        } else {
            echo "<div class='error'>❌ PHP is not working properly</div>";
        }
        
        // Check MySQL
        if (extension_loaded('mysqli')) {
            echo "<div class='success'>✅ MySQLi extension loaded</div>";
            
            // Test database connection
            $conn = @new mysqli("localhost", "root", "", "eventhub");
            if ($conn->connect_error) {
                echo "<div class='error'>❌ Database 'eventhub' not found or connection failed</div>";
                echo "<div class='info'>📝 Run setup.php to create the database</div>";
            } else {
                echo "<div class='success'>✅ Database connection successful</div>";
                
                // Check tables
                $tables = ['users', 'bookings'];
                foreach ($tables as $table) {
                    $result = $conn->query("SHOW TABLES LIKE '$table'");
                    if ($result->num_rows > 0) {
                        echo "<div class='success'>✅ Table '$table' exists</div>";
                    } else {
                        echo "<div class='error'>❌ Table '$table' missing</div>";
                    }
                }
                $conn->close();
            }
        } else {
            echo "<div class='error'>❌ MySQLi extension not loaded</div>";
        }
        
        // Check file permissions
        $files = ['index.html', 'login.php', 'register.php', 'config.php'];
        foreach ($files as $file) {
            if (file_exists($file)) {
                echo "<div class='success'>✅ File '$file' exists</div>";
            } else {
                echo "<div class='error'>❌ File '$file' missing</div>";
            }
        }
        ?>
        
        <h2>📋 Step-by-Step Fix</h2>
        
        <div class="step">
            <h3>Step 1: XAMPP Setup</h3>
            <p>1. Open XAMPP Control Panel</p>
            <p>2. Start <strong>Apache</strong> and <strong>MySQL</strong></p>
            <p>3. Both should show <span style="color: green;">green "Running"</span> status</p>
        </div>
        
        <div class="step">
            <h3>Step 2: Database Setup</h3>
            <p>1. <a href="setup.php" target="_blank">Click here to run database setup</a></p>
            <p>2. Or manually go to: <code>http://localhost:8080/eventhub/setup.php</code></p>
        </div>
        
        <div class="step">
            <h3>Step 3: Test PHP Processing</h3>
            <p>1. <a href="check_php.php" target="_blank">Click here to test PHP</a></p>
            <p>2. You should see PHP version info, not raw code</p>
        </div>
        
        <div class="step">
            <h3>Step 4: Access Application</h3>
            <p>1. <a href="index.html" target="_blank">Go to Homepage</a></p>
            <p>2. <a href="login.php" target="_blank">Test Login Page</a></p>
            <p>3. Use demo account: <code>demo@eventhub.com</code> / <code>password</code></p>
        </div>
        
        <h2>🚨 Common Issues & Solutions</h2>
        
        <div class="info">
            <h4>Issue: PHP files show raw HTML code</h4>
            <p><strong>Solution:</strong> Apache is not processing PHP files</p>
            <ul>
                <li>Restart Apache in XAMPP</li>
                <li>Check if .htaccess file exists (created automatically)</li>
                <li>Access via http://localhost/ not file:// protocol</li>
            </ul>
        </div>
        
        <div class="info">
            <h4>Issue: Database connection failed</h4>
            <p><strong>Solution:</strong> MySQL not running or database missing</p>
            <ul>
                <li>Start MySQL in XAMPP Control Panel</li>
                <li>Run setup.php to create database</li>
                <li>Check config.php for correct credentials</li>
            </ul>
        </div>
        
        <div class="info">
            <h4>Issue: 404 Not Found errors</h4>
            <p><strong>Solution:</strong> Files not in correct location</p>
            <ul>
                <li>Ensure files are in C:\xampp\htdocs\eventhub\</li>
                <li>Access via http://localhost:8080/eventhub/</li>
            </ul>
        </div>
        
        <hr>
        <p><strong>Still having issues?</strong> Make sure:</p>
        <ul>
            <li>XAMPP Apache and MySQL are both running (green status)</li>
            <li>You're accessing via http://localhost:8080/ not opening files directly</li>
            <li>Windows Firewall isn't blocking Apache</li>
            <li>No other software is using port 8080 or 3306</li>
        </ul>
    </div>
</body>
</html>