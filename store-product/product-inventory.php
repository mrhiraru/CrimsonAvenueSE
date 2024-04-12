<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/product.class.php";
require_once "../classes/image.class.php";
require_once "../classes/variation.class.php";
require_once "../classes/measurement.class.php";
require_once "../classes/stock.class.php";


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

$stock = new Stock();
if (isset($_POST['add'])) {

    $stock->stock_quantity = htmlentities($_POST['stock_quantity']);
    $stock->purchase_price = htmlentities($_POST['purchase_price']);
    $stock->selling_price = htmlentities($_POST['selling_price']);
    $stock->product_id = $pro_record['product_id'];
    $stock->variation_id = $var_record['variation_id'];
    $stock->measurement_id = $mea_record['measurement_id'];

    if (
        validate_field($stock->stock_quantity) && validate_number($stock->stock_quantity) &&
        validate_field($stock->purchase_price) && validate_number($stock->purchase_price) &&
        validate_field($stock->selling_price) && validate_number($stock->selling_price)
    ) {
        if ($stock->add()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save'])) {
    $stock->stock_quantity = htmlentities($_POST['stock_quantity']);
    $stock->purchase_price = htmlentities($_POST['purchase_price']);
    $stock->selling_price = htmlentities($_POST['selling_price']);
    $stock->stock_id = $_GET['stock_id'];

    if (
        validate_field($stock->stock_quantity) && validate_number($stock->stock_quantity) &&
        validate_field($stock->purchase_price) && validate_number($stock->purchase_price) &&
        validate_field($stock->selling_price) && validate_number($stock->selling_price) &&
        validate_stock_quantity($_POST['stock_sold'], $_POST['stock_quantity'])
    ) {
        if ($stock->edit()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['cancel'])) {

    header('location: ./product-inventory.php?store_id=' . $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id']);
} else if (isset($_POST['delete'])) {

    $stock->stock_id = $_GET['stock_id'];
    $stock->is_deleted = 1;

    if ($stock->delete()) {
        $success = 'success';
    } else {
        echo 'An error occured while adding in the database.';
        $success = 'failed';
    }
} else if (isset($_POST['add_price'])) {

    $stock->purchase_price = htmlentities($_POST['purchase_price']);
    $stock->selling_price = htmlentities($_POST['selling_price']);
    $stock->product_id = $pro_record['product_id'];
    $stock->variation_id = $var_record['variation_id'];
    $stock->measurement_id = $mea_record['measurement_id'];

    if (
        validate_field($stock->stock_quantity) && validate_number($stock->stock_quantity) &&
        validate_field($stock->purchase_price) && validate_number($stock->purchase_price) &&
        validate_field($stock->selling_price) && validate_number($stock->selling_price)
    ) {
        if ($stock->price_add()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save_price'])) {
    $stock->purchase_price = htmlentities($_POST['purchase_price']);
    $stock->selling_price = htmlentities($_POST['selling_price']);
    $price_id = htmlentities($_POST['price_id']);

    if (
        validate_field($stock->purchase_price) && validate_number($stock->purchase_price) &&
        validate_field($stock->selling_price) && validate_number($stock->selling_price)
    ) {
        if ($stock->price_edit($price_id)) {
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
                                        <a class="nav-link py-0 px-3 px-lg-5 fw-bold text-secondary" aria-current="page" href="./product-view.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] ?>">Configuration</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-0 px-3 px-lg-5 fw-bold text-decoration-underline active disabled" href="#"><?= $pro_record['sale_status'] == "Pre-order" ? "Change Prices" : "Inventory" ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3" id="Variations">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    <?= $pro_record['sale_status'] == "On-hand" ? "Stocks" : "Prices" ?>
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-3">
                            </div>
                            <div class="col-12 m-0 mb-2 p-0 px-2 d-flex flex-row flex-wrap align-items-center text-secondary">
                                <span class="me-1">Variations:</span>
                                <?php
                                $varArray = $variation->show($pro_record['product_id']);
                                foreach ($varArray as $item) {
                                ?>
                                    <a href="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $item['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] ?>" class="btn <?= ($item['variation_id'] == $_GET['variation_id']) ? 'btn-primary' : 'btn-secondary' ?> fw-semibold me-1 mb-1"><?= $item['variation_name'] ?></a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-12 m-0 p-0 px-2 d-flex flex-row flex-wrap align-items-center text-secondary">
                                <span class="me-1">Measurements:</span>
                                <?php
                                $meaArray = $measurement->show($pro_record['product_id']);
                                foreach ($meaArray as $item) {
                                ?>
                                    <a href="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $item['measurement_id'] ?>" class="btn <?= ($item['measurement_id'] == $_GET['measurement_id']) ? 'btn-primary' : 'btn-secondary' ?> fw-semibold me-1 mt-1"><?= $item['measurement_name'] ?></a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-2">
                            </div>
                            <?php
                            if ($pro_record['sale_status'] == "On-hand") {
                            ?>
                                <form method="post" action="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] . (isset($_GET['stock_id']) ? '&stock_id=' . $_GET['stock_id'] : '') ?>" class="col-12">
                                    <div class="row">
                                        <?php
                                        if (isset($_POST['edit']) || isset($_POST['save'])) {
                                            $sto_record = $stock->fetch($_GET['stock_id']);
                                        ?>
                                            <input type="hidden" name="stock_sold" value="<?= $sto_record['stock_sold'] ?>">
                                        <?php
                                        }
                                        ?>
                                        <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-3">
                                            <label for="stock_quantity" class="text-secondary m-0 p-0">Stock Quantity:</label>
                                            <input type="number" id="stock_quantity" name="stock_quantity" placeholder="<?= $pro_record['sale_status'] == "Pre-order" ? "0" : "Stock Quantity" ?>" <?= $pro_record['sale_status'] == "Pre-order" ? "disabled" : "" ?> class="form-control" value="<?php if (isset($_POST['stock_quantity'])) {
                                                                                                                                                                                                                                                                                                        echo $_POST['stock_quantity'];
                                                                                                                                                                                                                                                                                                    } else if (isset($sto_record['stock_quantity'])) {
                                                                                                                                                                                                                                                                                                        echo $sto_record['stock_quantity'];
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                    ?>">
                                            <?php
                                            if (isset($_POST['stock_quantity']) && !validate_field($_POST['stock_quantity'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">Stock Quantity is required.</p>
                                            <?php
                                            } else if (isset($_POST['stock_quantity']) && !validate_number($_POST['stock_quantity'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">Stock Quantity can not be less than one.</p>
                                                <?php
                                            } else if (isset($_POST['save'])) {
                                                if (isset($_POST['stock_quantity']) && !validate_stock_quantity($_POST['stock_sold'], $_POST['stock_quantity'])) {
                                                ?>
                                                    <p class="fs-7 text-primary m-0 ps-2">Stock quantity can not be less than stock sold.</p>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 p-0 pe-lg-2 col-12 col-md-6 col-lg-3">
                                            <label for="purchase_price" class="text-secondary m-0 p-0">Purchase Price:</label>
                                            <input type="number" id="purchase_price" name="purchase_price" placeholder="Purchase Price" class="form-control" value="<?php if (isset($_POST['purchase_price'])) {
                                                                                                                                                                        echo $_POST['purchase_price'];
                                                                                                                                                                    } else if (isset($sto_record['purchase_price'])) {
                                                                                                                                                                        echo $sto_record['purchase_price'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $pro_record['purchase_price'];
                                                                                                                                                                    } ?>" step="any">
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
                                        <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-3">
                                            <label for="selling_price" class="text-secondary m-0 p-0">Selling Price:</label>
                                            <input type="number" id="selling_price" name="selling_price" placeholder="Selling Price" class="form-control" value="<?php if (isset($_POST['selling_price'])) {
                                                                                                                                                                        echo $_POST['selling_price'];
                                                                                                                                                                    } else if (isset($sto_record['selling_price'])) {
                                                                                                                                                                        echo $sto_record['selling_price'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $pro_record['selling_price'];
                                                                                                                                                                    } ?>" step="any">
                                            <?php
                                            if (isset($_POST['selling_price']) && !validate_field($_POST['selling_price'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">Selling price is required.</p>
                                            <?php
                                            } else if (isset($_POST['purchase_price']) && !validate_number($_POST['selling_price'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">Selling price can not be less than one.</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 p-0 col-12 col-md-6 col-lg-3 text-end">
                                            <?php if (isset($_POST['edit']) || isset($_POST['save'])) { ?>
                                                <br>
                                                <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" name="cancel" value="Cancel">
                                                <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" name="save" value="Save">
                                            <?php
                                            } else {
                                            ?>
                                                <br>
                                                <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" name="add" value="Add">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-12 m-0 p-0">
                                    <hr class="mb-3 mt-0">
                                </div>
                                <div class="search-keyword col-12 p-0 d-flex justify-content-end">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="input-group">
                                            <input type="text" name="keyword" id="keyword" placeholder="" class="form-control">
                                            <span class="input-group-text text-white bg-primary border-primary btn-settings-size fw-semibold" id="basic-addon1"><span class="mx-auto">Search</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 m-0 p-0 px-2 row">
                                    <table id="stocks" class="table table-lg mt-1">
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
                                            $stockArray = $stock->show($pro_record['product_id'], $var_record['variation_id'], $mea_record['measurement_id']);
                                            foreach ($stockArray as $item) {
                                            ?>
                                                <tr class="align-middle">
                                                    <td><?= $counter ?></td>
                                                    <td><?= date('F d Y', strtotime($item['is_created'])) ?></td>
                                                    <td class="text-center"><?= $item['stock_sold'] ?></td>
                                                    <td class="text-center"><?= $item['stock_quantity'] - $item['stock_sold'] ?></td>
                                                    <td class="text-center"><?= $item['stock_quantity'] ?></td>
                                                    <td class="text-center"><?= '₱ ' . $item['purchase_price'] ?></td>
                                                    <td class="text-center"><?= '₱ ' . $item['selling_price'] ?></td>
                                                    <td class="text-end text-nowrap">
                                                        <div class="m-0 p-0">
                                                            <form action="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] . '&stock_id=' . $item['stock_id'] ?> " method="post">
                                                                <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="edit" value="Edit"></input>
                                                                <?php if ($item['stock_sold'] < 1) {
                                                                ?>
                                                                    <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="warning" value="Delete"></input>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 rounded border-0 fw-semibold delete-disabled" disabled name="warning_false" value="Delete"></input>
                                                                <?php
                                                                }
                                                                ?>
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
                            <?php
                            } else if ($pro_record['sale_status'] == "Pre-order") {
                            ?>
                                <form method="post" action="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] . (isset($_GET['stock_id']) ? '&stock_id=' . $_GET['stock_id'] : '') ?>" class="col-12">
                                    <div class="row">
                                        <?php
                                        $pri_record = $stock->price_fetch($_GET['variation_id'], $_GET['measurement_id'], $_GET['product_id']);
                                        ?>
                                        <input type="hidden" name="price_id" value="<?= $pri_record['price_id'] ?>">
                                        <div class="mb-3 p-0 pe-lg-2 col-12 col-md-6 col-lg-3">
                                            <label for="purchase_price" class="text-secondary m-0 p-0">Purchase Price:</label>
                                            <input type="number" id="purchase_price" name="purchase_price" placeholder="Purchase Price" class="form-control" value="<?php if (isset($_POST['purchase_price'])) {
                                                                                                                                                                        echo $_POST['purchase_price'];
                                                                                                                                                                    } else if (isset($pri_record['purchase_price'])) {
                                                                                                                                                                        echo $pri_record['purchase_price'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $pro_record['purchase_price'];
                                                                                                                                                                    } ?>" step="any">
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
                                        <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-3">
                                            <label for="selling_price" class="text-secondary m-0 p-0">Selling Price:</label>
                                            <input type="number" id="selling_price" name="selling_price" placeholder="Selling Price" class="form-control" value="<?php if (isset($_POST['selling_price'])) {
                                                                                                                                                                        echo $_POST['selling_price'];
                                                                                                                                                                    } else if (isset($pri_record['selling_price'])) {
                                                                                                                                                                        echo $pri_record['selling_price'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $pro_record['selling_price'];
                                                                                                                                                                    } ?>" step="any">
                                            <?php
                                            if (isset($_POST['selling_price']) && !validate_field($_POST['selling_price'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">Selling price is required.</p>
                                            <?php
                                            } else if (isset($_POST['purchase_price']) && !validate_number($_POST['selling_price'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">Selling price can not be less than one.</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 p-0 col-12 col-md-6 col-lg-6 text-end">
                                            <?php if (isset($_POST[$pri_record])) { ?>
                                                <br>
                                                <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" name="save_price" value="Save">
                                            <?php
                                            } else {
                                            ?>
                                                <br>
                                                <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" name="add_price" value="Add">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <?php
    if (isset($_POST['add']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="<?= './product-inventory.php?store_id=' . $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0">Stock added succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['save']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="<?= './product-inventory.php?store_id=' . $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0">Stock updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['delete']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="<?= './product-inventory.php?store_id=' . $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0 text-dark">Stock has been deleted! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['warning']) && isset($_GET['stock_id'])) {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <?php
                                $sto_record = $stock->fetch($_GET['stock_id']);
                                ?>
                                <p class="m-0 text-dark">Are you sure you want to delete
                                    <span class="text-primary fw-bold"><?= $sto_record['stock_quantity'] ?></span>
                                    stocks added on
                                    <span class="text-primary fw-bold"><?= date('F d Y', strtotime($sto_record['is_created'])) ?></span>
                                    ?
                                </p>
                                <form action="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] .  '&stock_id=' . $sto_record['stock_id'] ?>" method="post" class="mt-3">
                                    <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 me-3 rounded border-0 fw-semibold" name="cancel" value="Cancel"></input>
                                    <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 ms-3 rounded border-0 fw-semibold" name="delete" value="Delete"></input>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['warning_false']) && isset($_GET['stock_id'])) {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <?php
                                $sto_record = $stock->fetch($_GET['stock_id']);
                                ?>
                                <a href="<?= './product-inventory.php?store_id=' . $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0 text-dark">Stock with sold items can't be deleted! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['add_price']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="<?= './product-inventory.php?store_id=' . $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0">Price updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['save_price']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="<?= './product-inventory.php?store_id=' . $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '&measurement_id=' . $mea_record['measurement_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0">Price updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
    <script src="../js/stock.datatable.js"></script>
</body>

</html>