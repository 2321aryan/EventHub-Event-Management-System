<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EventHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">🥂🎊EventHub</div>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="index.html">Home</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section class="dashboard-section">
    <div class="dashboard-container">
        <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user']); ?>! 🎉</h1>
        <p>Manage your events and bookings from your personal dashboard.</p>
        
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <h3>📅 My Events</h3>
                <p>View and manage your upcoming events</p>
                <div class="card-number">0</div>
            </div>
            
            <div class="dashboard-card">
                <h3>📋 Bookings</h3>
                <p>Track your event bookings and requests</p>
                <div class="card-number">0</div>
            </div>
            
            <div class="dashboard-card">
                <h3>💬 Messages</h3>
                <p>Check messages from our event team</p>
                <div class="card-number">0</div>
            </div>
            
            <div class="dashboard-card">
                <h3>⚙️ Settings</h3>
                <p>Update your profile and preferences</p>
                <div class="card-number">•••</div>
            </div>
        </div>
        
        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <a href="booking.php" class="action-btn">📝 Plan New Event</a>
                <a href="#" class="action-btn">📞 Contact Support</a>
                <a href="index.html" class="action-btn">🏠 Back to Home</a>
            </div>
        </div>
    </div>
</section>

<footer>
    <p>© 2025 EventHub | Your Event Management Partner 💖</p>
</footer>

</body>
</html>
