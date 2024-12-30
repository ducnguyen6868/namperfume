<?php
    $id=intval( $_GET['id']);

    include ("connection.php");
    // Kiểm tra xem sản phẩm có tồn tại trong order_items hay không
    $check_sql = "SELECT COUNT(*) AS count FROM order_items WHERE product_id = $id";
    $result = $connect->query($check_sql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        // Hiển thị hộp thoại thông báo
        echo "<script>
                alert('Không thể xóa! Sản phẩm này đang có trong đơn hàng.');
                window.location.href = 'admin_products.php';
            </script>";
    } else {
        // Xóa sản phẩm nếu không tồn tại trong order_items
        $sql = "DELETE FROM products WHERE id = $id";
        if ($connect->query($sql) === TRUE) {
            header("Location: admin_products.php");
        } else {
            echo "Lỗi khi xóa sản phẩm: " . $connect->error;
        }
    }
    $connect->close();
?>