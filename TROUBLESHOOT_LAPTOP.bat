@echo off
title EventHub - Laptop Troubleshooting
color 0C
echo.
echo  ==========================================
echo  🔧 EventHub - Laptop Troubleshooting
echo  ==========================================
echo.

echo  📋 Step 1: Checking XAMPP Installation...
echo.

if exist "C:\xampp\xampp-control.exe" (
    echo  ✅ XAMPP Control Panel found
) else (
    echo  ❌ XAMPP not installed on this laptop
    echo.
    echo  📥 Please install XAMPP:
    echo     1. Download from: https://www.apachefriends.org/
    echo     2. Install to C:\xampp\ (default location)
    echo     3. Run this script again
    echo.
    set /p "choice=Do you want to download XAMPP now? (y/n): "
    if /i "%choice%"=="y" (
        start "" "https://www.apachefriends.org/download.html"
    )
    pause
    exit /b 1
)

echo  📋 Step 2: Checking EventHub Files...
echo.

if exist "login.php" (
    echo  ✅ EventHub files found in current directory
) else (
    echo  ❌ EventHub files not found
    echo     Please ensure you're running this from the eventhub folder
    echo     containing login.php and other files
    pause
    exit /b 1
)

echo  📋 Step 3: Checking File Location...
echo.

if exist "C:\xampp\htdocs\eventhub\login.php" (
    echo  ✅ EventHub properly installed in htdocs
) else (
    echo  ❌ EventHub not in correct location
    echo.
    echo  📁 Installing EventHub to correct location...
    
    if not exist "C:\xampp\htdocs\" (
        echo  ❌ XAMPP htdocs folder not found
        pause
        exit /b 1
    )
    
    mkdir "C:\xampp\htdocs\eventhub" 2>nul
    xcopy /s /e /y "*.*" "C:\xampp\htdocs\eventhub\" >nul 2>&1
    
    if exist "C:\xampp\htdocs\eventhub\login.php" (
        echo  ✅ Files copied successfully
    ) else (
        echo  ❌ File copy failed
        pause
        exit /b 1
    )
)

echo  📋 Step 4: Starting XAMPP Services...
echo.

echo  🚀 Opening XAMPP Control Panel...
start "" "C:\xampp\xampp-control.exe"

echo.
echo  ⚠️  IMPORTANT: In XAMPP Control Panel:
echo     1. Click "Start" next to Apache
echo     2. Click "Start" next to MySQL
echo     3. Both should show GREEN "Running" status
echo.

echo  📋 Step 5: Testing Ports...
echo.

timeout /t 5 >nul

netstat -an | findstr ":80.*LISTENING" >nul 2>&1
if %errorlevel% equ 0 (
    echo  ✅ Port 80 is active
    set "URL=http://localhost/eventhub/"
) else (
    netstat -an | findstr ":8080.*LISTENING" >nul 2>&1
    if %errorlevel% equ 0 (
        echo  ✅ Port 8080 is active
        set "URL=http://localhost:8080/eventhub/"
    ) else (
        echo  ❌ No web server ports detected
        echo     Please start Apache in XAMPP Control Panel
        set "URL=http://localhost/eventhub/"
    )
)

echo.
echo  📋 Step 6: Testing Application...
echo.

echo  🌐 Attempting to open EventHub...
echo     URL: %URL%
echo.

start "EventHub" "%URL%quick_test.html"

echo  ==========================================
echo  🎯 Troubleshooting Complete!
echo  ==========================================
echo.
echo  📍 EventHub URLs to try:
echo     %URL%quick_test.html
echo     %URL%index.html
echo     %URL%login.php
echo.
echo  🔐 Demo Login:
echo     Email: demo@eventhub.com
echo     Password: password
echo.
echo  ❌ If still not working:
echo     1. Ensure Apache is RUNNING (green) in XAMPP
echo     2. Check Windows Firewall
echo     3. Try: http://127.0.0.1/eventhub/
echo     4. Restart XAMPP services
echo.
echo  Press any key to exit...
pause >nul