<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/product.class.php";
require_once "../classes/description.class.php";
require_once "../classes/variation.class.php";
require_once "../classes/measurement.class.php";
require_once "../classes/image.class.php";

$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);

$product = new Product();
$pro_record = $product->fetch_info($_GET['product_id'], $record['store_id']);

$image = new Image();
$measurement = new Measurement();
$variation = new Variation();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
} else if (!isset($pro_record['product_id']) || $pro_record['is_deleted'] == 1) {
    header('location: ./index.php?store_id=' . $record['store_id']);
}

if (isset($_POST['save-discount'])) {
    $product->product_id = $pro_record['product_id'];
    $product->discount_amount = htmlentities($_POST['discount_amount']);
    $product->discount_type = htmlentities($_POST['discount_type']);

    if (
        validate_field($product->product_id) &&
        validate_field($product->discount_amount) &&
        validate_field($product->discount_type)
    ) {
        if ($product->update_discount()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Product Discount | Crimson Avenue";
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
                            <?php include_once('./product.details.php'); ?>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link py-0 px-3 px-lg-5 fw-bold text-secondary" aria-current="page" href="./product-view.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] ?>">Configuration</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-0 px-3 px-lg-5 fw-bold text-decoration-underline active disabled" aria-current="page" href="./discount.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] ?>">Discount</a>
                                    </li>
                                    <li class="nav-item text-truncate">
                                        <?php
                                        $first_variation = $variation->get_first($pro_record['product_id']);
                                        $first_measurement = $measurement->get_first($pro_record['product_id']);
                                        ?>
                                        <a class="nav-link py-0 px-3 px-lg-5 fw-bold text-secondary" href="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $first_variation['variation_id'] . '&measurement_id=' . $first_measurement['measurement_id'] ?>">
                                            <?= $pro_record['sale_status'] == "Pre-order" ? "Inventory" : "Inventory" ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3" id="Variations">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Discounts
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-3">
                            </div>
                            <div class="col-12 m-0 p-0 px-3">
                                <form method="post" action="" class="col-12">
                                    <div class="row">
                                        <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-4">
                                            <span for="discount_amount" class="form-label">Discount Amount:</span>
                                            <input type="number" class="form-control" id="discount_amount" name="discount_amount" require step="any" oninput="negativetozero(this)" value="<?php if (isset($pro_record['discount_amount'])) {
                                                                                                                                                                                                echo $pro_record['discount_amount'];
                                                                                                                                                                                            } else if (isset($_POST['discount_amount'])) {
                                                                                                                                                                                                echo $_POST['discount_amount'];
                                                                                                                                                                                            } ?>">
                                            <?php
                                            if (isset($_POST['discount_amount']) && !validate_field($_POST['discount_amount'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">Discount amount is required.</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-4">
                                            <span for="discount_type" class="form-label">Discount Type:</span>
                                            <select class="form-select" id="discount_type" name="discount_type">
                                                <option value=""> </option>
                                                <option value="Percentage" <?php if ((isset($_POST['discount_type']) && $_POST['discount_type'] == "Percentage")) {
                                                                                echo 'selected';
                                                                            } else if ((isset($pro_record['discount_type']) && $pro_record['discount_type'] == "Percentage")) {
                                                                                echo 'selected';
                                                                            } ?>>Percentage</option>
                                                <option value="Fixed" <?php if ((isset($_POST['discount_type']) && $_POST['discount_type'] == "Fixed")) {
                                                                            echo 'selected';
                                                                        } else if ((isset($pro_record['discount_type']) && $pro_record['discount_type'] == "Fixed")) {
                                                                            echo 'selected';
                                                                        } ?>>Fixed</option>
                                            </select>
                                            <?php
                                            if (isset($_POST['discount_type']) && !validate_field($_POST['discount_type'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">No discount type is selected.</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-4 text-end">
                                            <br>
                                            <input type="submit" class="btn btn-primary btn-settings-size" value="Update" name="save-discount">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <?php
    if (isset($_POST['save-discount']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./discount.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0">Discount is succesfully added to this product! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>