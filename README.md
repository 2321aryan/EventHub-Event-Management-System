# EventHub - Event Management System

A modern, responsive web application for event planning and management built with PHP and MySQL.

## Features

- 🎉 **User Authentication** - Secure registration and login system
- 📅 **Event Booking** - Comprehensive booking form with multiple services
- 🎪 **Service Showcase** - Display of available event services
- 📱 **Responsive Design** - Works on all devices
- 🎨 **Modern UI** - Beautiful gradients and animations
- 👤 **User Dashboard** - Personal event management area

## Setup Instructions

### Prerequisites
- Web server with PHP support (XAMPP, WAMP, MAMP, or similar)
- MySQL database
- PHP 7.4 or higher

### Installation Steps

1. **Start your web server** (Apache) and MySQL service

2. **Create the database:**
   - Open phpMyAdmin or MySQL command line
   - Import the `setup_database.sql` file to create the database and tables

3. **Configure database connection:**
   - Check `config.php` for database settings
   - Default settings: host=localhost, user=root, password="", database=eventhub

4. **Place files in web directory:**
   - Copy all project files to your web server directory (htdocs for XAMPP)

5. **Access the application:**
   - Open browser and navigate to `http://localhost/your-project-folder`

### Default Login (if using sample data)
- Email: demo@eventhub.com
- Password: password

## File Structure

```
eventhub/
├── index.html          # Landing page
├── login.php           # User login
├── register.php        # User registration
├── dashboard.php       # User dashboard
├── booking.php         # Event booking form
├── about.php           # About page
├── services.php        # Services showcase
├── contact.php         # Contact form
├── logout.php          # Logout handler
├── config.php          # Database configuration
├── style.css           # Styling
├── setup_database.sql  # Database setup
└── README.md           # This file
```

## Usage

1. **Homepage** - Browse services and company information
2. **Register** - Create a new user account
3. **Login** - Access your personal dashboard
4. **Dashboard** - View your events and bookings
5. **Book Event** - Fill out the comprehensive booking form
6. **Services** - Explore available packages and pricing

## Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Design:** Responsive CSS Grid/Flexbox, CSS Gradients, Animations

## Contact Information

- 📧 Email: eventhub@04.com
- 📞 Phone: +91 6354840438, 8160997933

---
© 2025 EventHub | Designed for Memorable Moments 💖