<?php
    $id=intval( $_GET['id']);

    include("connection.php");
    $sql="DELETE FROM products WHERE id=$id";
    $connect->query($sql);
    $connect->close();
    header("Location:admin_products.php");

?>