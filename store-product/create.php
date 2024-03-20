<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/category.class.php";
require_once "../classes/product.class.php";

$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_GET['store_id']) || !isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
}

if (isset($_POST['create'])) {
    $product = new Product();

    $product->product_name = htmlentities($_POST['product_name']);
    $product->category_id = htmlentities($_POST['category_id']);
    $product->exclusivity = htmlentities($_POST['exclusivity']);
    if (isset($_POST['sale_status'])) {
        $product->sale_status = htmlentities($_POST['sale_status']);
    } else {
        $product->sale_status = '';
    }
    $product->selling_price = htmlentities($_POST['selling_price']);
    $product->store_id = $_GET['store_id'];

    if (
        validate_field($product->product_name) &&
        validate_field($product->category_id) &&
        validate_field($product->exclusivity) &&
        validate_field($product->sale_status) &&
        validate_field($product->selling_price) &&
        validate_field($product->store_id)
    ) {
        if ($product->add()) {
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
$title = "Add Product | Crimson Avenue";
$product_page = "active";
$addproduct_page = "active";
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
                            <p class="m-0 mb-3 p-0 text-center fs-3 fw-semibold text-primary">
                                Add New Product
                            </p>
                            <form action="./create.php?store_id=<?= $record['store_id'] ?>" method="post" class="row d-flex p-2 p-md-0 m-0 col-lg-5">

                                <div class="mb-3 p-0 col-12">
                                    <input type="text" name="product_name" placeholder="Product Name" class="form-control" value="<?php if (isset($_POST['product_name'])) {
                                                                                                                                        echo $_POST['product_name'];
                                                                                                                                    } ?>">
                                    <?php
                                    if (isset($_POST['product_name']) && !validate_field($_POST['product_name'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">Product name is required.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option value="">Select Category</option>
                                        <?php
                                        $category = new Category();
                                        $categoryArray = $category->show();
                                        foreach ($categoryArray as $item) {

                                        ?>
                                            <option value="<?= $item['category_id'] ?>" <?php if ((isset($_POST['category_id']) && $_POST['category_id'] == $item['category_id'])) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $item['category_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                    if (isset($_POST['category_id']) && !validate_field($_POST['category_id'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">No category selected.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <select name="exclusivity" id="exclusivity" class="form-select">
                                        <option value="">Select Exclusivity</option>
                                        <option value="All Users" <?php if ((isset($_POST['exclusivity']) && $_POST['exclusivity'] == "All Users")) {
                                                                        echo 'selected';
                                                                    } ?>>All Users</option>
                                        <option value="WMSU Users" <?php if ((isset($_POST['exclusivity']) && $_POST['exclusivity'] == "WMSU Users")) {
                                                                        echo 'selected';
                                                                    } ?>>WMSU Users</option>
                                        <?php if (isset($record['college_name'])) { ?>
                                            <option value="<?= $record['college_name'] ?>" <?php if ((isset($_POST['exclusivity']) && $_POST['exclusivity'] == $record['college_name'])) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= $record['college_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php
                                    if (isset($_POST['exclusivity']) && !validate_field($_POST['exclusivity'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">No exclusivity selected.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group m-0 mb-3 p-0 row col-12 d-flex justify-content-evenly">
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="sale_status" id="pre-order" value="Pre-order" <?php if (isset($_POST['sale_status']) && $_POST['sale_status'] == 'Pre-order') {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>>
                                        <label class="form-check-label" for="pre-order">
                                            Pre-Order
                                        </label>
                                    </div>
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="sale_status" id="on-hand" value="On-hand" <?php if (isset($_POST['sale_status']) && $_POST['sale_status'] == "On-hand") {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                                        <label class="form-check-label" for="on-hand">
                                            On-hand
                                        </label>
                                    </div>
                                    <?php
                                    if ((isset($_POST['sale_status']) && !validate_field($_POST['sale_status']))) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2 col-12">No sale status selected.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <input type="number" name="purchase_price" placeholder="Purchase Price" class="form-control" value="<?php if (isset($_POST['selling_price'])) {
                                                                                                                                echo $_POST['selling_price'];
                                                                                                                            } else if (isset($sto_record['selling_price'])) {
                                                                                                                                echo $sto_record['selling_price'];
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
                                <div class="mb-3 p-0 col-12">
                                    <input type="number" name="selling_price" placeholder="Selling Price" class="form-control" value="<?php if (isset($_POST['selling_price'])) {
                                                                                                                                            echo $_POST['selling_price'];
                                                                                                                                        } else if (isset($sto_record['selling_price'])) {
                                                                                                                                            echo $sto_record['selling_price'];
                                                                                                                                        } ?>">
                                    <?php
                                    if (isset($_POST['selling_price']) && !validate_field($_POST['selling_price'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">Standard price is required.</p>
                                    <?php
                                    } else if (isset($_POST['selling_price']) && !validate_number($_POST['selling_price'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">Standard price can not be less than one.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <input type="submit" class="btn btn-primary w-100 fw-semibold" name="create" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <?php
    if (isset($_POST['create']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./index.php?store_id=<?= $record['store_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0 text-dark">Product is successfully added! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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