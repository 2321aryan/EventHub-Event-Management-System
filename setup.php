<?php
// Quick database setup script
$host = "localhost";
$user = "root";
$pass = "";

// Create connection
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS eventhub";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select database
$conn->select_db("eventhub");

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Users table created successfully<br>";
} else {
    echo "Error creating users table: " . $conn->error . "<br>";
}

// Create bookings table
$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_name VARCHAR(200) NOT NULL,
    event_type VARCHAR(50) NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    guests INT NOT NULL,
    venue VARCHAR(200),
    budget VARCHAR(50),
    phone VARCHAR(20),
    special_requests TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Bookings table created successfully<br>";
} else {
    echo "Error creating bookings table: " . $conn->error . "<br>";
}

// Insert demo user
$demo_password = password_hash('password', PASSWORD_DEFAULT);
$sql = "INSERT IGNORE INTO users (name, email, password) VALUES ('Demo User', 'demo@eventhub.com', '$demo_password')";

if ($conn->query($sql) === TRUE) {
    echo "Demo user created successfully<br>";
    echo "<strong>Demo Login:</strong><br>";
    echo "Email: demo@eventhub.com<br>";
    echo "Password: password<br><br>";
} else {
    echo "Error creating demo user: " . $conn->error . "<br>";
}

echo "<br><h3>🎉 Setup Complete!</h3>";
echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h4>Next Steps:</h4>";
echo "<ol>";
echo "<li><a href='index.html' style='color: #155724; font-weight: bold;'>🏠 Go to EventHub Homepage</a></li>";
echo "<li><a href='login.php' style='color: #155724; font-weight: bold;'>🔐 Test Login Page</a></li>";
echo "<li><a href='register.php' style='color: #155724; font-weight: bold;'>📝 Register New Account</a></li>";
echo "</ol>";
echo "</div>";

echo "<div style='background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h4>📋 Demo Account Details:</h4>";
echo "<p><strong>Email:</strong> demo@eventhub.com</p>";
echo "<p><strong>Password:</strong> password</p>";
echo "</div>";

$conn->close();
?>