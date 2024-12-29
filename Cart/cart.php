<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - namperfume</title>
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
            $user_id=$_SESSION["user_id"];
            include_once("connection.php");
            $sql="SELECT  products.id , products.name , products.image , products.price , cart.quantity  FROM cart JOIN products ON cart.product_id = products.id WHERE user_id=$user_id";
            $result= $conn->query($sql);
            echo"<h2 style='text-align:center'>Giỏ hàng của bạn</h2>";
            if($result->num_rows ==0){
                echo"<div class='cart'>";
                echo"<img src='img/Remove-bg.ai_1735390586550.png' alt='cart' title='cart'>";
                echo"<p>Bạn chưa có sản phẩm nào trong giỏ hàng...</p>";
                echo"<button class='btn btn-primary'>
                <a href='../'>Đặt hàng ngay</a>
                </button>";
            }else{
                echo"<div class='cart'>";
                echo"<table class='table table-striped'>";
                echo"<thead>";
                echo"<tr>";
                echo"<th>Mã sản phẩm</th>";
                echo"<th>Tên sản phẩm</th>";
                echo"<th>Hình ảnh</th>";
                echo"<th>Đơn giá</th>";
                echo"<th>Số lượng</th>";
                echo"<th></th>";
                echo"<tr>";
                echo"</thead";
                echo"<tbody>";
                $totalPrice=0;
                while(($data=$result->fetch_assoc())>0){
                    $totalPrice+=$data["price"]*$data["quantity"];
                    echo"<tr>";
                    echo"<td>".$data["id"]."</td>";
                    echo"<td>".$data["name"]."</td>";
                    echo"<td><img title='image product' alt='image product' style='max-width:80px' src='../".$data["image"]."'></td>";
                    echo"<td>".$data["price"]." <span style='color:red'>$</span></td>";
                    echo"<td>
                    <form style='display:inline' method='post' action='updateQuantity.php'>
                    <input type='hidden' name='user_id' value='".$user_id."'>
                    <input type='hidden' name='product_id' value='".$data["id"]."'>
                    <input type='hidden' name='quantity' value='reduce'>
                    <button type='submit' class='btn btn-danger' > <i class='fa-solid fa-minus'></i> </button>

                    </form>
                    ".$data["quantity"]."
                    <form style='display:inline' method='post' action='updateQuantity.php'>
                    <input type='hidden' name='user_id' value='".$user_id."'>
                    <input type='hidden' name='product_id' value='".$data["id"]."'>
                    <input type='hidden' name='quantity' value='increase'>
                    <button type='submit' class='btn btn-success'><i class='fa-solid fa-plus' style='font-size:smaller'></i> </button>

                    </form>
                    </td>";
                    echo"<td>
                    <form class='formDelete' method='post' action='deleteProduct.php'>
                        <input type='hidden' name='user_id' value='".$user_id."'>
                        <input type='hidden' name='product_id' value='".$data["id"]."'>
                        <button style='border:none ; color:blue ; background-color:white;font-size:25px' type='button' >
                            <i class='fa-solid fa-trash'></i>
                        </button>
                    </form></td>";
                    echo"</tr>";
                }
                echo"</tbody>";
                echo"</table>";
                echo"<div style='padding-right:50px'><span style='float:left'>Thành tiền : ".$totalPrice."<span style='color:red'> $</span></span>
                <p style='float:right'>
                    <button class='btn btn-primary' style='margin-right:10px'><a href='../'>Mua thêm</a></button>
                    <button class='btn btn-success'><a href='order.php'>Đặt hàng</a></button>

                </p>
                </div>";
                echo"</div";
            }
            $conn->close();
        }
    ?>
    <!-- The Modal -->
  <div class="modal" id="myModal" style="display:none">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Xóa ?</h4>
          <button  id="exit" type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <p>Bạn có thực sự muốn xóa sản phẩm này ?</p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id='confirm' >Xác nhận</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id='cancel'>Hủy bỏ</button>
        </div>
        
      </div>
    </div>
  </div>
  <script>
        document.querySelectorAll(".formDelete button").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Ngăn hành động mặc định của nút
            const modal = document.getElementById("myModal");
            modal.style.display = "block";

            const confirm = document.getElementById("confirm");
            const cancel = document.getElementById("cancel");
            const exit = document.getElementById("exit");

            confirm.onclick = () => {
                button.closest("form").submit(); // Gửi form
            };

            cancel.onclick = () => {
                modal.style.display = "none"; // Ẩn modal
            };
            exit.onclick = () => {
                modal.style.display = "none"; // Ẩn modal
            };
        });
    });

  </script>
</body>
</html>