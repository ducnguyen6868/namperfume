    
<?php
// Kết nối cơ sở dữ liệu
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['them'])) {
    // Lấy dữ liệu từ biểu mẫu
    $name = $_POST['us_name'];
    $email = $_POST['us_email'];
    $pass = $_POST['us_pass'];
    $tlnumber=$_POST['us_number'];
    $address = $_POST['us_address'];
    $role= $_POST['role'];
    $created_at = $_POST['created_at'];


    // Chuẩn bị câu truy vấn SQL
    $sql = "INSERT INTO users (NAME, email, PASSWORD, phone, address, role ,created_at) 
            VALUES ('$name', '$email','$pass', '$tlnumber', '$address', '$role', '$created_at')";

    $result = $connect->query($sql);
    // Thực thi truy vấn
    if ($result) {
        echo "Thêm người dùng thành công!";
        header("Location: admin_users.php"); 
    } else {
        echo "Lỗi: ";
    }

    $connect->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body class="app sidebar-mini rtl">
<style>
    .Choicefile {
      display: block;
      background: #14142B;
      border: 1px solid #fff;
      color: #fff;
      width: 150px;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      padding: 5px 0px;
      border-radius: 5px;
      font-weight: 500;
      align-items: center;
      justify-content: center;
    }

    .Choicefile:hover {
      text-decoration: none;
      color: white;
    }

    #uploadfile,
    .removeimg {
      display: none;
    }

    #thumbbox {
      position: relative;
      width: 100%;
      margin-bottom: 20px;
    }

    .removeimg {
      height: 25px;
      position: absolute;
      background-repeat: no-repeat;
      top: 5px;
      left: 5px;
      background-size: 25px;
      width: 25px;
      /* border: 3px solid red; */
      border-radius: 50%;

    }

    .removeimg::before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      content: '';
      border: 1px solid red;
      background: red;
      text-align: center;
      display: block;
      margin-top: 11px;
      transform: rotate(45deg);
    }

    .removeimg::after {
      /* color: #FFF; */
      /* background-color: #DC403B; */
      content: '';
      background: red;
      border: 1px solid red;
      text-align: center;
      display: block;
      transform: rotate(-45deg);
      margin-top: -2px;
    }
  </style>
  <!-- Navbar-->
  <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
      aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


      <!-- User Menu-->
      <li><a class="app-nav__item" href="logout.php"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <?php include("sidebar_menu.php");?>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách người dùng</li>
        <li class="breadcrumb-item"><a href="#">Thêm người dùng</a></li>
      </ul>
    </div>
  <form method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-12">

        <div class="tile">

          <h3 class="tile-title">Tạo người dùng mới</h3>
            <form class="row">
              <div class="form-group col-md-4">
                <label class="control-label">Tên người dùng</label>
                <input class="form-control" type="text" name="us_name">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Email</label>
                <input class="form-control" type="text" name="us_email">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Mật khẩu</label>
                <input class="form-control" type="text" name="us_pass">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Số điện thoại</label>
                <input class="form-control" type="text" name="us_number">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Địa chỉ</label>
                <textarea class="form-control" type="text" name="us_address"></textarea>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Vai trò</label>
                <select class="form-control" name="role">
                      <option value="">-- Chọn vai trò --</option>
                      <?php
                      $roles = ['admin', 'user']; 
                      foreach ($roles as $role) {
                          echo "<option value='$role'>$role</option>";
                      }
                      ?>
                  </select>              
              </div>
              
              <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>">

            </div>
          </div>
              <div>
                <input class="btn btn-save" type="submit" value="Lưu lại" name="them"></input>
                <a class="btn btn-cancel" href="admin-users.php">Hủy bỏ</a>
                </div>
        </div>
  </form>
  </main>


  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>

</body>
