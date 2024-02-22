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
$products_page = "active";
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
                            <div class="col-12 col-lg-auto m-0 p-3 d-flex flex-column justify-content-center align-items-center">
                                <img src="<?php if (isset($pro_record['profile_image'])) {
                                                echo "../images/data/" . $pro_record['profile_image'];
                                            } else {
                                                echo "../images/main/no-profile.jpg";
                                            } ?>" alt="" class="profile-size border border-secondary-subtle rounded-2">
                            </div>
                            <div class="col-auto d-none d-lg-block p-0 m-0 border-start"></div>
                            <div class="col-12 col-lg-auto m-0 p-3 d-flex justify-content-start align-items-start flex-fill row">

                                <table class="table table-sm border-top m-0">
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Product Name</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $pro_record['product_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Category</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $pro_record['category_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Exclusivity</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $pro_record['exclusivity'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Variations</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $pro_record['var_count'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Sizes</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $pro_record['mea_count'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Limit Per Order</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $pro_record['order_quantity_limit'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Estimated Order Time</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $pro_record['estimated_order_time'] . ' Days' ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Date Added</td>
                                        <td class="fw-semibold text-dark ps-3"><?= date('F d Y', strtotime($pro_record['is_created'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Sale Status</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $pro_record['sale_status'] ?><button class="text-primary float-end border-0 bg-white fw-semibold" data-bs-toggle="modal" data-bs-target="#saleStatusModal">Change</button></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Restriction</td>
                                        <td class="fw-semibold text-dark ps-3">
                                            <?= $record['restriction_status'] ?>
                                        </td>
                                    </tr>
                                </table>
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