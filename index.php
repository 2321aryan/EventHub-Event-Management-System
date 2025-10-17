<?php
// Welcome page with proper navigation
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub - Welcome</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 15px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .logo { font-size: 2rem; margin-bottom: 20px; }
        .btn { display: inline-block; padding: 12px 24px; margin: 10px; background: linear-gradient(45deg, #667eea, #764ba2); color: white; text-decoration: none; border-radius: 25px; font-weight: bold; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .status { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; }
        .info { background: #d1ecf1; color: #0c5460; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">🥂🎊 EventHub</div>
        <h1>Welcome to EventHub!</h1>
        <p>Your complete event management solution</p>
        
        <?php
        // Check if PHP is working
        echo "<div class='status success'>✅ PHP is working! Version: " . phpversion() . "</div>";
        
        // Check database connection
        try {
            $conn = new mysqli("localhost", "root", "", "eventhub");
            if ($conn->connect_error) {
                echo "<div class='status info'>📝 Database setup needed - Click 'Setup Database' below</div>";
            } else {
                echo "<div class='status success'>✅ Database connected successfully!</div>";
                $conn->close();
            }
        } catch (Exception $e) {
            echo "<div class='status info'>📝 Database setup needed - Click 'Setup Database' below</div>";
        }
        ?>
        
        <div style="margin: 30px 0;">
            <a href="setup.php" class="btn">🔧 Setup Database</a>
            <a href="index.html" class="btn">🏠 Enter EventHub</a>
        </div>
        
        <div style="margin: 20px 0;">
            <a href="troubleshoot.php" class="btn" style="background: #6c757d;">🔍 Troubleshoot</a>
            <a href="check_php.php" class="btn" style="background: #6c757d;">⚙️ System Check</a>
        </div>
        
        <hr style="margin: 30px 0;">
        <h3>Quick Access</h3>
        <p><a href="login.php">Login</a> | <a href="register.php">Register</a> | <a href="contact.php">Contact</a></p>
        
        <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <strong>Demo Account:</strong><br>
            Email: demo@eventhub.com<br>
            Password: password
        </div>
    </div>
</body>
</html>