===============================================
🎉 EventHub - Portable Event Management System
===============================================

📦 QUICK DEPLOYMENT GUIDE
===============================================

✅ STEP 1: Install XAMPP
- Download from: https://www.apachefriends.org/
- Install to default location: C:\xampp\
- No special configuration needed

✅ STEP 2: Deploy EventHub
- Extract this ZIP file
- Copy the "eventhub" folder to: C:\xampp\htdocs\
- Final path should be: C:\xampp\htdocs\eventhub\

✅ STEP 3: Start Services
- Open XAMPP Control Panel
- Click "Start" for Apache
- Click "Start" for MySQL
- Both should show green "Running" status

✅ STEP 4: Run Application
- Double-click "start.bat" in the eventhub folder
- This will automatically:
  * Setup the database
  * Create demo user
  * Open the application in browser

🌐 ACCESS URLS
===============================================
- Homepage: http://localhost/eventhub/
- Login: http://localhost/eventhub/login.php
- Register: http://localhost/eventhub/register.php

If port 80 is busy, try:
- http://localhost:8080/eventhub/

🔐 DEMO ACCOUNT
===============================================
Email: demo@eventhub.com
Password: password

🔧 TROUBLESHOOTING
===============================================

❌ Problem: "XAMPP not found"
✅ Solution: Install XAMPP to C:\xampp\

❌ Problem: "Connection refused"
✅ Solution: Start Apache in XAMPP Control Panel

❌ Problem: "Database connection failed"
✅ Solution: Start MySQL in XAMPP Control Panel
           OR the app will use file-based storage automatically

❌ Problem: "Port already in use"
✅ Solution: Try http://localhost:8080/eventhub/

❌ Problem: Blank pages
✅ Solution: Check http://localhost/eventhub/connection_test.php

🎯 FEATURES
===============================================
✅ Hybrid Database Support (MySQL + File fallback)
✅ User Registration & Authentication
✅ Event Booking System
✅ Responsive Design
✅ Admin Dashboard
✅ Automatic Setup
✅ Portable - Works on any Windows PC with XAMPP

📁 WHAT'S INCLUDED
===============================================
- Complete PHP application
- Database setup scripts
- Demo data and users
- Responsive CSS styling
- Auto-start batch file
- Troubleshooting tools
- Documentation

🚀 DEPLOYMENT CHECKLIST
===============================================
□ XAMPP installed at C:\xampp\
□ EventHub folder in C:\xampp\htdocs\eventhub\
□ Apache service started (green in XAMPP)
□ MySQL service started (green in XAMPP)
□ Run start.bat
□ Browser opens to EventHub
□ Login with demo account works

💡 TIPS
===============================================
- The application works even without database
- All user data is automatically backed up
- No internet connection required
- Works on Windows 7, 8, 10, 11
- Compatible with any XAMPP version

📞 SUPPORT
===============================================
If you encounter issues:
1. Check XAMPP services are running
2. Visit: http://localhost/eventhub/connection_test.php
3. Ensure Windows Firewall allows Apache
4. Try different ports (80, 8080)

===============================================
© 2025 EventHub | Portable Event Management
===============================================