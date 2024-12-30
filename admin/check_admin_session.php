<?php
    session_start(); // Bắt đầu session
    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        exit();
}
?>
