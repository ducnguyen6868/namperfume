<?php
include("connection.php");

// Lấy order_id từ query string
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

if ($order_id > 0) {
    // Lấy thông tin chi tiết đơn hàng từ bảng orders
    $orderQuery = "SELECT o.id, o.total_price, o.status, o.created_at, u.NAME, u.email, u.phone, u.address 
                   FROM orders o
                   JOIN users u ON o.user_id = u.id
                   WHERE o.id = ?";
    $stmt = $connect->prepare($orderQuery);
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $orderResult = $stmt->get_result();
    
    if ($orderResult->num_rows > 0) {
        $order = $orderResult->fetch_assoc();
    } else {
        // Nếu không tìm thấy đơn hàng, redirect hoặc hiển thị thông báo lỗi
        header("Location: admin_orders.php?error=order_not_found");
        exit();
    }
    
    // Lấy thông tin chi tiết các sản phẩm trong đơn hàng từ bảng order_items
    $orderItemsQuery = "SELECT oi.product_id, p.name, p.image, oi.quantity, oi.price 
                        FROM order_items oi
                        JOIN products p ON oi.product_id = p.id
                        WHERE oi.order_id = ?";
    $stmt = $connect->prepare($orderItemsQuery);
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $orderItemsResult = $stmt->get_result();
} else {
    // Nếu order_id không hợp lệ hoặc không tồn tại
    header("Location: admin_orders.php?error=invalid_order_id");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng #<?= $order_id ?></title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <main class="app-content">
        <div class="app-title">
            <h1>Chi tiết đơn hàng #<?= $order['id'] ?></h1>
        </div>
        <div class="tile">
            <div class="tile-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID đơn hàng</th>
                        <td><?= $order['id'] ?></td>
                    </tr>
                    <tr>
                        <th>Khách hàng</th>
                        <td><?= $order['NAME'] ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $order['email'] ?></td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td><?= $order['phone'] ?></td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td><?= $order['address'] ?></td>
                    </tr>
                    <tr>
                        <th>Tổng giá</th>
                        <td><?= number_format($order['total_price'], 0) ?> VND</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td><?= ucfirst($order['status']) ?></td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td><?= $order['created_at'] ?></td>
                    </tr>
                </table>

                <h3>Chi tiết sản phẩm</h3>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($item = $orderItemsResult->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $item['name'] ?></td>
                                <td><img src="../<?=$item['image']?>" alt="" height="100px"></td>
                                <td><?= $item['quantity'] ?></td>
                                <td><?= number_format($item['price'], 0) ?> VND</td>
                                <td><?= number_format($item['quantity'] * $item['price'], 0) ?> VND</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <a href="admin_orders.php" class="btn btn-primary">Trở lại danh sách đơn hàng</a>
            </div>
        </div>
    </main>
</body>

</html>
