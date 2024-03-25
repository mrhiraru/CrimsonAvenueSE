<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/product.class.php";
require_once "../classes/description.class.php";
require_once "../classes/variation.class.php";
require_once "../classes/measurement.class.php";
require_once "../classes/image.class.php";

$product = new Product();
$record = $product->fetch($_GET['product_id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($record['product_id']) || $record['is_deleted'] == 1) {
    header('location: ../products/products.php?page=1');
}

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Product View | Crimson Avenue";
$page_name = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto min-vh-100 ">
        <main class="">
            <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                <div class="row d-flex justify-content-start m-0 p-0">
                    <div class="col-12 col-md-auto m-0 p-0 d-flex flex-column align-items-center">
                        <div id="carouselExampleCaptions" class="carousel slide product-view-width" data-bs-ride="carousel">
                            <div class="carousel-inner rounded">
                                <?php
                                $activecounter = false;
                                $image = new Image();
                                $imagesArray = $image->show($record['product_id']);
                                if (empty($imagesArray)) {
                                ?>
                                    <div class="carousel-item carousel-custom active" data-bs-interval="5000">
                                        <img src="../images/main/no-profile.jpg" alt="" class="product-view-img border border-secondary-subtle rounded-2">
                                    </div>
                                    <?php
                                } else {
                                    foreach ($imagesArray as $img) {
                                    ?>
                                        <div class="carousel-item carousel-custom <?= ($activecounter == false) ? 'active' : '' ?> " data-bs-interval="5000">
                                            <img src="<?php if (isset($img['image_file'])) {
                                                            echo "../images/data/" . $img['image_file'];
                                                        } else {
                                                            echo "../images/main/no-profile.jpg";
                                                        } ?>" alt="" class="product-view-img img-fluid border border-secondary-subtle rounded-2">
                                        </div>
                                <?php
                                        $activecounter = true;
                                    }
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 m-0 p-0 pt-3 pt-md-0 ps-md-3 d-flex flex-fill flex-column align-items-start">
                        <p class="fs-2 text-nowrap fw-bold text-dark m-0 p-0 lh-1  text-truncate"> <?= $record['product_name'] ?> </p>
                        <div class="row m-0 p-0 w-100">
                            <div class="col-auto m-0 p-0">
                                <p class="fs-6 text-nowrap text-secondary m-0 mt-1 p-0 lh-1 text-truncate">
                                    By
                                    <span class="text-primary fw-semibold"><?= $record['store_name'] ?></span>
                                </p>
                            </div>
                            <div class="col-auto m-0 mx-1 p-0">
                                <p class="fs-5 text-nowrap text-secondary m-0 p-0 lh-1 text-truncate">
                                    |
                                </p>
                            </div>
                            <div class="col-auto m-0 p-0">
                                <p class="fs-6 text-nowrap text-secondary m-0 mt-1 p-0 lh-1 text-truncate">
                                    For
                                    <span class="text-primary fw-semibold"><?= $record['exclusivity'] ?></span>
                                </p>
                            </div>
                            <div class="col-auto m-0 p-0 text-end flex-grow-1">
                                <a href="" class="text-secondary text-decoration-none">Report</a>
                            </div>
                        </div>
                        <div class="col-12 m-0 my-1 p-0 border-top"></div>
                        <p class="fs-1 text-nowrap fw-bold text-primary m-0 lh-1  text-truncate"> ₱ <?= $record['selling_price'] ?> </p>
                        <div class="col-12 m-0 my-1 p-0 border-top"></div>
                        <form action="" method="post" class="col-12">
                            <div class="col-12 m-0 mb-1 p-0 d-flex flex-row flex-wrap align-items-center text-secondary">
                                <div class="col-12 m-0 p-0 me-1 mb-1 fs-7">
                                    Variations:
                                </div>
                                <?php
                                $variation = new Variation();
                                $varArray = $variation->show($record['product_id']);
                                foreach ($varArray as $item) {
                                ?>
                                    <div class="m-0 p-0 me-1 mb-1">
                                        <input type="radio" class="btn-check" name="variation" id="<?= $item['variation_name'] ?>" value="<?= $item['variation_id'] ?>" <?= count($varArray) < 2 ? "checked" : "" ?>>
                                        <label class="btn btn-product-size btn-sm btn-outline-primary px-2 py-1 fs-7" for="<?= $item['variation_name'] ?>"><?= $item['variation_name'] ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-12 m-0 mb-1 p-0 d-flex flex-row flex-wrap align-items-center text-secondary">
                                <div class="col-12 m-0 p-0 me-1 mb-1 fs-7">
                                    Measurements:
                                </div>
                                <?php
                                $measurement = new Measurement();
                                $meaArray = $measurement->show($record['product_id']);
                                foreach ($meaArray as $item) {
                                ?>
                                    <div class="m-0 p-0 me-1 mb-1">
                                        <input type="radio" class="btn-check" name="measurement" id="<?= $item['measurement_name'] ?>" value="<?= $item['measurement_id'] ?>" <?= count($meaArray) < 2 ? "checked" : "" ?>>
                                        <label class="btn btn-product-size btn-sm btn-outline-primary px-2 py-1 fs-7" for="<?= $item['measurement_name'] ?>"><?= $item['measurement_name'] . ' ' . $item['value_unit'] ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-12 m-0 mb-1 p-0 d-flex flex-row flex-wrap align-items-center text-secondary">
                                <div class="col-12 m-0 p-0 me-1 mb-1 fs-7">
                                    <label for="quantity">Quantity: <?= isset($record['order_quantity_limit']) && $record['order_quantity_limit'] > 0 ? $record['order_quantity_limit']." Limit per Order" : "" ?></label>
                                </div>
                                <div class="m-0 p-0 me-1 mb-1">
                                    <input type="number" class="form-control btn-product-size focus-primary rounded-1 px-2 py-1 fs-7" name="quantity" id="quantity" value="">
                                </div>
                                <div class="m-0 p-0 me-1 mb-1 text-dark fs-7">
                                    Stock Here
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <section>
            <!-- Code Here Extra Section -->
        </section>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
</body>

</html>