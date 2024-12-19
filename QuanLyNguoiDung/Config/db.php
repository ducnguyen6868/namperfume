<?php
// Thông tin kết nối database
define('DB_HOST', 'localhost');      // Host name
define('DB_USER', 'root');           // Username
define('DB_PASS', '');               // Password
define('DB_NAME', 'nuochoa');  // Database name

// Biến kết nối toàn cục
global $conn;

// Tạo kết nối
function connectDB() {
    global $conn;
    
    if (!isset($conn)) {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            // Kiểm tra kết nối
            if ($conn->connect_error) {
                throw new Exception("Kết nối thất bại: " . $conn->connect_error);
            }
            
            // Đặt charset là utf8mb4
            $conn->set_charset("utf8mb4");
            
            return $conn;
        } catch (Exception $e) {
            die("Lỗi: " . $e->getMessage());
        }
    }
    
    return $conn;
}

// Hàm để escape string, tránh SQL injection
function escape_string($string) {
    $connection = connectDB();
    return $connection->real_escape_string($string);
}

// Khởi tạo kết nối
$conn = connectDB();

// Đóng kết nối khi script kết thúc
register_shutdown_function(function() {
    global $conn;
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
});
?>