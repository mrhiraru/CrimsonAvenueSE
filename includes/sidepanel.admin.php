<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white shadow collapse">
    <div class="position-sticky pt-3 vh-100">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-secondary fw-semibold <?= $index_page ?>" aria-current="page" href="../admin/index.php">
                    <i class="fa-solid fa-chart-line"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary fw-semibold <?= $products_page ?>" href="../admin/product.php">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary fw-semibold <?= $stores_page ?>" href="../admin/store.php">
                    <i class="fa-solid fa-store"></i>
                    Stores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary fw-semibold <?= $users_page ?>" href="../admin/user.php">
                    <i class="fa-solid fa-address-book"></i>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary fw-semibold <?= $messages_page ?>" href="../admin/message-inbox.php">
                    <i class="fa-solid fa-envelope"></i>
                    Messages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary fw-semibold <?= $reports_page ?>" href="../admin/report.php">
                    <i class="fa-solid fa-scroll"></i>
                    Reports
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary fw-semibold <?= $settings_page ?>" href="../admin/settings.php">
                    <i class="fa-solid fa-gear"></i>
                    Settings
                </a>
            </li>
        </ul>
    </div>
</nav>