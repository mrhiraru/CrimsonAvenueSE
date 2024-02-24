<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/product.class.php";
require_once "../classes/description.class.php";

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

include_once('./product.configuration-process.php');

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
                            <?php include_once('./product.details.php') ?>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link py-0 px-5 fw-bold text-decoration-underline active disabled" aria-current="page" href="">Configuration</a>
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
                                Images Here
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Descriptions
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-3">
                            </div>
                            <form method="post" action="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&desc_id=auto_increment' . '#Descriptions' ?>" class="col-12 col-lg-6" id="Descriptions">
                                <div class="row">
                                    <div class="input-group mb-2 p-0 col-12">
                                        <?php
                                        if (isset($_POST['edit_desc']) || isset($_POST['save_desc'])) {
                                            $desc_record = $description->fetch($_GET['desc_id']);
                                        ?>
                                            <input type="text" class="form-control" id="label" name="label" placeholder="Label" value="<?php if (isset($_POST['label'])) {
                                                                                                                                            echo $_POST['label'];
                                                                                                                                        } else {
                                                                                                                                            echo $desc_record['desc_label'];
                                                                                                                                        } ?>">
                                            <input type="text" class="form-control" id="value" name="value" placeholder="Value" value="<?php if (isset($_POST['value'])) {
                                                                                                                                            echo $_POST['value'];
                                                                                                                                        } else {
                                                                                                                                            echo $desc_record['desc_value'];
                                                                                                                                        } ?>">
                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" id="basic-addon1" name="cancel_desc" value="Cancel">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="save_desc" value="Save">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" class="form-control" id="label" name="label" placeholder="Label" value="<?php if (isset($_POST['label'])) {
                                                                                                                                            echo $_POST['label'];
                                                                                                                                        } ?>">
                                            <input type="text" class="form-control" id="value" name="value" placeholder="Value" value="<?php if (isset($_POST['value'])) {
                                                                                                                                            echo $_POST['value'];
                                                                                                                                        } ?>">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon1" name="add_desc" value="Add">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if (isset($_POST['add_desc']) && isset($_POST['label']) && isset($_POST['value']) && !validate_field($_POST['label']) && !validate_field($_POST['value'])) {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">Description label and value is required.</p>
                                        </div>
                                    <?php
                                    } else if (isset($_POST['save_desc']) && isset($_POST['label']) && isset($_POST['value']) && !validate_field($_POST['label']) && !validate_field($_POST['value'])) {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">Update Failed! Description label and value is required.</p>
                                        </div>
                                        <?php
                                    } else {
                                        if (isset($_POST['add_desc']) && isset($_POST['label']) && !validate_field($_POST['label'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Description label is required.</p>
                                            </div>
                                        <?php
                                        }

                                        if (isset($_POST['add_desc']) && isset($_POST['value']) && !validate_field($_POST['value'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Description value is required.</p>
                                            </div>
                                        <?php
                                        } else if (isset($_POST['save_desc']) && isset($_POST['value']) && !validate_field($_POST['value'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Update failed! Description value is required.</p>
                                            </div>
                                        <?php
                                        } else if (isset($_POST['save_desc']) && isset($_POST['label']) && !validate_field($_POST['label'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Update failed! Description label is required.</p>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </form>
                            <div class="col-12 m-0 p-0 px-2 row">
                                <table id="descriptions" class="table table-lg mt-1">
                                    <thead>
                                        <tr class="align-middle">
                                            <th scope="col"></th>
                                            <th scope="col">Label</th>
                                            <th scope="col">Value</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        $descArray = $description->show($pro_record['product_id']);
                                        foreach ($descArray as $item) {
                                        ?>
                                            <tr class="align-middle">
                                                <td><?= $counter ?></td>
                                                <td><?= $item['desc_label'] ?></td>
                                                <td><?= $item['desc_value'] ?></td>
                                                <td class="text-center text-nowrap">
                                                    <div class="m-0 p-0">
                                                        <form action="./product-view.php<?php echo '?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&desc_id=' . $item['desc_id'] . '#Descriptions'; ?>" method="post">
                                                            <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="edit_desc" value="Edit"></input>
                                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="warning_desc" value="Delete"></input>
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
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2 row">
                                Variations Here
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2 row">
                                Measurements Here
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <?php
    include_once('./product.configuration-modals.php');
    require_once('../includes/js.php');
    ?>
</body>

</html>