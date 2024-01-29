<header class="sticky-top h-header">
    <nav class="navbar navbar-expand-lg bg-tertiary p-0 shadow">
        <div class="container-fluid d-flex flex-column p-0">
            <div class="header-top w-100 d-flex align-items-center justify-content-center fs-4" id="header-top">
                <button class="navbar-toggler d-md-none ms-3 p-0 fs-3 text-light border-0" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <a class="navbar-brand h-1 fs-3 fw-bolder ms-3 me-auto d-flex align-items-center text-light" href="../admin/index.php">
                    <img src="../images/main/ca-nospace.png" alt="" width="40" height="40" class="d-inline-block me-2">
                    <span class="d-lg-inline d-md-inline d-none">Crimson Avenue </span>
                </a>
                <div class="dropdown">
                    <button class="mx-3 text-light dropdown-toggle border-0 bg-tertiary d-flex align-items-center justify-content-center" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../images/main/profilepic.png" alt="" width="38" height="38" class="d-inline rounded-5 border border-light border-2">
                        <a class="dropdown-item text-light fs-6 fw-bold py-1 px-1 <?= $user_profile ?> " href="#"><?= $_SESSION['name'] ?></a>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end me-2 mt-2">
                        <li><a class="dropdown-item text-secondary fw-bold py-1 px-3 " href="../index.php">Exit Admin Panel</a></li>
                        <li><a class="dropdown-item text-secondary fw-bold py-1 px-3 " href="../logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>