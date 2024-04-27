<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";


$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_GET['store_id']) || !isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Store Dashboard | Crimson Avenue";
$store_page = "active";
$dashboard_page = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.store.php');
    ?>
    <main>
        <div class="container-fluid">
            <div class="row">
                <?php
                require_once('../includes/sidepanel.store.php');
                ?>

                <?php
                require_once('../classes/semester.class.php');
                $sem = new Semester();
                $data = $sem->fetch_db();
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
                                                <?php

                                                if (!empty($data)) {
                                                    echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">' . $data['semester_number'] . '</p>';
                                                } else {
                                                    echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">No data available</p>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div></a>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">School Year:</p>
                                                <?php

                                                if (!empty($data)) {
                                                    echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">' . date('F d Y', strtotime($data['start_date'])) . ' - ' . date('F d Y', strtotime($data['end_date'])) .  '</p>';
                                                } else {
                                                    echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">No data available</p>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Verification Status</p>
                                                <?php
                                                if (isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                                    $store_id = $_GET['store_id'];
                                                    $store = new Store();
                                                    $verification_status = $store->show_verification($store_id);
                                                    echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">' . $verification_status . '</p>';
                                                } else {
                                                    echo "Store ID parameter is missing or null in the URL.";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row h-auto d-flex justify-content-center m-0 p-0">
                                <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total Number of Products</p>
                                                <?php
                                                if (isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                                    $store_id = $_GET['store_id'];
                                                    $store = new Store();
                                                    $num_products = $store->count_products_store($store_id);

                                                    if ($num_products !== false) {
                                                        echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">' . $num_products . '</p>';
                                                    } else {
                                                        echo "Failed to retrieve the total number of products.";
                                                    }
                                                } else {
                                                    echo "Store ID parameter is missing or null in the URL.";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total Solds</p>
                                                <?php
                                                require_once('../classes/order.class.php');
                                                if (isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                                    $store_id = $_GET['store_id'];
                                                    $orders = new Order();
                                                    $num_orders = $orders->count_solds($store_id);

                                                    if ($num_orders !== null) {
                                                        echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">' . $num_orders . '</p>';
                                                    } else {
                                                        echo "Failed to retrieve the total number of orders.";
                                                    }
                                                } else {
                                                    echo "Store ID parameter is missing or null in the URL.";
                                                }
                                                
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                <div class="card shadow border-0">
                                    <div class="card-body d-flex flex-column">
                                        <div class="row m-0 h-100">
                                            <p class="col-12 m-0 fw-semibold fs-4 text-primary">Orders</p>
                                            <?php
                                                require_once('../classes/order.class.php');

                                                if (isset($_GET['store_id']) && $_GET['store_id'] !== null) {
                                                    $store_id = $_GET['store_id'];
                                                    $order = new Order();
                                                    $num_orders = $order->count($store_id);

                                                    if ($num_orders !== null) {
                                                        echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">' . $num_orders . '</p>';
                                                    } else {
                                                        echo "Failed to retrieve the total number of orders.";
                                                    }
                                                } else {
                                                    echo "Store ID parameter is missing or null in the URL.";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </div>

                        <a href="../admin-settings/index.php" class="text-decoration-none"></a>
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