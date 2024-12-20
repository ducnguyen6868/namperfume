<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Validate input
    if (!empty($order_id) && !empty($status)) {
        // Update the order status
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('si', $status, $order_id);

        if ($stmt->execute()) {
            header("Location: admin_orders.php?status=success");
            exit();
        } else {
            header("Location: admin_orders.php?status=error");
            exit();
        }

        $stmt->close();
    } else {
        header("Location: admin_orders.php?status=invalid");
        exit();
    }
} else {
    header("Location: admin_orders.php");
    exit();
}
