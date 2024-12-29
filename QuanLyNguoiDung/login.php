<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //echo"$email $password";
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            if($user['role']=='user'){
                
                header("Location: profile.php");
            }else{
                header("Location: ../admin/admin_dashboard.php");
            }
        }
        else {
            echo "<script>alert('Email hoặc mật khẩu không chính xác');</script>";
        }
        
    }
}
?>
<?php require_once 'header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Đăng nhập</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($_SESSION['message'])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once 'footer.php'; ?>
