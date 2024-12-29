<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>namperfume - Chi tiết sản phẩm</title>
    <link rel="shortcut icon" href="//theme.hstatic.net/1000340570/1000964732/14/favicon.png?v=6611" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter', sans-serif;
        }
        i,span{
            cursor:pointer;
        }
        a{
            text-decoration:none;
            color:black;
        }
        img{
            width:100% ;
            height:400px;
            object-fit:cover;
            object-position:center;

        }
        header>p:first-child{
            text-align:center; 
            background-color:red;
            padding:8px 0px;
            color:white;
        }
        header>p:last-child{
            padding:8px 10%;
            border-bottom:solid 1px gray;
        }
        header #follow-orders{
            float:right;
        }
        nav{
            padding:20px 6%;
        }
        nav .shop{
            display:flex;
            align-items:center;
            justify-content:space-between;      
        }
            
        nav .categories{
            width:100%;
            padding:20px 0px;
            padding-bottom:0px
        }   
        
            .categories .list-categories .category-items{
                display:inline-block;
                list-style-type: none;
                padding:0px 10px;
                color:black;
                height:35px;
                line-height:35px;
            }
            .categories .list-categories .category-items:hover>a{
                color:red;
            }
            .banner {
                width: 100%; /* Chiều rộng của slider */
                height: 400px; /* Chiều cao của slider */
                overflow: hidden; /* Ẩn phần hình ảnh bị trượt ra ngoài */
                position: relative;
            }

            .banner img {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 100%; /* Đặt tất cả hình ảnh ra ngoài màn hình */
                transition: left 0.5s ease; /* Hiệu ứng trượt mượt */
            }

            .banner img.active {
                left: 0; /* Hiển thị ảnh hiện tại */
            }           

            .banner img.previous {
                left: -100%; /* Đưa ảnh cũ ra ngoài bên trái */
            }

    </style>
    <header>
        <p >Thương hiệu nước hoa được feedback nhiều nhất Việt Nam</p>
        <p>
            <span>Thương hiệu nước hoa từ 2013</span>
            <?php
                if(isset($_SESSION["user_id"]) && $_SESSION["user_id"]!=""){
                    $user_id=$_SESSION["user_id"];
                }else{
                    $user_id="";
                }
                echo"<span style='padding: 0 5px ; float:right' id='follow-order' >
                <span>Theo dõi đơn hàng   </span>
                <i  style='margin:0 5px' class='fa-regular fa-bell'></i>
                <input type='hidden' id='user_id_follow_order' value='".$user_id."'></span>";
            ?>
        </p>
    </header>
    <nav>
        <div class="shop">
            <span style="font-size:3rem; color:red">
                <a style="color:red ; text-decoration:none" href="/namperfume">namperfume</a>
            </span>
            <div class="searching">
                <form action="/namperfume/searching.php" method="get" style="width:100%; position:relative">
                    <input style="height:35px ; width:350px ; padding:0  10px ; outline:none; " type="text"  name="keyword" placeholder="Nhập từ khóa bạn muốn tìm ...">
                    <button type="submit"  style='height:35px; position:absolute ; right:0' class='btn btn-info'><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div>
                <span style="padding-right: 20px ; border-right:solid 1px gray;">
                    <i class="fa-solid fa-shop"></i>
                    8 cửa hàng toàn quốc
                </span>
                <span style="padding: 0 20px ; border-right:solid 1px gray;">Cộng đồng</span>
                <?php
                    include_once("config.php");
                    $conn =new  mysqli($servername,$user , $password , $dbname);
                    if(isset($_SESSION["user_id"]) && $_SESSION["user_id"]!=""){
                        $user_id=$_SESSION["user_id"];
                    }else{
                        $user_id="";
                    }
                    if($user_id && $user_id!=null){
                        $sql="SELECT name  FROM users WHERE id=$user_id";
                        $result=$conn->query($sql);
                        $data=$result->fetch_assoc();
                        echo"<span style='padding: 0 5px ; '>
                        <i class='fa-solid fa-user'></i>
                        <a href='QuanLyNguoiDung/profile.php'>
                        ".$data["name"]."
                        </a>
                        </span>";
                    }else{
                        echo"<span style='padding: 0 5px ; '>
                        <i class='fa-solid fa-user'></i>
                        <a href='QuanLyNguoiDung/login.php'>
                        Đăng nhập
                        </a>
                        </span>";
                    }
                ?>
                <span style="padding: 0 5px ; "><i class="fa-regular fa-heart"></i></span>
                <?php
                    echo"<span style='padding: 0 5px ;' >
                    <i class='fa-solid fa-cart-shopping' id='cartIcon'></i> 
                    <input type='hidden' id='user_id_cartIcon' value='".$user_id."'></span>";
                ?>
            </div>
        </div>
        <div class="categories">
            <ul class="list-categories">
                <li class="category-items"><a href="" style="color:red">Back Friday</a></li>
                <li class="category-items"><a href="" style="color:red">nameperfume Favorites</a></li>
                <li class="category-items"><a href="">Nước hoa nam</a></li>
                <li class="category-items"><a href="">Nước hoa nữ</a></li>
                <li class="category-items"><a href="">Unisex</a></li>
                <li class="category-items"><a href="">Giftset</a></li>
                <li class="category-items"><a href="">Nước hoa Mini</a></li>
                <li class="category-items"><a href="">Nước hoa Niche</a></li>
                <li class="category-items"><a href="">Thương hiệu</a></li>
            </ul>
        </div>
    </nav>

    <div class="menu">
        <div class="sidebar" style='border-top:solid 1px gray ; padding-top:20px'>
            <?php
                include_once("config.php");
                $conn = new mysqli($servername,$user,$password,$dbname);
                if($conn->connect_error){
                    die("Failed to connect with database ".$conn->connect_error);
                }else{
                    $id = $_GET["id"]; // Từ khóa người dùng nhập
                    $sql= "SELECT * FROM products WHERE id=$id";
                    
                    // Thực thi truy vấn
                    $result = $conn->query($sql);
                    //var_dump($result);

                }
            ?>
        </div>
        <div class="content" style="padding-top:35px">
            <?php
                echo"<div style='display:flex; justify-content:center;'>";
                while(($data=$result->fetch_assoc())>0){
                    //var_dump($data);
                    echo"<div  class='product-box' style='overflow:hidden ; max-width:400px;position:relative ;border : solid 1px gray ; border-radius:10px ; box-shadow:0 0 10px gray'>";
                    echo"<i  style='position:absolute ;top:10px ; right:10px' class='fa-regular fa-heart'></i>";
                    echo"<div style='height:250px; width:100%; overflow:hidden;'>
                    <img   class='img-products' style='height:auto' src=".$data["image"]." alt=".$data["name"] ." title=".$data["name"] .">
                        
                    </div>";
                    echo"<div style='padding:20px'>";
                    echo"<p>Mã sản phẩm : <span style='font-weight:bold'>".$data["id"]."</span></p>";
                    echo"<p><span style='font-weight:bold'>".$data["name"]."</span></p>";
                    echo"<p> Thương hiệu: <span style='font-weight:bold'>".$data["brand"]."</span></p>";
                    //var_dump($data["category_id"]);
                    $id_category= intval($data["category_id"]);
                    $sql1 = "SELECT name FROM categories WHERE id=$id_category";
                    $result1= $conn->query($sql1);
                    $category = $result1->fetch_assoc();
                    echo"<p> Thương hiệu: <span style='font-weight:bold'>".$category["name"]."</span></p>";
                    echo"<p>Đối tượng: <span style='font-weight:bold'>".$data["gender"]."</span></p>";
                    echo"<p><span style='font-weight:bold'>".$data["description"]."</span></p>";
                    echo"<p style='color:red ;text-align:right ; '>".$data["price"]." $</p>";
                    echo"<p>Số lượng còn lại:<span style='font-weight:bold'>".$data["quantity"]."</span></p>";
                    echo"</div>";
                    echo"<div style=' display:flex ; justify-content:space-around ; align-items:center ;padding:0 10px ;margin-bottom:10px'>
                        <form class='orderProductIndex' method='post' action='orderIndex.php' >
                            <input  type='hidden' name='product_id' value=".$data["id"].">
                            <input  class='orderProduct_userId' type='hidden' name='user_id' value='".$user_id."'>
                            <button  type='submit' style='border:none;width:120px ; padding:6px ; cursor:pointer; border-radius:10px ;text-align :center;color:white ; background-color:red;''>Mua ngay</button>
                        </form >";
                    echo"<form  class='addToCart' method='get' action='Cart/addCart.php'>
                            <input type='hidden' name='product_id' value='".$data["id"]."'>
                            <input  class='user_id' type='hidden' name='user_id' value='".$user_id."'>
                            <button  style='border:none ; background:white'type='submit'><i class='fa-solid fa-cart-plus'></i></button>
                        </form></div>";
                    echo"</div>";
                }
                echo"</div>";                       
                $conn->close();
            ?>
        </div>
    </div>
    <style>
        .menu{
            padding:10px 100px;
        }
        .menu .sidebar{
            width:100%;
        }
            .sidebar>ul{
                float:right;
                width:max-content;
            }
            .sidebar>ul>li{
                list-style-type:none;
                display:inline-block;
                height:35px;
                line-height:35px;
                margin:0 5px;
            }
            .sidebar>ul>li:hover{
                color:red;
                background-color:gray;
                border-radius:4px;
            }
        .img-products:hover{
            width: 120%;
            transition:all .5s;
            cursor: pointer;
        }
        
    </style>
    <script>
        const cartIcon= document.getElementById("cartIcon");
        const user_id = document.getElementById("user_id_cartIcon").value;
        cartIcon.addEventListener("click",function(){
            if(user_id==null || user_id==""){
                alert("Bạn phải đăng nhập mới có thể xem giỏ hàng !");
                //console.log(user_id);
            }else{
                window.location.href='Cart/cart.php';
            }
        })
    </script>
    <script>
        const followOrder= document.getElementById("follow-order");
        const user_id_follow_order = document.getElementById("user_id_follow_order").value;
        followOrder.addEventListener("click",function(){
            if(user_id_follow_order==null || user_id_follow_order==""){
                alert("Bạn phải đăng nhập mới có thể xem chức năng này !");
                //console.log(user_id);
            }else{
                window.location.href='followOrders.php';
            }
        })
    </script>
</body>
</html>