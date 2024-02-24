<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/product.class.php";

$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);

$product = new Product();
$pro_record = $product->fetch_info($_GET['product_id'], $record['store_id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
} else if (!isset($pro_record['product_id'])) {
    header('location: ./index.php?store_id=' . $record['store_id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Product Inventory | Crimson Avenue";
$product_page = "active";
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
                <main class="col-md-9 col-lg-10 p-4 row m-0 h-100">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3">
                        <div class="row d-flex justify-content-center m-0 p-0">
                            <?php include_once('./product.details.php') ?>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link py-0 px-5 fw-bold " aria-current="page" href="./product-view.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] ?>">Configuration</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-0 px-5 fw-bold text-decoration-underline active disabled" href="#">Inventory</a>
                                    </li>
                                </ul>
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