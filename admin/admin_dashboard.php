<?php
// Kết nối đến cơ sở dữ liệu

include("connection.php");


// Lấy dữ liệu đơn hàng
$orderData = [];
$totalSales = 0;

$sql = "SELECT * FROM orders";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $orderData[] = $row;
        $totalSales += $row['total_price'];
    }
}

// Lấy dữ liệu sản phẩm
$productCount = [];

$sql2 = "SELECT category_id, COUNT(*) as count FROM products GROUP BY category_id";
$result2 = $connect->query($sql2);

if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $productCount[$row['category_id']] = $row['count'];
    }
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tổng Quan Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
</head>

<body class="app sidebar-mini rtl">
  <header class="app-header">
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <ul class="app-nav">
      <li><a class="app-nav__item" href="/index.php"><i class='bx bx-log-out bx-rotate-180'></i></a></li>
    </ul>
  </header>

  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user">
      <img class="app-sidebar__user-avatar" src="img/cover-2.png" width="50px" alt="User Image">
      <div>
        <p class="app-sidebar__user-name"><b>Admin</b></p>
        <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
      <li><a class="app-menu__item active" href="phan-mem-ban-hang.php"><i class='app-menu__icon bx bx-tachometer'></i><span class="app-menu__label">Tổng quan Admin</span></a></li>
      <li><a class="app-menu__item" href="admin_categories.php"><i class='app-menu__icon bx bx-folder'></i><span class="app-menu__label">Quản lý danh mục</span></a></li>
      <li><a class="app-menu__item" href="admin_products.php"><i class='app-menu__icon bx bx-box'></i><span class="app-menu__label">Quản lý sản phẩm</span></a></li>
      <li><a class="app-menu__item" href="admin_orders.php"><i class='app-menu__icon bx bx-shopping-bag'></i><span class="app-menu__label">Quản lý đơn hàng</span></a></li>
      <li><a class="app-menu__item" href="admin_users.php"><i class='app-menu__icon bx bx-user'></i><span class="app-menu__label">Quản lý người dùng</span></a></li>
    </ul>
  </aside>

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Tổng quan Admin</li>
      </ul>
    </div>

    <h3>Tổng doanh thu: <?php echo number_format($totalSales, 2); ?> VNĐ</h3>

    <div class="row">
      <div class="col-md-6">
        <canvas id="salesChart" width="400" height="200"></canvas>
      </div>
      <div class="col-md-6">
        <h4>Sản phẩm bán chạy nhất</h4>
        <table class="table">
          <thead>
            <tr>
              <th>Tên sản phẩm</th>
              <th>Số lượng bán</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // Giả sử bạn đã lấy dữ liệu sản phẩm bán chạy nhất
              $bestSellingProducts = [
                ['name' => 'Sản phẩm A', 'quantity' => 150],
                ['name' => 'Sản phẩm B', 'quantity' => 120],
                ['name' => 'Sản phẩm C', 'quantity' => 100],
              ];

              foreach ($bestSellingProducts as $product) {
                echo "<tr>
                        <td>{$product['name']}</td>
                        <td>{$product['quantity']}</td>
                      </tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <h2 class="mt-5">Danh sách đơn hàng</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>ID Người Dùng</th>
          <th>Tổng Giá Trị</th>
          <th>Trạng Thái</th>
          <th>Thời Gian Tạo</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orderData as $order): ?>
        <tr>
          <td><?php echo $order['id']; ?></td>
          <td><?php echo $order['user_id']; ?></td>
          <td><?php echo number_format($order['total_price'], 2); ?> VNĐ</td>
          <td><?php echo $order['STATUS']; ?></td>
          <td><?php echo $order['created_at']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/plugins/pace.min.js"></script>

  <script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($productCount)); ?>,
            datasets: [{
                label: 'Số lượng sản phẩm',
                data: <?php echo json_encode(array_values($productCount)); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
</body>
</html>