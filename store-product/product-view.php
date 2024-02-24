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
} else if (!isset($pro_record['store_id'])) {
    header('location: ./index.php?store_id=' . $record['store_id']);
}

$description = new Description();
if (isset($_POST['add_desc'])) {

    $description->desc_label = htmlentities($_POST['label']);
    $description->desc_value = htmlentities($_POST['value']);
    $description->product_id = $pro_record['product_id'];

    if (validate_field($description->desc_label) && validate_field($description->desc_value)) {
        if ($description->add()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save_desc'])) {
    $description->desc_label = htmlentities($_POST['label']);
    $description->desc_value = htmlentities($_POST['value']);
    $description->desc_id = $_GET['desc_id'];

    if (validate_field($description->desc_label) && validate_field($description->desc_value)) {
        if ($description->edit()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['cancel_desc'])) {

    header('location: ./product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id']);
} else if (isset($_POST['delete'])) {

    $department->department_id = $_GET['id'];
    $department->is_deleted = 1;

    if ($department->delete()) {
        $success = 'success';
    } else {
        echo 'An error occured while adding in the database.';
        $success = 'failed';
    }
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
                            <div class="col-12 m-0 p-0 px-2 btn-group">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Product Details
                                </p>
                                <button type="button" class="m-0 p-0 text-secondary border-0 bg-white fw-semibold fs-4 lh-1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
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
                            <form method="post" action="#Descriptions" class="col-12 col-lg-6" id="Descriptions">
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
                                <table id="products" class="table table-lg mt-1">
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
    include_once('./product.modals.php');
    require_once('../includes/js.php');
    ?>
</body>

</html>