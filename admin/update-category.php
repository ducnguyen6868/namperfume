<?php

if (isset($_POST['sua'])){
    include("connection.php");
    $id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $query = "SELECT * from categories where NAME='$cat_name' and id!=" . $id;
    $cat_des = $_POST['cat_des'];


  // Cập nhật thông tin sản phẩm vào cơ sở dữ liệu
  $sql = "UPDATE categories SET 
      NAME = '$cat_name',
      description = '$cat_des'
  WHERE id = $id";
  $kq = mysqli_query($connect , $sql);
  header("Location: admin_categories.php");


    }






?>