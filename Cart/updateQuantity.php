<?php
$user_id = $_POST["user_id"];
$product_id = $_POST["product_id"];
$quantity = $_POST["quantity"];
include_once("connection.php");

// Lấy số lượng hiện tại của sản phẩm
$result = $conn->query("SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id");
if ($result && $row = $result->fetch_assoc()) {
    $currentQuantity = $row['quantity'];

    if ($quantity == "increase") {
        // Tăng số lượng
        $sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
        if ($conn->query($sql)) {
            header("Location: cart.php");
        }
    }

    if ($quantity == "reduce") {
        if ($currentQuantity == 1) {
            // Xóa sản phẩm nếu số lượng giảm xuống 0
            $sql = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id";
            if ($conn->query($sql)) {
                header("Location: cart.php");
            }
        } else {
            // Giảm số lượng
            $sql = "UPDATE cart SET quantity = quantity - 1 WHERE user_id = $user_id AND product_id = $product_id";
            if ($conn->query($sql)) {
                header("Location: cart.php");
            }
        }
    }
} else {
    echo "Không tìm thấy sản phẩm trong giỏ hàng.";
}

$conn->close();
?>
