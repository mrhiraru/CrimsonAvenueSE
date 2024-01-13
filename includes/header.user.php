<header class="sticky-top h-header shadow">
    <nav class="navbar navbar-expand-lg p-0">
        <div class="container-fluid d-flex flex-column p-0">
            <div class="header-top w-100 d-flex align-items-center justify-content-center fs-4 bg-tertiary" id="header-top">
                <a class="navbar-brand h-1 fs-3 fw-bolder ms-3 me-auto d-flex align-items-center text-white" href="../">
                    <img src="../images/main/ca-nospace.png" alt="" width="40" height="40" class="d-inline-block me-2">
                    <span class="d-lg-inline d-md-inline d-none">Crimson Avenue </span>
                </a>
                <button class="btn mx-3 p-0 fs-4 text-light border-0" type="button" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></button>
                <a href="../notification.php" class="mx-3 text-light"><i class="fa-solid fa-bell"></i></a>
                <a href="../cart.php" class="mx-3 text-light"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="../user/index.php" class="mx-3 text-light"><i class="fa-solid fa-user"></i></a>
                <button class="navbar-toggler mx-3 p-0 fs-3 text-light border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div class="w-100">
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title fs-3 fw-bold text-primary" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close m-0 p-0" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body p-0">
                        <ul class="navbar-nav m-auto mb-2 mb-lg-0 p-0 w-100 d-flex justify-content-evenly">
                            <li class="nav-item text-lg-center text-start">
                                <a class="nav-link px-4 py-2 py-lg-1 px-lg-0 my-1 text-secondary fw-bold <?= $index_page ?>" href="../">Home</a>
                            </li>
                            <li class="nav-item text-lg-center text-start">
                                <a class="nav-link px-4 py-2 py-lg-1 px-lg-0 my-1 text-secondary fw-bold <?= $product_page ?>" href="../product.php">Product</a>
                            </li>
                            <li class="nav-item text-lg-center text-start">
                                <a class="nav-link px-4 py-2 py-lg-1 px-lg-0 my-1 text-secondary fw-bold <?= $store_page ?>" href="../store.php">Stores</a>
                            </li>
                            <li class="nav-item text-lg-center text-start">
                                <a class="nav-link px-4 py-2 py-lg-1 px-lg-0 my-1 text-secondary fw-bold <?= $message_page ?>" href="../message-inbox.php">Messages</a>
                            </li>
                            <li class="nav-item text-lg-center text-start">
                                <a class="nav-link px-4 py-2 py-lg-1 px-lg-0 my-1 text-secondary fw-bold" href="../admin/">Admin Panel</a>
                            </li>
                            <li class="nav-item text-lg-center text-start">
                                <a class="nav-link px-4 py-2 py-lg-1 px-lg-0 my-1 text-secondary fw-bold" href="../moderator/">Moderator Panel</a>
                            </li>
                            <li class="nav-item text-lg-center text-start">
                                <a class="nav-link px-4 py-2 py-lg-1 px-lg-0 my-1 text-secondary fw-bold" href="../user/login.php">Login</a>
                            </li>
                            <li class="nav-item text-lg-center text-start">
                                <a class="nav-link px-4 py-2 py-lg-1 px-lg-0 my-1 text-secondary fw-bold" href="../user/signup.php">Sign up</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- search modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form class="w-100 d-flex" role="search">
                    <input class="form-control me-auto border border-primary" type="search" name="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>
    </div>
</div>