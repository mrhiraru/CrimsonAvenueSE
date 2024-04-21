<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../classes/semester.class.php');
require_once('../tools/functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Admin Dashboard | Crimson Avenue";
$admin_page = "active";
$dashboard_page = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.admin.php');
    ?>
    <main>
        <div class="container-fluid">
            <div class="row">
                <?php
                require_once('../includes/sidepanel.admin.php');
                ?>
                <main class="col-md-9 col-lg-10 p-4 row m-0">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row h-auto d-flex justify-content-center m-0 p-0">

                            <div class="row h-auto mb-4 d-flex justify-content-center">
                                <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Semester:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">1st</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">School Year:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">2023-2024</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Number of Colleges:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">16</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row h-auto d-flex justify-content-center m-0 p-0">

                            <div class="row h-auto mb-4 d-flex justify-content-center">
                                <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total Number of User:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">280</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total Number of Stores:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">53</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total number of products:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">16</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>
