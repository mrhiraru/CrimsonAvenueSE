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
                            <?php include_once('./product.details.php'); ?>
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
                                        <?php
                                        $first_variation = $variation->get_first($pro_record['product_id']);
                                        $first_measurement = $measurement->get_first($pro_record['product_id']);
                                        ?>
                                        <a class="nav-link py-0 px-5 fw-bold text-secondary " href="./product-inventory.php?store_id=<?= $pro_record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $first_variation['variation_id'] . '&measurement_id=' . $first_measurement['measurement_id'] ?>">Inventory</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3" id="Images">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Images
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-3">
                            </div>
                            <form method="post" action="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . (isset($_GET['image_id']) ? '&image=' . $_GET['image_id'] : '') . '#Images' ?>" enctype="multipart/form-data" class="col-12 col-lg-8">
                                <div class="row">
                                    <div class="input-group mb-2 p-0 col-12">
                                        <input type="file" class="form-control" id="image_file" name="image_file" accept=".jpg, .jpeg, .png">
                                        <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon1" name="add_img" value="Add">
                                    </div>
                                    <?php
                                    if (isset($_POST['add_img']) && isset($success) && $success == 'failed') {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">Image file is required.</p>
                                        </div>
                                    <?php
                                    } else if (isset($_POST['add_img']) && isset($success) && $success == 'file-failed') {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">File type is not allowed.</p>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-dark mb-2 ps-2">Note: The first image uploaded will serve as the thumbnail for this product.</p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </form>
                            <div class="col-12 m-0 p-0 px-2 row">
                                <table id="images" class="table table-lg mt-1">
                                    <thead>
                                        <tr class="align-middle">
                                            <th scope="col"></th>
                                            <th scope="col">Image</th>
                                            <th scope="col">File Name</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        $imgArray = $image->show($pro_record['product_id']);
                                        foreach ($imgArray as $item) {
                                        ?>
                                            <tr class="align-middle">
                                                <td><?= $counter ?></td>
                                                <td><img src="<?php if (isset($item['image_file'])) {
                                                                    echo "../images/data/" . $item['image_file'];
                                                                } else {
                                                                    echo "../images/main/no-profile.jpg";
                                                                } ?>" alt="" class="profile-list-size border border-secondary-subtle rounded-1"></td>
                                                <td><?= $item['image_file'] ?></td>
                                                <td class="text-end text-nowrap">
                                                    <div class="m-0 p-0">
                                                        <form action="./product-view.php<?php echo '?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&image_id=' . $item['image_id'] . '#Images'; ?>" method="post">
                                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="warning_img" value="Delete"></input>
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
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3" id="Descriptions">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Descriptions
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-3">
                            </div>
                            <form method="post" action="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . (isset($_GET['desc_id']) ? '&desc_id=' . $_GET['desc_id'] : '') . '#Descriptions' ?>" class="col-12 col-lg-8">
                                <div class="row">
                                    <div class="input-group mb-2 p-0 col-12">
                                        <?php
                                        if (isset($_POST['edit_desc']) || isset($_POST['save_desc'])) {
                                            $desc_record = $description->fetch($_GET['desc_id']);
                                        ?>
                                            <input type="text" class="form-control" id="label" name="label" placeholder="Label (e.g. Color)" value="<?php if (isset($_POST['label'])) {
                                                                                                                                                        echo $_POST['label'];
                                                                                                                                                    } else {
                                                                                                                                                        echo $desc_record['desc_label'];
                                                                                                                                                    } ?>">
                                            <input type="text" class="form-control" id="value" name="value" placeholder="Value (e.g. Red)" value="<?php if (isset($_POST['value'])) {
                                                                                                                                                        echo $_POST['value'];
                                                                                                                                                    } else {
                                                                                                                                                        echo $desc_record['desc_value'];
                                                                                                                                                    } ?>">
                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" id="basic-addon1" name="cancel_desc" value="Cancel">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="save_desc" value="Save">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" class="form-control" id="label" name="label" placeholder="Label (e.g. Color)" value="<?php if (isset($_POST['label'])) {
                                                                                                                                                        echo $_POST['label'];
                                                                                                                                                    } ?>">
                                            <input type="text" class="form-control" id="value" name="value" placeholder="Value (e.g. Red)" value="<?php if (isset($_POST['value'])) {
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
                                            <th scope="col"></th>
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
                                                <td class="text-end text-nowrap">
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
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3" id="Variations">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Variations
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-3">
                            </div>
                            <form method="post" action="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . (isset($_GET['variation_id']) ? '&variation_id=' . $_GET['variation_id'] : '') . '#Variations' ?>" class="col-12 col-lg-8">
                                <div class="row">
                                    <div class="input-group mb-2 p-0 col-12">
                                        <?php
                                        if (isset($_POST['edit_var']) || isset($_POST['save_var'])) {
                                            $var_record = $variation->fetch($_GET['variation_id']);
                                        ?>
                                            <input type="text" class="form-control" id="variation_name" name="variation_name" placeholder="Variation Name" value="<?php if (isset($_POST['variation_name'])) {
                                                                                                                                                                        echo $_POST['variation_name'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $var_record['variation_name'];
                                                                                                                                                                    } ?>">
                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" id="basic-addon1" name="cancel_var" value="Cancel">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="save_var" value="Save">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" class="form-control" id="variation_name" name="variation_name" placeholder="Variation Name" value="<?php if (isset($_POST['variation_name'])) {
                                                                                                                                                                        echo $_POST['variation_name'];
                                                                                                                                                                    } ?>">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon1" name="add_var" value="Add">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if (isset($_POST['add_var']) && isset($_POST['variation_name']) && !validate_field($_POST['variation_name'])) {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">Variation name is required.</p>
                                        </div>
                                    <?php
                                    } else if (isset($_POST['save_var']) && isset($_POST['variation_name']) && !validate_field($_POST['variation_name'])) {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">Update failed! Variation name is required.</p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </form>
                            <div class="col-12 m-0 p-0 px-2 row">
                                <table id="variations" class="table table-lg mt-1">
                                    <thead>
                                        <tr class="align-middle">
                                            <th scope="col"></th>
                                            <th scope="col">Variation Name</th>
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
                                                <td class="text-end text-nowrap">
                                                    <div class="m-0 p-0">
                                                        <form action="./product-view.php<?php echo '?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $item['variation_id'] . '#Variations'; ?>" method="post">
                                                            <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="edit_var" value="Edit"></input>
                                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="warning_var" value="Delete"></input>
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
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3" id="Measurements">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Measurements
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-3">
                            </div>
                            <form method="post" action="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . (isset($_GET['measurement_id']) ? '&measurement_id=' . $_GET['measurement_id'] : '') . '#Measurements' ?>" class="col-12 col-lg-8">
                                <div class="row">
                                    <div class="input-group mb-2 p-0 col-12">
                                        <?php
                                        if (isset($_POST['edit_mea']) || isset($_POST['save_mea'])) {
                                            $mea_record = $measurement->fetch($_GET['measurement_id']);
                                        ?>
                                            <input type="text" class="form-control" id="measurement_name" name="measurement_name" placeholder="Name (e.g. Small)" value="<?php if (isset($_POST['measurement_name'])) {
                                                                                                                                                                                echo $_POST['measurement_name'];
                                                                                                                                                                            } else {
                                                                                                                                                                                echo $mea_record['measurement_name'];
                                                                                                                                                                            } ?>">
                                            <input type="text" class="form-control" id="value_unit" name="value_unit" placeholder="Value (e.g. 104x73 cm)" value="<?php if (isset($_POST['value_unit'])) {
                                                                                                                                                                        echo $_POST['value_unit'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $mea_record['value_unit'];
                                                                                                                                                                    } ?>">
                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" id="basic-addon1" name="cancel_mea" value="Cancel">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="save_mea" value="Save">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" class="form-control" id="measurement_name" name="measurement_name" placeholder="Measurement Name" value="<?php if (isset($_POST['measurement_name'])) {
                                                                                                                                                                            echo $_POST['measurement_name'];
                                                                                                                                                                        } ?>">
                                            <input type="text" class="form-control" id="value_unit" name="value_unit" placeholder="Value" value="<?php if (isset($_POST['value_unit'])) {
                                                                                                                                                        echo $_POST['value_unit'];
                                                                                                                                                    } ?>">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon1" name="add_mea" value="Add">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if (isset($_POST['add_mea']) && isset($_POST['measurement_name']) && isset($_POST['value_unit']) && !validate_field($_POST['measurement_name']) && !validate_field($_POST['value_unit'])) {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">Measurement name and value is required.</p>
                                        </div>
                                    <?php
                                    } else if (isset($_POST['save_mea']) && isset($_POST['measurement_name']) && isset($_POST['value_unit']) && !validate_field($_POST['measurement_name']) && !validate_field($_POST['value_unit'])) {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">Update Failed! Measurement name and value is required.</p>
                                        </div>
                                        <?php
                                    } else {
                                        if (isset($_POST['add_mea']) && isset($_POST['measurement_name']) && !validate_field($_POST['measurement_name'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Measurement name is required.</p>
                                            </div>
                                        <?php
                                        }

                                        if (isset($_POST['add_mea']) && isset($_POST['value_unit']) && !validate_field($_POST['value_unit'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Measurement value is required.</p>
                                            </div>
                                        <?php
                                        } else if (isset($_POST['save_mea']) && isset($_POST['value_unit']) && !validate_field($_POST['value_unit'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Update failed! Measurement value is required.</p>
                                            </div>
                                        <?php
                                        } else if (isset($_POST['save_mea']) && isset($_POST['measurement_name']) && !validate_field($_POST['measurement_name'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Update failed! Measurement name is required.</p>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </form>
                            <div class="col-12 m-0 p-0 px-2 row">
                                <table id="measurements" class="table table-lg mt-1">
                                    <thead>
                                        <tr class="align-middle">
                                            <th scope="col"></th>
                                            <th scope="col">Measurement Name</th>
                                            <th scope="col">Value</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        $meaArray = $measurement->show($pro_record['product_id']);
                                        foreach ($meaArray as $item) {
                                        ?>
                                            <tr class="align-middle">
                                                <td><?= $counter ?></td>
                                                <td><?= $item['measurement_name'] ?></td>
                                                <td><?= $item['value_unit'] ?></td>
                                                <td class="text-end text-nowrap">
                                                    <div class="m-0 p-0">
                                                        <form action="./product-view.php<?php echo '?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&measurement_id=' . $item['measurement_id'] . '#Measurements'; ?>" method="post">
                                                            <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="edit_mea" value="Edit"></input>
                                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="warning_mea" value="Delete"></input>
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
    include_once('./product.configuration-modals.php');
    require_once('../includes/js.php');
    ?>
    <script src="../js/product-conguration.datatable.js"></script>
</body>

</html>