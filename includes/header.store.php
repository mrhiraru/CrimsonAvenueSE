<header class="sticky-top h-header">
    <nav class="navbar navbar-expand-lg bg-tertiary p-0 shadow">
        <div class="container-fluid d-flex flex-column p-0">
            <div class="header-top w-100 d-flex align-items-center justify-content-center fs-4" id="header-top">
                <button class="navbar-toggler d-md-none ms-3 p-0 fs-3 text-light border-0" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <a class="navbar-brand h-1 fs-3 fw-bolder ms-3 me-auto d-flex align-items-center text-light" href="../store/index.php?store_id=<?= $record['store_id'] ?>">
                    <img src="../images/main/ca-nospace.png" alt="" width="40" height="40" class="d-inline-block me-2">
                    <span class="d-lg-inline d-md-inline d-none"><?= $record['store_name'] ?></span>
                </a>
                <button class="btn mx-3 p-0 fs-4 text-light border-0" type="button" data-bs-toggle="modal" data-bs-target="#notificationModal"><i class="fa-solid fa-bell" aria-hidden="true"></i></button>
                <div class="dropdown">
                    <button class="mx-3 text-light dropdown-toggle border-0 bg-tertiary d-flex align-items-center justify-content-center" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php if (isset($_SESSION['profile_image'])) {
                                        echo "../images/data/" . $_SESSION['profile_image'];
                                    } else {
                                        echo "../images/main/no-profile.jpg";
                                    } ?>" alt="" width="38" height="38" class="d-inline rounded-5 border border-light border-2 me-2">
                        <div class="m-0 lh-sm ">
                            <div class="align-bottom">
                                <p class="text-light fs-7 fw-bold p-0 m-0"><?= $_SESSION['name'] ?> </p>
                            </div>
                            <hr class="m-0 p-0 opacity-100 border-2">
                            <div class="align-top">
                                <p class="text-light fs-8 fw-bold p-0 m-0"><?php if ($record['staff_role'] == 0) {
                                                                                echo 'Administrator';
                                                                            } else if ($record['staff_role'] == 1) {
                                                                                echo 'Moderator';
                                                                            } else if ($record['staff_role'] == 2) {
                                                                                echo 'Courier';
                                                                            } ?></p>
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end me-2 mt-2">
                        <li><a class="dropdown-item text-secondary fw-bold py-1 px-3 " href="../stores/my-stores.php">Exit Store</a></li>
                        <li><a class="dropdown-item text-secondary fw-bold py-1 px-3 " href="../logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notifModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- display mo dito yung notif -->
            </div>
        </div>
    </div>
</div>