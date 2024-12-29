<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theo dõi đơn hàng - namperfume</title>
    <link rel="shortcut icon" href="//theme.hstatic.net/1000340570/1000964732/14/favicon.png?v=6611" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <style>
        .cart{
            padding:0 50px;
            text-align:center;
        }
        a{
            color:white;
            text-decoration:none;
        }
    </style>
    <?php
        if($_SESSION["user_id"]==""){
            echo"<div style='text-align:center ; padding:100px'>";
            echo"<p>Bạn phải đăng nhập mới có thể sử dụng tính năng này</p>";
            echo"<img src='required_login.png' alt='login required icon' title='login required icon'>";
            echo"<button class='btn btn-primary'><a href='../QuanLyNguoiDung/login.php>Đăng nhập ngay !</a></button>";
        }else{
            $user_id = $_SESSION["user_id"];
            include_once("config.php");
            $conn = new mysqli($servername, $user, $password, $dbname);
            
            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM orders WHERE user_id=$user_id";
            $result = $conn->query($sql);
            $order_id = [];  // Mảng để lưu ID đơn hàng
            
            echo "<h2 style='text-align:center'>Đơn hàng của bạn</h2>";
            
            if ($result->num_rows == 0) {
                echo "<div class='cart'>";
                echo "<img src='Cart/img/Remove-bg.ai_1735390586550.png' alt='cart' title='cart'>";
                echo "<p>Bạn chưa có đơn hàng nào...</p>";
                echo "<button class='btn btn-primary'>
                        <a href='../'>Đặt hàng ngay</a>
                      </button>";
            } else {
                echo "<div class='cart'>";
                echo "<table class='table table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Mã đơn hàng</th>";
                echo "<th>Giá trị đơn hàng</th>";
                echo "<th>Trạng thái đơn hàng</th>";
                echo "<th>Thời gian đặt hàng</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
            
                // Lặp qua tất cả đơn hàng
                while (($data = $result->fetch_assoc())>0) {
                    echo "<tr>";
                    echo "<td>" . $data["id"] . "</td>";
                    array_push($order_id, $data["id"]);  // Thêm ID đơn hàng vào mảng
                    echo "<td>" . $data["total_price"] . " <span style='color:red'>$</span></td>";
                    echo "<td>" . $data["status"] . "</td>";
                    echo "<td>" . $data["created_at"] . "</td>";
                    echo "</tr>";
                }
            
                echo "</tbody>";
                echo "</table>";
            
                echo "<h2>Danh sách sản phẩm đã đặt</h2>";
            
                // Lặp qua từng ID đơn hàng
                foreach ($order_id as $id) {
                    $sql = "SELECT order_items.order_id , order_items.product_id ,products.name , products.image , order_items.quantity , products.price FROM order_items JOIN products ON order_items.product_id = products.id WHERE order_id=$id";
                    $result_items = $conn->query($sql);
            
                    // Kiểm tra có sản phẩm nào trong đơn hàng
                    if ($result_items->num_rows > 0) {
                        echo "<table class='table table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Mã đơn hàng </th>";
                        echo "<th>Mã sản phẩm</th>";
                        echo "<th>Tên sản phẩm</th>";
                        echo "<th>Hình ảnh</th>";
                        echo "<th>Số lượng</th>";
                        echo "<th>Đơn giá</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
            
                        while ($item = $result_items->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $item["order_id"] . "</td>";
                            echo "<td>" . $item["product_id"] . "</td>"; 
                            echo "<td>" . $item["name"] . "</td>"; 
                            echo "<td><img style='max-width:60px' src='" . $item["image"] . "'></td>"; 
                            echo "<td>" . $item["quantity"] . "</td>";
                            echo "<td>" . $item["price"] . " <span style='color:red'>$</span></td>";
                            echo "</tr>";
                        }
            
                        echo "</tbody>";
                        echo "</table>";
                    }
                }
            }
            
            $conn->close();
 
            
        }
    ?>


</body>
</html>