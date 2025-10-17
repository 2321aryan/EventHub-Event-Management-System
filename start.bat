@echo off
title EventHub - Event Management System
color 0A
echo.
echo  ========================================
echo  🎉 EventHub - Event Management System
echo  ========================================
echo.

REM Check if XAMPP is installed
if exist "C:\xampp\php\php.exe" (
    echo  ✅ XAMPP found
) else (
    echo  ❌ XAMPP not found - Please install XAMPP first
    echo     Download: https://www.apachefriends.org/
    pause
    exit /b 1
)

echo  📊 Setting up database...
C:\xampp\php\php.exe setup.php >nul 2>&1

echo  🔍 Detecting server port...

REM Check which port Apache is using
netstat -an | findstr ":8080.*LISTENING" >nul 2>&1
if %errorlevel% equ 0 (
    set "URL=http://localhost:8080/eventhub/"
    echo  ✅ Server detected on port 8080
) else (
    netstat -an | findstr ":80.*LISTENING" >nul 2>&1
    if %errorlevel% equ 0 (
        set "URL=http://localhost/eventhub/"
        echo  ✅ Server detected on port 80
    ) else (
        set "URL=http://localhost:8080/eventhub/"
        echo  ⚠️  No server detected - trying port 8080
    )
)

echo.
echo  🚀 Opening EventHub...
echo     URL: %URL%
echo.

REM Open the quick test page first
start "EventHub Test" "%URL%quick_test.html"
timeout /t 2 >nul

REM Then open the main application
start "EventHub Main" "%URL%index.html"

echo  ========================================
echo  🎯 EventHub URLs:
echo  ========================================
echo.
echo  🏠 Homepage:  %URL%index.html
echo  🔧 Test:      %URL%quick_test.html
echo  🔐 Login:     %URL%login.php
echo  📝 Register:  %URL%register.php
echo.
echo  🎯 Demo Account:
echo     Email:    demo@eventhub.com
echo     Password: password
echo.
echo  💡 If pages don't load:
echo     1. Check XAMPP Control Panel
echo     2. Start Apache and MySQL
echo     3. Try: %URL%connection_test.php
echo.
echo  Press any key to exit...
pause >nul