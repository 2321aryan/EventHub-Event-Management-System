@echo off
title EventHub Installer
color 0B
echo.
echo  ==========================================
echo  🎉 EventHub Installation Wizard
echo  ==========================================
echo.

REM Check if running from correct location
if not exist "login.php" (
    echo  ❌ Error: Please run this installer from the EventHub folder
    echo     containing login.php and other files.
    echo.
    pause
    exit /b 1
)

echo  📋 Checking installation requirements...
echo.

REM Check if XAMPP exists
if exist "C:\xampp\htdocs\" (
    echo  ✅ XAMPP htdocs folder found
) else (
    echo  ❌ XAMPP not found at C:\xampp\
    echo.
    echo  📥 Please install XAMPP first:
    echo     1. Download from: https://www.apachefriends.org/
    echo     2. Install to default location (C:\xampp\)
    echo     3. Run this installer again
    echo.
    pause
    exit /b 1
)

REM Check if already installed
if exist "C:\xampp\htdocs\eventhub\login.php" (
    echo  ⚠️  EventHub already exists in C:\xampp\htdocs\eventhub\
    echo.
    set /p "choice=Do you want to overwrite? (y/n): "
    if /i not "%choice%"=="y" (
        echo  Installation cancelled.
        pause
        exit /b 0
    )
    echo  🗑️  Removing old installation...
    rmdir /s /q "C:\xampp\htdocs\eventhub" 2>nul
)

echo  📁 Creating installation directory...
mkdir "C:\xampp\htdocs\eventhub" 2>nul

echo  📋 Copying EventHub files...
xcopy /s /e /y "*.*" "C:\xampp\htdocs\eventhub\" >nul 2>&1

if exist "C:\xampp\htdocs\eventhub\login.php" (
    echo  ✅ Files copied successfully
) else (
    echo  ❌ File copy failed
    pause
    exit /b 1
)

echo  🔧 Setting up permissions...
attrib -r "C:\xampp\htdocs\eventhub\*.*" /s >nul 2>&1

echo.
echo  ==========================================
echo  🎉 Installation Complete!
echo  ==========================================
echo.
echo  📍 EventHub installed to: C:\xampp\htdocs\eventhub\
echo.
echo  🚀 Next Steps:
echo     1. Start XAMPP Control Panel
echo     2. Start Apache and MySQL services
echo     3. Run start.bat from the eventhub folder
echo.
echo  🌐 Access URLs:
echo     http://localhost/eventhub/
echo     http://localhost:8080/eventhub/ (if port 80 busy)
echo.
echo  🔐 Demo Login:
echo     Email: demo@eventhub.com
echo     Password: password
echo.

set /p "choice=Do you want to open XAMPP Control Panel now? (y/n): "
if /i "%choice%"=="y" (
    start "" "C:\xampp\xampp-control.exe"
)

echo.
echo  Press any key to exit...
pause >nul