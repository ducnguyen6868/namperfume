<?php
// Thông tin kết nối cơ sở dữ liệu
$host = "localhost";  // Địa chỉ máy chủ MySQL (thường là "localhost")
$port = 3306;         // Cổng MySQL (mặc định là 3306, bạn có thể thay đổi nếu cần)
$uname = "root";       // Tên người dùng MySQL
$upass = "";           // Mật khẩu MySQL
$dbname = "namperfume";    // Tên cơ sở dữ liệu

// Tạo kết nối MySQL
$conn = new mysqli($host, $uname, $upass, $dbname, $port);

// Kiểm tra kết nối
if ($conn->connect_error) {
    // Nếu có lỗi, dừng chương trình và hiển thị lỗi
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>