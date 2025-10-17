<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - EventHub</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<header>
    <div class="logo">🥂🎊EventHub</div>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
</header>

<section class="contact-hero">
    <h1>Get In Touch</h1>
    <p>Ready to plan your perfect event? We're here to help!</p>
</section>

<section class="contact-section">
    <div class="contact-container">
        <div class="contact-info-grid">
            <div class="contact-card">
                <div class="contact-icon">📞</div>
                <h3>Phone</h3>
                <p>+91 6354840438</p>
                <p>+91 8160997933</p>
                <small>Mon-Sat: 9AM-8PM</small>
            </div>
            
            <div class="contact-card">
                <div class="contact-icon">📧</div>
                <h3>Email</h3>
                <p>eventhub@04.com</p>
                <p>info@eventhub.com</p>
                <small>We reply within 24 hours</small>
            </div>
            
            <div class="contact-card">
                <div class="contact-icon">📍</div>
                <h3>Office</h3>
                <p>123 Event Street</p>
                <p>Mumbai, Maharashtra</p>
                <small>Visit us for consultation</small>
            </div>
            
            <div class="contact-card">
                <div class="contact-icon">⏰</div>
                <h3>Working Hours</h3>
                <p>Monday - Saturday</p>
                <p>9:00 AM - 8:00 PM</p>
                <small>Sunday: By appointment</small>
            </div>
        </div>
        
        <div class="contact-form-section">
            <h2>Send us a Message</h2>
            <form class="contact-form" action="contact.php" method="POST">
                <div class="form-row">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-row">
                    <input type="tel" name="phone" placeholder="Phone Number" required>
                    <select name="event_type" required>
                        <option value="">Select Event Type</option>
                        <option value="wedding">Wedding</option>
                        <option value="birthday">Birthday Party</option>
                        <option value="corporate">Corporate Event</option>
                        <option value="anniversary">Anniversary</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-row">
                    <input type="date" name="event_date" required>
                    <input type="number" name="guests" placeholder="Number of Guests" min="1" required>
                </div>
                <textarea name="message" placeholder="Tell us about your event requirements..." rows="5" required></textarea>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
    </div>
</section>

<?php
$contact_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $event_type = htmlspecialchars($_POST['event_type']);
    $event_date = htmlspecialchars($_POST['event_date']);
    $guests = htmlspecialchars($_POST['guests']);
    $message = htmlspecialchars($_POST['message']);
    
    // Basic validation
    if (!empty($name) && !empty($email) && !empty($phone) && !empty($message)) {
        // Here you would typically save to database or send email
        $contact_message = "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                            ✅ Thank you for your message! We will contact you soon.
                           </div>";
    } else {
        $contact_message = "<div style='background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                            ❌ Please fill in all required fields.
                           </div>";
    }
}

// Display message if exists
if (!empty($contact_message)) {
    echo $contact_message;
}
?>

<footer>
    <p>© 2025 EventHub | Designed for Memorable Moments 💖</p>
</footer>

</body>
</html>