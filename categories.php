<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>namperfume - Danh mục sản phẩm</title>
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
            .shop .searching{
                position:relative;
                
            }
            .shop .searching>i{
                position:absolute;
                right:0;
                font-size:20px;
                padding:8px;
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
            <span id="follow-orders">
                Theo dõi đơn hàng
                <i  style="margin:0 5px" class="fa-regular fa-bell"></i>
            </span>
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
                <span style="padding: 0 5px ; "><i class="fa-solid fa-cart-shopping"></i></span>
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
    <div class="banner">
        <img src="img/banner (1).png">
        <img src="img/banner (2).jpg">      
        <img src="img/banner (1).png">
        <img src="img/banner (2).jpg">
    </div>
    <script>
        const banners = document.querySelectorAll('.banner img');
        let currentIndex = 0;

        function slideBanner() {
            // Xóa lớp cũ
            banners.forEach((img, index) => {
                img.classList.remove('active', 'previous');
                if (index === currentIndex) {
                    img.classList.add('active'); // Ảnh hiện tại
                } else if (index === (currentIndex - 1 + banners.length) % banners.length) {
                    img.classList.add('previous'); // Ảnh trước đó
                }
            });

            // Chuyển sang ảnh tiếp theo
            currentIndex = (currentIndex + 1) % banners.length;
        }

        // Bắt đầu slider
        setInterval(slideBanner, 3000); // Chuyển ảnh mỗi 3 giây

        // Hiển thị ảnh đầu tiên
        slideBanner();

    </script>

    <div class="menu">
        <div class="sidebar">
            <?php
                include_once("config.php");
                $conn = new mysqli($servername,$user,$password,$dbname);
                if($conn->connect_error){
                    die("Failed to connect with database ".$conn->connect_error);
                }else{
                    $sql="SELECT * FROM categories";
                    $result= $conn->query($sql);
                    $choose=$_GET["categories"];
                    if($result->num_rows == 0){
                        echo"<p style='text-align:center; padding:5px 10px;'>Không có dữ liệu</p>";
                    }else{
                        echo"<ul class='list-categories'>";
                        echo"<li class='category-items' style='background-color: gray ; border-radius:4px'><a href='/namperfume'><button class='btn btn-secondary'>Tất cả</button></a></li>";
                        while(($data= $result->fetch_assoc())>0){
                            //var_dump($data);
                            echo"<li class='category-items'>
                            <form method='get' action='/namperfume/categories.php' style='width:100%; height:100%;'>
                                <input type='hidden' name='id' value=".$data["id"].">
                                <input type='hidden' name='categories' value=".$data["name"].">";
                                if($data["name"]==$choose){
                                    echo"<button type='submit'  class='btn btn-success'>".$data["name"]."</button>";
                                }else{
                                    echo"<button type='submit'  class='btn btn-secondary'>".$data["name"]."</button>";

                                }
                                
                            echo"</form>
                            </li>";
                        }
                        echo"</ul>";
                    }
                    echo"<div style='clear:float'></div>";
                }
            ?>
        </div>
        <div class="content" style="padding-top:35px">
            <?php
                
                if($conn->connect_error){
                    die("Failed to connect with database ".$conn->connect_error);
                }else{
                    $id=$_GET["id"];
                    $sql="SELECT * FROM products WHERE category_id=$id";
                    $result= $conn->query($sql);

                    if($result->num_rows == 0){
                        echo"<p style='text-align:center; padding:5px 10px;'>Không có dữ liệu</p>";
                    }else{
                        echo"<div style='width:100%; display:grid ; gap:20px; grid-template-columns:repeat(auto-fit,minmax(100px,200px))'>";
                        while(($data=$result->fetch_assoc())>0){
                            //var_dump($data);
                            echo"<div  class='product-box' style='overflow:hidden ;position:relative ;border : solid 1px gray ; border-radius:10px ; box-shadow:0 0 10px gray'>";
                            echo"<i  style='position:absolute ;top:10px ; right:10px' class='fa-regular fa-heart'></i>";
                            echo"<div style='height:250px; width:100%; overflow:hidden;'>
                            <img   class='img-products' style='height:auto' src=".$data["image"]." alt=".$data["name"] ." title=".$data["name"] .">
                            
                            </div>";
                            echo"<form id='product-detail'  style=' width:100%; position:absolute ;top:200px ; text-align:center ; z-index:10 ;' action='product_detail.php'>
                                <input type='hidden' name='id' value='".$data["id"]."'>
                                <input type='hidden' name='name' value='".$data["name"]."'>
                                <button type='submit' class='btn btn-danger' style='width:30px ; font-size:small ;width:100%'>Xem chi tiết</button>
                            </form>";
                            echo"<p style='padding-left:20px ; margin:10px 0 '>".$data["name"]."</p>";
                            echo"<p style='padding-left:20px ;margin:10px 0 ; height:40px'>".$data["description"]."</p>";
                            echo"<p style='color:red ;text-align:right ; margin:20px 0 ; padding-right:20px'>".$data["price"]." $</p>";
                            echo"<div style=' display:flex ; justify-content:space-between ; align-items:center ;padding:0 20px ;margin-bottom:10px'>
                            <button style='width:80% ; cursor:pointer' class='btn btn-danger'>Mua ngay</button>
                            <i  style='font-size:larger ; cursor:pointer' class='fa-solid fa-cart-plus'></i>
                            </div>";
                            echo"</div>";
                        }
                        
                    }
                }
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
        #product-detail{
            display:none;
        }
        .product-box:hover #product-detail{
            display:block;
        }
    </style>
</body>
</html>