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
} else if (!isset($pro_record['store_id'])) {
    header('location: ./index.php?store_id=' . $record['store_id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Product View | Crimson Avenue";
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
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 btn-group">
                                    Product Details
                                </p>
                                <p type="button" class="m-0 p-0 text-secondary float-end border-0 bg-white fw-semibold fs-4 lh-1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </p>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Update Details</a></li>
                                    <li><a class="dropdown-item" href="#">Delete Product</a></li>
                                </ul>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-0">
                            </div>
                            <div class="col-12 col-lg-auto m-0 p-3 d-flex flex-column align-items-center">
                                <img src="<?php if (isset($pro_record['profile_image'])) {
                                                echo "../images/data/" . $pro_record['profile_image'];
                                            } else {
                                                echo "../images/main/no-profile.jpg";
                                            } ?>" alt="" class="profile-size border border-secondary-subtle rounded-2">
                            </div>
                            <div class="col-auto d-none d-lg-block p-0 m-0 border-start"></div>
                            <div class="col-12 col-lg-auto m-0 p-2 d-flex justify-content-start align-items-start flex-fill row">
                                <table class="table-sm m-0">
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Product Name:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $pro_record['product_name'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Category:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $pro_record['category_name'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Exclusivity:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $pro_record['exclusivity'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Limit Per Order:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $pro_record['order_quantity_limit'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="pe-3 text-secondary fw-normal">
                                                Estimated Order Time:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $pro_record['estimated_order_time'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Date Added:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= date('F d Y', strtotime($pro_record['is_created'])) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Sale Status:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $pro_record['sale_status'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Variations:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $pro_record['var_count'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Sizes/Measurements:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $pro_record['mea_count'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link py-0 px-5 fw-bold text-decoration-underline active disabled" aria-current="page" href="">Configure</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-0 px-5 fw-bold" href="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] ?>">Inventory</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2 row">
                                <div class="item">
                                    
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