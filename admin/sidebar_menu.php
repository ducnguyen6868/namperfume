<!-- menu.php -->
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
        <li>
            <a class="app-menu__item haha" href="admin_dashboard.php">
                <i class='app-menu__icon bx bx-tachometer'></i>
                <span class="app-menu__label">Tổng quan Admin</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item <?= $activePage == 'categories' ? 'active' : '' ?>" href="admin_categories.php">
                <i class='app-menu__icon bx bx-folder'></i>
                <span class="app-menu__label">Quản lý danh mục</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item <?= $activePage == 'products' ? 'active' : '' ?>" href="admin_products.php">
                <i class='app-menu__icon bx bx-box'></i>
                <span class="app-menu__label">Quản lý sản phẩm</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item <?= $activePage == 'orders' ? 'active' : '' ?>" href="admin_orders.php">
                <i class='app-menu__icon bx bx-shopping-bag'></i>
                <span class="app-menu__label">Quản lý đơn hàng</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item <?= $activePage == 'users' ? 'active' : '' ?>" href="admin_users.php">
                <i class='app-menu__icon bx bx-user'></i>
                <span class="app-menu__label">Quản lý người dùng</span>
            </a>
        </li>
    </ul>
</aside>
