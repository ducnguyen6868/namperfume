<?php
// Kết nối cơ sở dữ liệu
        include("connection.php");
        $id = intval($_GET['id']);
        $product = mysqli_fetch_array($connect->query("SELECT * FROM products WHERE id= $id " ));// Lấy dữ liệu từ form
        
                
        
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sửa thông tin sản phẩm</title>
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
  <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    
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
      <li><a class="app-nav__item" href="../"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="img/cover-2.png" width="50px"
        alt="User Image">
      <div>
        <p class="app-sidebar__user-name"><b>Admin</b></p>
        <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
      <li><a class="app-menu__item haha" href="admin_dashboard.php"><i class='app-menu__icon bx bx-tachometer'></i>
          <span class="app-menu__label">Tổng quan Admin</span></a></li>
      <li><a class="app-menu__item" href="admin_categories.php"><i class='app-menu__icon bx bx-folder'></i><span
            class="app-menu__label">Quản lý danh mục</span></a></li>
      <li><a class="app-menu__item active " href="admin_products.php"><i class='app-menu__icon bx bx-box'></i> <span
            class="app-menu__label">Quản lý sản phẩm</span></a></li>
      <li><a class="app-menu__item" href="admin_orders.php"><i class='app-menu__icon bx bx-shopping-bag'></i><span
            class="app-menu__label">Quản lý đơn hàng</span></a></li>
      <li><a class="app-menu__item" href="admin_users.php"><i class='app-menu__icon bx bx-user'></i><span 
            class="app-menu__label">Quản lý người dùng</span></a></li>
    </ul>
  </aside>
  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="admin_products.php"></a>Danh sách sản phẩm</li>
        <li class="breadcrumb-item"><a href="#">Sửa thông tin sản phẩm</a></li>
      </ul>
    </div>
    <form method="post" enctype="multipart/form-data" action="update-product.php">
    <div class="row">
      <div class="col-md-12">

        <div class="tile">

          <h3 class="tile-title">Sửa thông tin sản phẩm</h3>
                <div class="form-group col-md-4">
                    <label class="control-label">ID Sản phẩm</label>
                    <input class="form-control" type="text" name="pr_id" value="<?php echo $product['id']; ?>" readonly>
                </div>
              <div class="form-group col-md-4">
                <label class="control-label">Tên sản phẩm</label>
                <input class="form-control" type="text" name="pr_name" value="<?php echo $product['NAME']?>">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Thương hiệu</label>
                <input class="form-control" type="text" name="pr_brand"value="<?php echo $product['brand']?>">
              </div>
              <div class="form-group col-md-4">
                  <label class="control-label">Mô tả</label>
                  <textarea class="form-control" name="pr_des"><?php echo htmlspecialchars($product['description']); ?></textarea>
              </div>

              <div class="form-group col-md-4">
                <label class="control-label">Giá tiền</label>
                <input class="form-control" type="text" name="pr_price" value="<?php echo $product['price']?>">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Số lượng</label>
                <input type="number" class="form-control" name="pr_quantity"  value="<?php echo $product['quantity']?>">
              </div>
              <div class="form-group col-md-4">
                  <label class="control-label">Giới tính</label>
                  <select class="form-control" name="pr_gender">
                      <option value="">-- Chọn giới tính --</option>
                      <?php
                      // Danh sách các giá trị giới tính
                      $gender = ['female' => 'Nữ', 'male' => 'Nam', 'unisex' => 'Unisex'];

                      // Lấy giá trị giới tính hiện tại từ cơ sở dữ liệu
                      $selected_gender = $product['gender'];

                      foreach ($gender as $key => $value) {
                          $selected = ($key == $selected_gender) ? 'selected' : '';
                          echo "<option value='$key' $selected>$value</option>";
                      }
                      ?>
                  </select>
              </div>

              <div class="form-group col-md-4">
                  <label class="control-label">Kích cỡ</label>
                  <select class="form-control" name="pr_size">
                      <option value="">-- Chọn kích cỡ --</option>
                      <?php
                      // Truy vấn các size có trong bảng products hoặc mảng cố định
                      $sizes = ['30ml', '50ml', '100ml', '200ml'];

                      // Lấy giá trị kích cỡ hiện tại từ cơ sở dữ liệu
                      $selected_size = $product['size'];

                      foreach ($sizes as $key => $value) {
                          $selected = ($value == $selected_size) ? 'selected' : '';
                          echo "<option value='$value' $selected>$value</option>";
                      }
                      ?>
                  </select>
              </div>


              <div class="form-group col-md-4">
                  <label class="control-label">Danh mục</label>
                  <?php
                  
                  include("connection.php");
                  // Lấy danh sách danh mục từ bảng `categories`
                  $sql = "SELECT id, name FROM categories";
                  $result = $connect->query($sql);
              
                  echo '<select class="form-control" name="pr_catid">';
                  echo '<option value="">-- Chọn danh mục --</option>';
              
                  // Lấy giá trị danh mục hiện tại từ cơ sở dữ liệu
                  $selected_catid = isset($product['category_id']) ? $product['category_id'] : '';
              
                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          $selected = ($row['id'] == $selected_catid) ? 'selected' : '';
                          echo '<option value="' . $row['id'] . '" ' . $selected . '>' . htmlspecialchars($row['name']) . '</option>';
                      }
                  } else {
                      echo '<option value="">Không có danh mục</option>';
                  }
                  echo '</select>';

                  $connect->close();
                  ?>
              </div>


              <div class="form-group col-md-4">
                <label class="control-label">Hình ảnh</label>
                <div class="input-group">
                    <input class="form-control" type="file" name="pr_img">
                    <?php if (!empty($product['image'])): ?>
                        <div class="input-group-append">
                            <span class="input-group-text"><?php echo $product['image']; ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <input type="hidden" name="current_img" value="<?php echo $product['image']; ?>">
            </div>



            </div>
          </div>
              <div>
                <input class="btn btn-save" type="submit" value="Lưu lại" name="sua"></input>
                <a class="btn btn-cancel" href="admin-products.php">Hủy bỏ</a>
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

</html>