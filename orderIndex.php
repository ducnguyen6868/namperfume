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
        include_once("config.php");
        $conn= new mysqli($servername, $user,$password,$dbname);
        $user_id = $_SESSION["user_id"];
        $product_id=$_POST["product_id"];
        //Lấy giá tiền từ bảng products 

        $result= $conn->query("SELECT price FROM products WHERE id= $product_id");

        if($result->num_rows >0 ){
            $data=$result->fetch_assoc();
            $price=$data["price"];
        }else{
            echo"Lỗi khi lấy giá tiền sản phẩm";
            return;
        }
        // 1. Lưu thông tin vào orders
        $sql = "INSERT INTO orders(user_id , total_price) VALUES($user_id,$price)";
        if($conn->query($sql)){  
            //Lấy id đơn hàng vừa được tạo
            $order_id = $conn->insert_id;
            //Thêm chi tiết đơn hàng vào bảng order_items

            $sql = "INSERT INTO order_items(order_id , product_id , quantity , price) VALUES($order_id, $product_id, 1,$price)";
            if($conn->query($sql)){
                echo "<div id='loadingContainer' class='containe'>
                    <div class='loading'></div>
                    </div>
            
                    <div id='successContainer' class='container'>
                    <div class='success'>
                        <i class='fas fa-check-circle'></i>
                    </div>
                    <p class='message'>Đặt hàng thành công!</p>
                    <a href='index.php' class='btn'>Trở lại trang chủ</a>
                    </div>;";
        
                  
            }
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