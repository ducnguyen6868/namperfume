<?php

if (isset($_POST['sua'])){
    include("connection.php");
    $id = $_POST['pr_id'];
    $pr_name = $_POST['pr_name'];
    $query = "SELECT * from products where NAME='$pr_name' and id!=" . $id;
    if (mysqli_num_rows($connect->query($query)) != 0) {
      $a = "Sản phẩm đã tồn tại";
      echo "<br>Lỗi";
      echo "Loi";
  } else {
    $pr_brand = $_POST['pr_brand'];
    $pr_des = $_POST['pr_des'];
    $pr_price = $_POST['pr_price'];
    $pr_quantity = $_POST['pr_quantity'];
    $pr_gender = $_POST['pr_gender'];
    $pr_size = $_POST['pr_size'];
    $pr_catid = $_POST['pr_catid'];
    $pr_img = $_FILES['pr_img']['name'];
    if (!empty($_FILES['pr_img']['name'])) {
      // Nếu có hình ảnh mới được tải lên
      $pr_img = $_FILES['pr_img']['name'];
  } else {
      // Nếu không có hình ảnh mới, giữ nguyên hình ảnh hiện tại
      $pr_img = $_POST['current_img'];
  }


  // Cập nhật thông tin sản phẩm vào cơ sở dữ liệu
  $sql = "UPDATE products SET 
      NAME = '$pr_name', 
      brand = '$pr_brand',
      description = '$pr_des',
      price = '$pr_price',
      quantity = '$pr_quantity',
      gender = '$pr_gender',
      size = '$pr_size',
      category_id = '$pr_catid',
      image = '$pr_img'
  WHERE id = $id";
  $kq = mysqli_query($connect , $sql);
  header("Location: admin_products.php");


    }
  }





?>