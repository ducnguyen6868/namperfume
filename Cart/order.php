<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng | namperfume</title>
    <link rel="shortcut icon" href="//theme.hstatic.net/1000340570/1000964732/14/favicon.png?v=6611" type="image/png">

</head>
<body>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .container {
            text-align: center;
            display: none; /* Ẩn container ban đầu */
        }

        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80px;
            height: 80px;
            border: 5px solid #ddd;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: auto;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .success {
            color: #27ae60;
            font-size: 50px;
            display: none;
        }

        .message {
            margin-top: 20px;
            font-size: 20px;
            color: #333;
        }

        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 18px;
            color: white;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>

    <?php
        include_once("connection.php");
        $user_id = $_SESSION["user_id"];

        // 1. Lấy thông tin từ giỏ hàng
        $sql_cart = "SELECT cart.quantity , cart.product_id, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = $user_id";
        $result_cart = $conn->query($sql_cart);

        if ($result_cart->num_rows > 0) {
            $total_price = 0;
            $order_items = [];

            while ($cart_item = $result_cart->fetch_assoc()) {
                $total_price += $cart_item["price"] * $cart_item["quantity"];
                $order_items[] = $cart_item; // Lưu thông tin sản phẩm để thêm vào order_items
            }

            // 2. Tạo đơn hàng mới
            $sql_order = "INSERT INTO orders (user_id, total_price) VALUES ($user_id, $total_price)";
            if ($conn->query($sql_order)) {
                $order_id = $conn->insert_id; // Lấy ID của đơn hàng vừa tạo

                // 3. Thêm chi tiết đơn hàng
                foreach ($order_items as $item) {
                    $product_id = $item["product_id"];
                    $quantity = $item["quantity"];
                    $price = $item["price"];
                    $sql_order_item = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                            VALUES ($order_id, $product_id, $quantity, $price)";
                    $conn->query($sql_order_item);
                }

                // 4. Xóa giỏ hàng
                $sql_clear_cart = "DELETE FROM cart WHERE user_id = $user_id";
                $conn->query($sql_clear_cart);

                echo "<div id='loadingContainer' class='containe'>
                    <div class='loading'></div>
                    </div>
            
                    <div id='successContainer' class='container'>
                    <div class='success'>
                        <i class='fas fa-check-circle'></i>
                    </div>
                    <p class='message'>Đặt hàng thành công!</p>
                    <a href='../' class='btn'>Trở lại trang chủ</a>
                    </div>;";
                } else {
                    echo "Lỗi: Không thể tạo đơn hàng.";
                }
            } else {
                echo "Giỏ hàng của bạn đang trống.";
            }

            $conn->close();
        
        ?>

    <script>
        // Hiển thị hiệu ứng loading trước
        const loadingContainer = document.getElementById("loadingContainer");
        const successContainer = document.getElementById("successContainer");

        loadingContainer.style.display = "flex";

        // Giả lập thời gian xử lý, sau 2 giây hiển thị kết quả
        setTimeout(() => {
            loadingContainer.style.display = "none"; // Ẩn loading
            successContainer.style.display = "block"; // Hiển thị thông báo thành công
        }, 1000);
    </script>

</body>
</html>