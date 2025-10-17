<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Try multiple database connection methods
$conn = null;
$db_type = '';

// Method 1: Try PDO MySQL
if (extension_loaded('pdo_mysql')) {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=eventhub", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db_type = 'pdo';
    } catch(PDOException $e) {
        $conn = null;
    }
}

// Method 2: Try MySQLi
if (!$conn && extension_loaded('mysqli')) {
    $conn = @mysqli_connect("localhost", "root", "", "eventhub");
    if ($conn) {
        $db_type = 'mysqli';
    }
}

// Method 3: Fallback to file-based system
if (!$conn) {
    $db_type = 'file';
    $bookings_file = 'bookings.json';
    if (!file_exists($bookings_file)) {
        file_put_contents($bookings_file, json_encode([], JSON_PRETTY_PRINT));
    }
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID from session (default to 1 if not set)
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
    
    // Prepare data
    $event_name = trim($_POST['event_name']);
    $event_type = trim($_POST['event_type']);
    $event_date = trim($_POST['event_date']);
    $event_time = trim($_POST['event_time']);
    $guests = (int)$_POST['guests'];
    $venue = trim($_POST['venue']);
    $budget = trim($_POST['budget']);
    $phone = trim($_POST['phone']);
    $special_requests = trim($_POST['special_requests']);
    
    if ($db_type === 'pdo') {
        // PDO method
        try {
            $stmt = $conn->prepare("INSERT INTO bookings (user_id, event_name, event_type, event_date, event_time, guests, venue, budget, phone, special_requests) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $event_name, $event_type, $event_date, $event_time, $guests, $venue, $budget, $phone, $special_requests]);
            $message = "<p class='success'>✅ Booking request submitted successfully! We'll contact you soon.</p>";
        } catch(PDOException $e) {
            $message = "<p class='error'>❌ Database error: " . $e->getMessage() . "</p>";
        }
    } elseif ($db_type === 'mysqli') {
        // MySQLi method
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, event_name, event_type, event_date, event_time, guests, venue, budget, phone, special_requests) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssissss", $user_id, $event_name, $event_type, $event_date, $event_time, $guests, $venue, $budget, $phone, $special_requests);
        
        if ($stmt->execute()) {
            $message = "<p class='success'>✅ Booking request submitted successfully! We'll contact you soon.</p>";
        } else {
            $message = "<p class='error'>❌ Error: " . $stmt->error . "</p>";
        }
    } elseif ($db_type === 'file') {
        // File-based method
        $bookings_data = file_get_contents($bookings_file);
        $bookings = json_decode($bookings_data, true);
        
        $new_booking = [
            'id' => count($bookings) + 1,
            'user_id' => $user_id,
            'event_name' => $event_name,
            'event_type' => $event_type,
            'event_date' => $event_date,
            'event_time' => $event_time,
            'guests' => $guests,
            'venue' => $venue,
            'budget' => $budget,
            'phone' => $phone,
            'special_requests' => $special_requests,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];
        $bookings[] = $new_booking;
        
        if (file_put_contents($bookings_file, json_encode($bookings, JSON_PRETTY_PRINT))) {
            $message = "<p class='success'>✅ Booking request submitted successfully! We'll contact you soon.</p>";
        } else {
            $message = "<p class='error'>❌ Error saving booking data.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Event - EventHub</title>
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section class="booking-section">
    <div class="booking-container">
        <h1>Book Your Event</h1>
        <p>Fill out the form below to request a booking for your special event.</p>
        
        <?php echo $message; ?>
        
        <form class="booking-form" action="booking.php" method="POST">
            <div class="form-section">
                <h3>Event Details</h3>
                <div class="form-row">
                    <input type="text" name="event_name" placeholder="Event Name" required>
                    <select name="event_type" required>
                        <option value="">Select Event Type</option>
                        <option value="wedding">Wedding</option>
                        <option value="birthday">Birthday Party</option>
                        <option value="corporate">Corporate Event</option>
                        <option value="anniversary">Anniversary</option>
                        <option value="graduation">Graduation</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-row">
                    <input type="date" name="event_date" required>
                    <input type="time" name="event_time" required>
                </div>
                
                <div class="form-row">
                    <input type="number" name="guests" placeholder="Number of Guests" min="1" required>
                    <input type="text" name="venue" placeholder="Preferred Venue (Optional)">
                </div>
            </div>
            
            <div class="form-section">
                <h3>Services Required</h3>
                <div class="checkbox-grid">
                    <label><input type="checkbox" name="services[]" value="planning"> Event Planning</label>
                    <label><input type="checkbox" name="services[]" value="catering"> Catering</label>
                    <label><input type="checkbox" name="services[]" value="decoration"> Decoration</label>
                    <label><input type="checkbox" name="services[]" value="photography"> Photography</label>
                    <label><input type="checkbox" name="services[]" value="entertainment"> Entertainment</label>
                    <label><input type="checkbox" name="services[]" value="transportation"> Transportation</label>
                </div>
            </div>
            
            <div class="form-section">
                <h3>Budget & Additional Info</h3>
                <div class="form-row">
                    <select name="budget" required>
                        <option value="">Select Budget Range</option>
                        <option value="25000-50000">₹25,000 - ₹50,000</option>
                        <option value="50000-100000">₹50,000 - ₹1,00,000</option>
                        <option value="100000-200000">₹1,00,000 - ₹2,00,000</option>
                        <option value="200000+">₹2,00,000+</option>
                    </select>
                    <input type="tel" name="phone" placeholder="Contact Number" required>
                </div>
                
                <textarea name="special_requests" placeholder="Special requests or additional information..." rows="4"></textarea>
            </div>
            
            <button type="submit" class="btn booking-btn">Submit Booking Request</button>
        </form>
    </div>
</section>

<footer>
    <p>© 2025 EventHub | Your Event Management Partner 💖</p>
</footer>

</body>
</html>