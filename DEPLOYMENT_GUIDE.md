# EventHub - Deployment Guide

## 📦 Portable Deployment Instructions

This EventHub project is designed to be **fully portable** and can be moved to any PC with XAMPP.

### ✅ What's Included
- Complete PHP application with hybrid database support
- Auto-setup scripts for database creation
- Fallback to file-based storage if database unavailable
- Responsive design and all assets
- Demo data and user accounts

### 🚀 Quick Setup on New PC

#### Step 1: Prerequisites
- Install XAMPP (Apache + MySQL + PHP)
- Download from: https://www.apachefriends.org/

#### Step 2: Deploy Application
1. **Extract** the EventHub zip file
2. **Copy** the entire `eventhub` folder to `C:\xampp\htdocs\`
3. **Start** XAMPP Control Panel
4. **Start** Apache and MySQL services
5. **Run** `start.bat` (double-click)

#### Step 3: Access Application
- The start.bat will automatically:
  - Set up the database
  - Create demo user
  - Open the application in browser
- URL: `http://localhost:8080/eventhub/` (or `http://localhost/eventhub/`)

### 🔧 Manual Setup (if needed)

If start.bat doesn't work:

1. **Check XAMPP Services**
   - Open XAMPP Control Panel
   - Start Apache (should show green "Running")
   - Start MySQL (should show green "Running")

2. **Setup Database**
   - Go to: `http://localhost/eventhub/setup.php`
   - This creates database and demo user

3. **Test Application**
   - Go to: `http://localhost/eventhub/login.php`
   - Use demo credentials: `demo@eventhub.com` / `password`

### 🎯 Demo Credentials
- **Email**: demo@eventhub.com
- **Password**: password

### 🔍 Troubleshooting

#### Port Issues
- If port 80 is busy, XAMPP might use port 8080
- Try: `http://localhost:8080/eventhub/`

#### Database Issues
- The app automatically falls back to file-based storage
- Check: `http://localhost/eventhub/connection_test.php`

#### PHP Issues
- Check: `http://localhost/eventhub/web_php_test.php`
- Ensure XAMPP's Apache is running

### 📁 File Structure
```
eventhub/
├── index.html          # Homepage
├── login.php           # Login (hybrid database)
├── register.php        # Registration (hybrid database)
├── dashboard.php       # User dashboard
├── booking.php         # Event booking
├── setup.php           # Database setup
├── start.bat           # Auto-start script
├── style.css           # Styling
├── config.php          # Database config
└── README.md           # Documentation
```

### 🌟 Features
- ✅ **Hybrid Database Support** - Works with MySQL or file storage
- ✅ **Auto-Setup** - Creates database and demo data automatically
- ✅ **Responsive Design** - Works on all devices
- ✅ **Secure Authentication** - Password hashing and sessions
- ✅ **Event Management** - Full booking and management system

### 📞 Support
If you encounter issues:
1. Check XAMPP services are running
2. Visit troubleshooting page: `http://localhost/eventhub/connection_test.php`
3. Ensure no firewall blocking ports 80/8080 and 3306

---
© 2025 EventHub | Portable Event Management System