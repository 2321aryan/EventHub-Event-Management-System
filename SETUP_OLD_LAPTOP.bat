@echo off
title EventHub - Old Laptop Setup
color 0A
mode con: cols=80 lines=30
cls

echo.
echo  ================================================================================
echo                          🎉 EventHub - Old Laptop Setup 🎉
echo  ================================================================================
echo.
echo  This script will set up EventHub on your old laptop automatically.
echo  No technical knowledge required - just follow the prompts!
echo.
echo  ⏱️  Estimated time: 2-5 minutes
echo.
pause

:CHECK_FILES
cls
echo.
echo  📋 Step 1/5: Checking EventHub files...
echo.

if not exist "login.php" (
    echo  ❌ ERROR: EventHub files not found!
    echo.
    echo  Please ensure you:
    echo  1. Extracted the EventHub ZIP file completely
    echo  2. Are running this script from the EventHub folder
    echo  3. Can see files like: login.php, index.html, style.css
    echo.
    pause
    exit /b 1
)

echo  ✅ EventHub files found successfully!
timeout /t 2 >nul

:CHECK_XAMPP
cls
echo.
echo  📋 Step 2/5: Checking XAMPP installation...
echo.

if exist "C:\xampp\xampp-control.exe" (
    echo  ✅ XAMPP found at C:\xampp\
    goto :COPY_FILES
)

echo  ❌ XAMPP not found on this laptop
echo.
echo  📥 XAMPP is required to run EventHub. It's free and safe.
echo.
echo  Options:
echo  [1] Download and install XAMPP now (Recommended)
echo  [2] I'll install it manually later
echo  [3] Exit setup
echo.
set /p "choice=Choose option (1-3): "

if "%choice%"=="1" (
    echo.
    echo  🌐 Opening XAMPP download page...
    start "" "https://www.apachefriends.org/download.html"
    echo.
    echo  📋 Installation Instructions:
    echo  1. Download XAMPP for Windows
    echo  2. Run the installer as Administrator
    echo  3. Install to C:\xampp\ (default location)
    echo  4. You can uncheck Mail and FileZilla (not needed)
    echo  5. Complete the installation
    echo  6. Run this setup script again
    echo.
    pause
    exit /b 0
)

if "%choice%"=="2" (
    echo.
    echo  📝 Manual Installation Notes:
    echo  - Download from: https://www.apachefriends.org/
    echo  - Install to: C:\xampp\
    echo  - Run this script again after installation
    echo.
    pause
    exit /b 0
)

exit /b 0

:COPY_FILES
cls
echo.
echo  📋 Step 3/5: Installing EventHub files...
echo.

echo  📁 Creating web directory...
if not exist "C:\xampp\htdocs\" (
    echo  ❌ XAMPP htdocs folder not found!
    echo  Please reinstall XAMPP properly.
    pause
    exit /b 1
)

if not exist "C:\xampp\htdocs\eventhub\" mkdir "C:\xampp\htdocs\eventhub\"

echo  📋 Copying EventHub files...
xcopy /s /e /y /q "*.*" "C:\xampp\htdocs\eventhub\" >nul 2>&1

if exist "C:\xampp\htdocs\eventhub\login.php" (
    echo  ✅ Files installed successfully!
) else (
    echo  ❌ File installation failed!
    echo  Try running this script as Administrator.
    pause
    exit /b 1
)

timeout /t 2 >nul

:START_XAMPP
cls
echo.
echo  📋 Step 4/5: Starting XAMPP services...
echo.

echo  🚀 Opening XAMPP Control Panel...
start "" "C:\xampp\xampp-control.exe"

echo.
echo  ⚠️  IMPORTANT: In the XAMPP Control Panel window:
echo.
echo  1. Click the "Start" button next to "Apache"
echo  2. Click the "Start" button next to "MySQL"
echo  3. Wait for both to show GREEN "Running" status
echo.
echo  💡 If Apache won't start:
echo  - Try clicking "Stop" then "Start" again
echo  - Close Skype or other programs using port 80
echo  - Run XAMPP as Administrator
echo.

echo  Waiting 15 seconds for you to start the services...
echo  (Press any key to continue early)
timeout /t 15

:TEST_CONNECTION
cls
echo.
echo  📋 Step 5/5: Testing EventHub...
echo.

echo  🌐 Opening EventHub in your browser...
echo.

REM Test offline first
echo  📄 Opening offline test page...
start "" "C:\xampp\htdocs\eventhub\offline_test.html"
timeout /t 3 >nul

REM Test web server
echo  🌐 Testing web server connection...
start "" "http://localhost/eventhub/quick_test.html"
timeout /t 2 >nul

start "" "http://localhost:8080/eventhub/quick_test.html"
timeout /t 2 >nul

REM Open main application
echo  🎉 Opening EventHub application...
start "" "http://localhost/eventhub/index.html"

:SUCCESS
cls
echo.
echo  ================================================================================
echo                              🎉 SETUP COMPLETE! 🎉
echo  ================================================================================
echo.
echo  ✅ EventHub is now installed and running on your old laptop!
echo.
echo  📍 Access URLs:
echo     • http://localhost/eventhub/
echo     • http://localhost:8080/eventhub/
echo     • http://127.0.0.1/eventhub/
echo.
echo  🔐 Demo Account:
echo     Email:    demo@eventhub.com
echo     Password: password
echo.
echo  🎯 What you can do:
echo     • Register new users
echo     • Login and manage events
echo     • Book events and services
echo     • View dashboard and bookings
echo.
echo  🔧 Troubleshooting:
echo     • If pages don't load: Check XAMPP services are running (green)
echo     • If database errors: The app will use file-based storage automatically
echo     • For help: Open offline_test.html from the EventHub folder
echo.
echo  💡 Tips for old laptops:
echo     • Keep XAMPP Control Panel open
echo     • Bookmark: http://localhost/eventhub/
echo     • The app works offline (no internet needed)
echo.
echo  ================================================================================
echo                        🚀 Enjoy using EventHub! 🚀
echo  ================================================================================
echo.
echo  Press any key to exit...
pause >nul

exit /b 0