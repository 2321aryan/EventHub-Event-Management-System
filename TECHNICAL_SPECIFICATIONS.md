# EventHub - Technical Specifications

## 🏗️ System Architecture

### **Application Tier Architecture**
```
┌─────────────────────────────────────────────────────────────┐
│                    Presentation Layer                       │
│  ┌─────────────┐ ┌─────────────┐ ┌─────────────────────────┐│
│  │   HTML5     │ │    CSS3     │ │      JavaScript         ││
│  │  Semantic   │ │ Responsive  │ │   Form Validation       ││
│  │   Markup    │ │   Design    │ │   User Interaction      ││
│  └─────────────┘ └─────────────┘ └─────────────────────────┘│
└─────────────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────────────┐
│                    Business Logic Layer                     │
│  ┌─────────────┐ ┌─────────────┐ ┌─────────────────────────┐│
│  │    PHP      │ │  Session    │ │    Authentication       ││
│  │ Server-side │ │ Management  │ │      & Security         ││
│  │   Logic     │ │             │ │                         ││
│  └─────────────┘ └─────────────┘ └─────────────────────────┘│
└─────────────────────────────────────────────────────────────┘
                              │
┌─────────────────────────────────────────────────────────────┐
│                    Data Access Layer                        │
│  ┌─────────────┐ ┌─────────────┐ ┌─────────────────────────┐│
│  │   MySQL     │ │    PDO      │ │      File-based         ││
│  │  Database   │ │   MySQLi    │ │    JSON Storage         ││
│  │             │ │ Abstraction │ │      (Fallback)         ││
│  └─────────────┘ └─────────────┘ └─────────────────────────┘│
└─────────────────────────────────────────────────────────────┘
```

## 🗄️ Database Schema Design

### **Entity Relationship Diagram**
```
┌─────────────────────────────────────┐
│                USERS                │
├─────────────────────────────────────┤
│ id (PK)          │ INT AUTO_INCREMENT│
│ name             │ VARCHAR(100)      │
│ email (UNIQUE)   │ VARCHAR(100)      │
│ password         │ VARCHAR(255)      │
│ created_at       │ TIMESTAMP         │
└─────────────────────────────────────┘
                    │
                    │ 1:N
                    │
┌─────────────────────────────────────┐
│               BOOKINGS              │
├─────────────────────────────────────┤
│ id (PK)          │ INT AUTO_INCREMENT│
│ user_id (FK)     │ INT               │
│ event_name       │ VARCHAR(200)      │
│ event_type       │ VARCHAR(50)       │
│ event_date       │ DATE              │
│ event_time       │ TIME              │
│ guests           │ INT               │
│ venue            │ VARCHAR(200)      │
│ budget           │ VARCHAR(50)       │
│ phone            │ VARCHAR(20)       │
│ special_requests │ TEXT              │
│ status           │ VARCHAR(20)       │
│ created_at       │ TIMESTAMP         │
└─────────────────────────────────────┘
```

### **Database Normalization**
- **First Normal Form (1NF)**: All attributes contain atomic values
- **Second Normal Form (2NF)**: No partial dependencies on composite keys
- **Third Normal Form (3NF)**: No transitive dependencies
- **Referential Integrity**: Foreign key constraints maintain data consistency

## 🔒 Security Implementation

### **Authentication & Authorization**
```php
// Password Security Implementation
class SecurityManager {
    
    // Secure password hashing
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    // Password verification
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    // Session security
    public static function startSecureSession() {
        session_start();
        session_regenerate_id(true);
    }
    
    // Input sanitization
    public static function sanitizeInput($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
}
```

### **SQL Injection Prevention**
```php
// Prepared Statements Implementation
class DatabaseManager {
    
    // PDO Prepared Statement
    public function insertUser($name, $email, $password) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$name, $email, $password]);
    }
    
    // MySQLi Prepared Statement
    public function getUserByEmail($email) {
        $stmt = $this->mysqli->prepare(
            "SELECT * FROM users WHERE email = ?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
```

## 🎨 Frontend Architecture

### **CSS Architecture (BEM Methodology)**
```css
/* Block */
.auth-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Element */
.auth-section__container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

/* Modifier */
.auth-section__container--mobile {
    padding: 20px;
    margin: 20px;
}
```

### **Responsive Design Implementation**
```css
/* Mobile-first approach */
.dashboard-cards {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}

/* Tablet */
@media (min-width: 768px) {
    .dashboard-cards {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Desktop */
@media (min-width: 1024px) {
    .dashboard-cards {
        grid-template-columns: repeat(4, 1fr);
    }
}
```

### **JavaScript Form Validation**
```javascript
class FormValidator {
    constructor(form) {
        this.form = form;
        this.errors = {};
    }
    
    validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    validatePassword(password) {
        return password.length >= 6;
    }
    
    validate() {
        const formData = new FormData(this.form);
        
        // Email validation
        const email = formData.get('email');
        if (!this.validateEmail(email)) {
            this.errors.email = 'Please enter a valid email address';
        }
        
        // Password validation
        const password = formData.get('password');
        if (!this.validatePassword(password)) {
            this.errors.password = 'Password must be at least 6 characters';
        }
        
        return Object.keys(this.errors).length === 0;
    }
}
```

## 🔄 Hybrid Database System

### **Connection Manager Implementation**
```php
class HybridDatabaseManager {
    private $connection;
    private $connectionType;
    
    public function __construct() {
        $this->establishConnection();
    }
    
    private function establishConnection() {
        // Try PDO MySQL first
        if ($this->tryPDOConnection()) {
            $this->connectionType = 'pdo';
            return;
        }
        
        // Try MySQLi second
        if ($this->tryMySQLiConnection()) {
            $this->connectionType = 'mysqli';
            return;
        }
        
        // Fall back to file-based storage
        $this->connectionType = 'file';
        $this->initializeFileStorage();
    }
    
    private function tryPDOConnection() {
        if (!extension_loaded('pdo_mysql')) return false;
        
        try {
            $this->connection = new PDO(
                "mysql:host=localhost;dbname=eventhub", 
                "root", 
                ""
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }
    
    public function insertUser($name, $email, $password) {
        switch($this->connectionType) {
            case 'pdo':
                return $this->insertUserPDO($name, $email, $password);
            case 'mysqli':
                return $this->insertUserMySQLi($name, $email, $password);
            case 'file':
                return $this->insertUserFile($name, $email, $password);
        }
    }
}
```

## 🚀 Deployment Architecture

### **Automated Deployment System**
```batch
@echo off
title EventHub Deployment System

REM System Requirements Check
call :checkXAMPP
call :checkPHPExtensions
call :detectServerPorts

REM Application Deployment
call :copyApplicationFiles
call :setupDatabase
call :configurePermissions

REM Service Management
call :startServices
call :validateDeployment

REM Success Notification
call :displaySuccessMessage
goto :end

:checkXAMPP
if exist "C:\xampp\php\php.exe" (
    echo ✅ XAMPP detected
) else (
    echo ❌ XAMPP not found
    call :installXAMPP
)
goto :eof
```

### **Environment Detection System**
```php
class EnvironmentDetector {
    
    public static function detectPHPExtensions() {
        return [
            'pdo' => extension_loaded('pdo'),
            'pdo_mysql' => extension_loaded('pdo_mysql'),
            'mysqli' => extension_loaded('mysqli'),
            'json' => extension_loaded('json')
        ];
    }
    
    public static function detectServerPorts() {
        $ports = [];
        
        // Check common web server ports
        $testPorts = [80, 8080, 8000, 3000];
        
        foreach($testPorts as $port) {
            if (self::isPortOpen('localhost', $port)) {
                $ports[] = $port;
            }
        }
        
        return $ports;
    }
    
    private static function isPortOpen($host, $port) {
        $connection = @fsockopen($host, $port, $errno, $errstr, 1);
        if ($connection) {
            fclose($connection);
            return true;
        }
        return false;
    }
}
```

## 📊 Performance Optimization

### **Database Query Optimization**
```sql
-- Indexed queries for better performance
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_booking_user_id ON bookings(user_id);
CREATE INDEX idx_booking_date ON bookings(event_date);
CREATE INDEX idx_booking_status ON bookings(status);

-- Optimized query examples
SELECT b.*, u.name as user_name 
FROM bookings b 
JOIN users u ON b.user_id = u.id 
WHERE b.event_date >= CURDATE() 
ORDER BY b.event_date ASC 
LIMIT 10;
```

### **Frontend Performance**
```css
/* CSS Optimization */
.hero-section {
    /* Use transform instead of changing layout properties */
    transform: translateY(0);
    transition: transform 0.3s ease;
}

.hero-section:hover {
    transform: translateY(-5px);
}

/* Optimize images */
.event-image {
    width: 100%;
    height: auto;
    object-fit: cover;
    loading: lazy; /* Native lazy loading */
}
```

## 🧪 Testing & Quality Assurance

### **Testing Strategy**
```php
class EventHubTester {
    
    public function testDatabaseConnection() {
        $manager = new HybridDatabaseManager();
        return $manager->testConnection();
    }
    
    public function testUserRegistration() {
        $testData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'testpassword123'
        ];
        
        return $this->registerUser($testData);
    }
    
    public function testFormValidation() {
        $validator = new FormValidator();
        
        // Test valid email
        assert($validator->validateEmail('user@example.com') === true);
        
        // Test invalid email
        assert($validator->validateEmail('invalid-email') === false);
        
        // Test password strength
        assert($validator->validatePassword('123456') === true);
        assert($validator->validatePassword('123') === false);
    }
}
```

## 📈 Scalability Considerations

### **Horizontal Scaling Preparation**
```php
// Session management for load balancing
ini_set('session.save_handler', 'files');
ini_set('session.save_path', '/shared/sessions');

// Database connection pooling preparation
class ConnectionPool {
    private static $connections = [];
    private static $maxConnections = 10;
    
    public static function getConnection() {
        if (count(self::$connections) < self::$maxConnections) {
            $connection = new PDO(/* connection params */);
            self::$connections[] = $connection;
            return $connection;
        }
        
        // Return existing connection
        return self::$connections[array_rand(self::$connections)];
    }
}
```

## 🔧 Development Tools & Utilities

### **Debug and Monitoring Tools**
```php
class DebugManager {
    
    public static function logError($message, $context = []) {
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'message' => $message,
            'context' => $context,
            'trace' => debug_backtrace()
        ];
        
        file_put_contents(
            'logs/error.log', 
            json_encode($logEntry) . "\n", 
            FILE_APPEND
        );
    }
    
    public static function profileQuery($query, $params = []) {
        $startTime = microtime(true);
        
        // Execute query
        $result = $this->executeQuery($query, $params);
        
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000; // Convert to milliseconds
        
        if ($executionTime > 100) { // Log slow queries
            self::logError("Slow query detected", [
                'query' => $query,
                'execution_time' => $executionTime . 'ms'
            ]);
        }
        
        return $result;
    }
}
```

This technical specification demonstrates the depth and complexity of your EventHub project, showcasing advanced programming concepts, architectural decisions, and professional development practices that employers value in senior developers.

---
*EventHub - Enterprise-Grade Event Management Solution*