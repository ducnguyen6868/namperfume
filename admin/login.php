<?php
    session_start();
    include("connection.php");
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "select * from `users` where `email`='$username' and `PASSWORD`='$password'";
        $result = $connect->query($query);
        if (mysqli_num_rows($result) == 0)
            echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu')</script>";
        else {
            $result = mysqli_fetch_array($result);
            
                $_SESSION['admin'] = $username;
                if(isset($_SESSION['admin'])) {
                    header("Location: admin_dashboard.php");
                }
            }
        

    }

?>




<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            background-image: url('img/pexels-padrinan-255379.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .form {
            text-align: center;
            
        }
        .form input {
            text-align: left;
            width: 80%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .show-password {
            font-size: 20px;
            position: absolute;
            right: 10%;
            top: 42%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form">
            <h1>Xin chào</h1>
            <p>Vui lòng đăng nhập để đến trang tổng quan admin</p>
            <form method="post" action="">
                <input type="text" name="username" placeholder="Email">
                <input type="password" name="password" id="password-field" placeholder="Mật khẩu">
                    <i class="bx bx-hide show-password" id="toggle-password"></i>
                                
                            
                <button type="submit">Đăng nhập</button>
                <p>Forgotten your password?</p>
            </form>
        </div>
    </div>
    
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>

    <script>
        // Show/hide password
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password-field');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('bx-hide');
            this.classList.toggle('bx-show');
        });
    </script>
    
</body>
</html>