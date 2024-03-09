<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/product.class.php";
require_once "../classes/image.class.php";
require_once "../classes/variation.class.php";
require_once "../classes/measurement.class.php";


$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);

$product = new Product();
$pro_record = $product->fetch_info($_GET['product_id'], $record['store_id']);

$variation = new Variation();
$var_record = $variation->fetch_info($_GET['variation_id'], $pro_record['product_id']);

$measurement = new Measurement();
$mea_record = $measurement->fetch_info($_GET['measurement_id'], $pro_record['product_id']);

$image = new Image();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
} else if (!isset($pro_record['product_id']) || !isset($var_record['variation_id']) || !isset($mea_record['measurement_id'])) {
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
                            <?php include_once('./product.details.php'); ?>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link py-0 px-5 fw-bold text-secondary" aria-current="page" href="./product-view.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] ?>">Configuration</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-0 px-5 fw-bold text-decoration-underline active disabled" href="#">Inventory</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3" id="Variations">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Stocks
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-3">
                            </div>
                            <div class="col-12 m-0 mb-2 p-0 px-2 d-flex flex-row align-items-center text-secondary">
                                Variations:
                                <?php
                                $varArray = $variation->show($pro_record['product_id']);
                                foreach ($varArray as $item) {
                                ?>
                                    <a href="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $item['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] ?>" class="btn <?= ($item['variation_id'] == $_GET['variation_id']) ? 'btn-primary' : 'btn-secondary' ?> btn-secondary fw-semibold mx-2"><?= $item['variation_name'] ?></a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-12 m-0 p-0 px-2 d-flex flex-row align-items-center text-secondary">
                                Measurements:
                                <?php
                                $meaArray = $measurement->show($pro_record['product_id']);
                                foreach ($meaArray as $item) {
                                ?>
                                    <a href="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $item['measurement_id'] ?>" class="btn <?= ($item['measurement_id'] == $_GET['measurement_id']) ? 'btn-primary' : 'btn-secondary' ?> fw-semibold mx-2"><?= $item['measurement_name'] ?></a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-3">
                            </div>
                            <form method="post" action="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] ?>" class="col-12">
                                <div class="row">
                                    <div class="mb-3 p-0 pe-2 col-12 col-md-6 col-lg-3">
                                        <input type="number" name="stock_quantity" placeholder="Stock Quantity" class="form-control" value="<?php if (isset($_POST['stock_quantity'])) {
                                                                                                                                                echo $_POST['stock_quantity'];
                                                                                                                                            } // add else if for edit same for other fields ?>">
                                        <?php
                                        if (isset($_POST['stock_quantity']) && !validate_field($_POST['stock_quantity'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Stock Quantity is required.</p>
                                        <?php
                                        } else if (isset($_POST['stock_quantity']) && !validate_number($_POST['stock_quantity'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Stock Quantity can not be less than one.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3 p-0 pe-2 col-12 col-md-6 col-lg-3">
                                        <input type="number" name="purchase_price" placeholder="Purchase Price" class="form-control" value="<?php if (isset($_POST['purchase_price'])) {
                                                                                                                                                echo $_POST['purchase_price'];
                                                                                                                                            } ?>">
                                        <?php
                                        if (isset($_POST['purchase_price']) && !validate_field($_POST['purchase_price'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Purchase price is required.</p>
                                        <?php
                                        } else if (isset($_POST['purchase_price']) && !validate_number($_POST['purchase_price'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Purchase price can not be less than one.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3 p-0 pe-2 col-12 col-md-6 col-lg-3">
                                        <input type="number" name="selling_price" placeholder="Selling Price" class="form-control" value="<?php if (isset($_POST['selling_price'])) {
                                                                                                                                                echo $_POST['selling_price'];
                                                                                                                                            } ?>">
                                        <?php
                                        if (isset($_POST['selling_price']) && !validate_field($_POST['selling_price'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Selling price is required.</p>
                                        <?php
                                        } else if (isset($_POST['purchase_price']) && !validate_number($_POST['purchase_price'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Selling price can not be less than one.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3 p-0 pe-2 col-12 col-md-6 col-lg-3 text-end">
                                        <?php if (isset($_POST['edit']) || isset($_POST['save'])) { ?>
                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" name="cancel" value="Cancel">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" name="save" value="Save">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" name="add" value="Add">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>
                            <div class="col-12 m-0 p-0 px-2 row">
                                <table id="variations" class="table table-lg mt-1">
                                    <thead>
                                        <tr class="align-middle">
                                            <th scope="col"></th>
                                            <th scope="col">Date Added</th>
                                            <th scope="col" class="text-center">Sold</th>
                                            <th scope="col" class="text-center">Remaining</th>
                                            <th scope="col" class="text-center">Total Stocks</th>
                                            <th scope="col" class="text-center">Purchase Price</th>
                                            <th scope="col" class="text-center">Selling Price</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        $varArray = $variation->show($pro_record['product_id']);
                                        foreach ($varArray as $item) {
                                        ?>
                                            <tr class="align-middle">
                                                <td><?= $counter ?></td>
                                                <td><?= $item['variation_name'] ?></td>
                                                <td class="text-center"><?= $item['variation_name'] ?></td>
                                                <td class="text-center"><?= $item['variation_name'] ?></td>
                                                <td class="text-center"><?= $item['variation_name'] ?></td>
                                                <td class="text-center"><?= $item['variation_name'] ?></td>
                                                <td class="text-center"><?= $item['variation_name'] ?></td>
                                                <td class="text-end text-nowrap">
                                                    <div class="m-0 p-0">
                                                        <form action="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] ?>" method="post">
                                                            <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="edit" value="Edit"></input>
                                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="warning" value="Delete"></input>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $counter++;
                                        }
                                        ?>
                                    </tbody>
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