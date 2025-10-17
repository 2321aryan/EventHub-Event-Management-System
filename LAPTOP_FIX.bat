@echo off
title EventHub - Laptop Fix
color 0E
cls
echo.
echo  ==========================================
echo  🔧 EventHub - Laptop Connection Fix
echo  ==========================================
echo.
echo  This will fix the "localhost refused to connect" error
echo.
pause

echo  📋 Checking system...
echo.

REM Check if we're in the right folder
if not exist "login.php" (
    echo  ❌ Error: Run this from the EventHub folder
    echo     The folder should contain login.php
    pause
    exit /b 1
)

echo  ✅ EventHub files found
echo.

REM Check for XAMPP
if exist "C:\xampp\xampp-control.exe" (
    echo  ✅ XAMPP found
) else (
    echo  ❌ XAMPP not installed
    echo.
    echo  📥 Installing XAMPP is required:
    echo     1. Go to: https://www.apachefriends.org/
    echo     2. Download XAMPP for Windows
    echo     3. Install to C:\xampp\ (default)
    echo     4. Run this script again
    echo.
    set /p "open=Open download page? (y/n): "
    if /i "%open%"=="y" start "" "https://www.apachefriends.org/download.html"
    pause
    exit /b 1
)

echo  📁 Copying files to web directory...
echo.

REM Create directory if it doesn't exist
if not exist "C:\xampp\htdocs\eventhub\" mkdir "C:\xampp\htdocs\eventhub\"

REM Copy all files
xcopy /s /e /y "*.*" "C:\xampp\htdocs\eventhub\" >nul 2>&1

if exist "C:\xampp\htdocs\eventhub\login.php" (
    echo  ✅ Files copied successfully
) else (
    echo  ❌ File copy failed - check permissions
    pause
    exit /b 1
)

echo.
echo  🚀 Starting XAMPP...
echo.

REM Start XAMPP Control Panel
start "" "C:\xampp\xampp-control.exe"

echo  ⚠️  IMPORTANT STEPS IN XAMPP:
echo     1. Click START next to Apache
echo     2. Click START next to MySQL  
echo     3. Wait for GREEN "Running" status
echo.

echo  Waiting 10 seconds for you to start services...
timeout /t 10 >nul

echo  🌐 Testing connection...
echo.

REM Test different URLs
echo  Opening test pages...
start "" "C:\xampp\htdocs\eventhub\offline_test.html"
timeout /t 2 >nul

start "" "http://localhost/eventhub/quick_test.html"
timeout /t 2 >nul

start "" "http://localhost:8080/eventhub/quick_test.html"

echo.
echo  ==========================================
echo  🎯 Fix Complete!
echo  ==========================================
echo.
echo  📍 Try these URLs:
echo     http://localhost/eventhub/
echo     http://localhost:8080/eventhub/
echo     http://127.0.0.1/eventhub/
echo.
echo  🔐 Demo Login:
echo     Email: demo@eventhub.com
echo     Password: password
echo.
echo  ❌ If still not working:
echo     1. Ensure Apache shows GREEN in XAMPP
echo     2. Check Windows Firewall
echo     3. Try restarting XAMPP
echo     4. Restart the laptop
echo.
echo  Press any key to exit...
pause >nul