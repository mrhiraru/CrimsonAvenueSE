<?php
session_start();

require_once('../tools/functions.php');
require_once('../classes/product.class.php');
require_once('../classes/image.class.php');
require_once('../classes/description.class.php');
require_once('../classes/variation.class.php');
require_once('../classes/measurement.class.php');

$product = new Product();
$record = $product->fetch($_GET['id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
} else if (!isset($_GET['id']) || $record['is_deleted'] == 1 || !isset($record['store_id'])) {
    header('location: ./index.php');
}

if (isset($_POST['restriction'])) {

    $product->restriction_status = htmlentities($_POST['restriction']);
    $product->product_id = $_GET['id'];

    if (validate_field($product->restriction_status)) {
        if ($product->update_restriction()) {
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
$title = "User View | Crimson Avenue";
$product_page = "active";
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
                require_once('../includes/sidepanel.admin.php')
                ?>
                <main class="col-md-9 col-lg-10 p-4 row m-0 h-100">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3">
                        <div class="row d-flex justify-content-center m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2 btn-group">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Product Details
                                </p>
                                <p type="button" class="m-0 p-0 text-secondary border-0 bg-white fw-semibold fs-4 lh-1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </p>
                                <ul class="dropdown-menu">
                                    <li>
                                        <button class="dropdown-item border-0 bg-white" data-bs-toggle="modal" data-bs-target="#restrictionModal">Update Restriction</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-0">
                            </div>
                            <div class="col-12 col-lg-auto m-0 p-3 d-flex flex-column align-items-center">
                                <div id="carouselExampleCaptions" class="carousel slide product-carousel-width" data-bs-ride="carousel">
                                    <div class="carousel-inner rounded">
                                        <?php
                                        $activecounter = false;
                                        $image = new Image();
                                        $imagesArray = $image->show($_GET['id']);
                                        if (empty($imagesArray)) {
                                        ?>
                                            <div class="carousel-item carousel-custom active" data-bs-interval="5000">
                                                <img src="../images/main/no-profile.jpg" alt="" class="profile-size border border-secondary-subtle rounded-2">
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
                                                                } ?>" alt="" class="profile-size border border-secondary-subtle rounded-2">
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
                            <div class="col-auto d-none d-lg-block p-0 m-0 border-start"></div>
                            <div class="col-12 col-lg-auto m-0 p-2 d-flex justify-content-start align-items-start flex-fill row">
                                <table class="table-sm m-0">
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Product Name:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['product_name'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Category:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['category_name'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Exclusivity:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['exclusivity'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Limit Per Order:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['order_quantity_limit'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Estimated Order Time:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['estimated_order_time'] . " Days" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Date Added:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= date('F d Y', strtotime($record['is_created'])) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Sale Status:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['sale_status'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Restriction Status:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['restriction_status'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Styles/Variations:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['var_count'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Sizes/Measurements:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['mea_count'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 mt-4">
                        <div class="row d-flex justify-content-center m-0 p-0">
                            <div class="col-12 m-0 p-0">
                                <p class="m-0 p-0 fs-5 fw-semibold text-dark lh-1 flex-fill">
                                    Description
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-0 mt-2">
                            </div>
                            <div class="col-12 m-0 p-0 mb-4">
                                <table class="table-sm m-0">
                                    <?php
                                    $description = new Description();
                                    $descArray = $description->show($_GET['id']);
                                    foreach ($descArray as $item) {
                                    ?>
                                        <tr>
                                            <td class="text-dark">
                                                <span class="text-secondary fw-normal">
                                                    <?= $item['desc_label'] ?>:
                                                </span>
                                                <br class="d-block d-md-none">
                                                <?= $item['desc_value'] ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <p class="m-0 p-0 fs-5 fw-semibold text-dark lh-1 flex-fill">
                                    Variations
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-0 mt-2">
                            </div>
                            <div class="col-12 m-0 p-0 mb-4">
                                <table class="table-sm m-0">
                                    <?php
                                    $variation = new Variation();
                                    $varArray = $variation->show($_GET['id']);
                                    foreach ($varArray as $item) {
                                    ?>
                                        <tr>
                                            <td class="text-dark">
                                                <?= $item['variation_name'] ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <p class="m-0 p-0 fs-5 fw-semibold text-dark lh-1 flex-fill">
                                    Measurements
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-0 mt-2">
                            </div>
                            <div class="col-12 m-0 p-0">
                                <table class="table-sm m-0">
                                    <?php
                                    $measurement = new Measurement();
                                    $meaArray = $measurement->show($_GET['id']);
                                    foreach ($meaArray as $item) {
                                    ?>
                                        <tr>
                                            <td class="text-dark">
                                                <?= $item['measurement_name'] ?>
                                                <br class="d-block d-md-none">
                                                <?= (isset($item['value_unit'])) ? "- " . $item['value_unit']  :  "" ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <div class="modal fade" id="restrictionModal" tabindex="-1" aria-labelledby="restrictionModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2 px-3">
                    <h1 class="modal-title fs-6 text-primary" id="exampleModalLabel">Update Restriction</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <form action="./product-view.php?id=<?= $record['product_id'] ?>" method="post" class="col-12 m-0" name="accRestriction" id="accRestriction">
                                <div class="form-group m-0 p-0 row d-flex justify-content-evenly">
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="restriction" id="unrestricted" value="Unrestricted" onchange="autoSubmitRestriction()" <?php if ($record['restriction_status'] == "Unrestricted") {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>>
                                        <label class="form-check-label" for="unrestricted">
                                            Unrestrict
                                        </label>
                                    </div>
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="restriction" id="temporary" value="Restricted" onchange="autoSubmitRestriction()" <?php if ($record['restriction_status'] == "Restricted") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                        <label class="form-check-label" for="temporary">
                                            Restrict
                                        </label>
                                    </div>
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="restriction" id="permanent" value="Removed" onchange="autoSubmitRestriction()" <?php if ($record['restriction_status'] == "Removed") {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            } ?>>
                                        <label class="form-check-label" for="permanent">
                                            Remove
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['restriction']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a class="text-decoration-none text-dark" href="./product-view.php?id=<?= $record['product_id'] ?>">
                                    <p class="m-0">Restriction has been updated successfully!</br><span class="text-primary fw-bold">Click to continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    require_once('../includes/js.php');
    ?>
    <script>
        function autoSubmitRestriction() {
            var formObject = document.forms['accRestriction'];
            formObject.submit();
        }
    </script>
</body>

</html>