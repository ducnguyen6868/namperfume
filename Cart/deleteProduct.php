
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="//theme.hstatic.net/1000340570/1000964732/14/favicon.png?v=6611" type="image/png">
    <title>Xóa sản phẩm khỏi giỏ hàng | nameperfume </title>
</head>
<body>
    <style>
        /* styles.css */
        .notification {
            position: fixed;
            top: -100px; /* Ban đầu ẩn ở trên cùng màn hình */
            left: 50%;
            transform: translateX(-50%);
            background-color: #4caf50;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: top 0.5s ease-in-out;
        }

    </style>
    <?php
    $user_id=$_POST["user_id"];
    $product_id=$_POST["product_id"];

    include_once("connection.php");
    $sql="DELETE FROM cart WHERE user_id=$user_id AND product_id=$product_id";

    if($conn->query($sql)){
        echo"<div id='notification' class='notification'>
                Xóa sản phẩm thành công!
                </div>";
    }
    ?>
    
    <script>
        // script.js
            const notification = document.getElementById('notification');
            // Sau 3 giây, ẩn thông báo (trượt lên)
            setTimeout(() => {
                notification.style.top = '20px';
                
            }, 1);
            // Sau 3 giây, ẩn thông báo (trượt lên)
            setTimeout(() => {
                notification.style.top = '-100px';
                window.location.href="cart.php";
            }, 1000);
        

    </script>
</body>
</html>