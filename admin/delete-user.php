<?php
    $id=intval( $_GET['id']);

    include("connection.php");
    $sql="DELETE FROM users WHERE id=$id";
    $connect->query($sql);
    $connect->close();
    header("Location:admin_usersusers.php");

?>