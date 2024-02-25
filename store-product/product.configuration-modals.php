<?php
if (!isset($pro_record['store_id']) || !isset($pro_record['product_id'])) {
    header('location: ./index.php?store_id=' . $record['store_id']);
}


if (isset($_POST['add_desc']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Descriptions' ?>" class="text-decoration-none text-dark">
                                <p class="m-0">Description added succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['save_desc']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Descriptions' ?>" class="text-decoration-none text-dark">
                                <p class="m-0">Description updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['delete_desc']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Descriptions' ?>" class="text-decoration-none text-dark">
                                <p class="m-0 text-dark">Description has been deleted! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['warning_desc']) && isset($_GET['desc_id'])) {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <?php
                            $desc_record = $description->fetch($_GET['desc_id']);
                            ?>
                            <p class="m-0 text-dark">Are you sure you want to delete <span class="text-primary fw-bold"><?= $desc_record['desc_label'] ?></span>?</p>
                            <form action="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&desc_id=' . $desc_record['desc_id'] . '#Descriptions' ?>" method="post" class="mt-3">
                                <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 me-3 rounded border-0 fw-semibold" name="cancel_desc" value="Cancel"></input>
                                <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 ms-3 rounded border-0 fw-semibold" name="delete_desc" value="Delete"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['add_var']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Variations' ?>" class="text-decoration-none text-dark">
                                <p class="m-0">Variation added succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['save_var']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Variations' ?>" class="text-decoration-none text-dark">
                                <p class="m-0">Variation updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['delete_var']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Variations' ?>" class="text-decoration-none text-dark">
                                <p class="m-0 text-dark">Variations has been deleted! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['warning_var']) && isset($_GET['variation_id'])) {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <?php
                            $var_record = $variation->fetch($_GET['variation_id']);
                            ?>
                            <p class="m-0 text-dark">Are you sure you want to delete <span class="text-primary fw-bold"><?= $var_record['variation_name'] ?></span>?</p>
                            <form action="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&variation_id=' . $var_record['variation_id'] . '#Variations' ?>" method="post" class="mt-3">
                                <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 me-3 rounded border-0 fw-semibold" name="cancel_var" value="Cancel"></input>
                                <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 ms-3 rounded border-0 fw-semibold" name="delete_var" value="Delete"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['add_mea']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Measurements' ?>" class="text-decoration-none text-dark">
                                <p class="m-0">Measurement added succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['save_mea']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Measurements' ?>" class="text-decoration-none text-dark">
                                <p class="m-0">Measurement updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['delete_mea']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Measurement' ?>" class="text-decoration-none text-dark">
                                <p class="m-0 text-dark">Measurement has been deleted! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['warning_mea']) && isset($_GET['measurement_id'])) {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <?php
                            $mea_record = $measurement->fetch($_GET['measurement_id']);
                            ?>
                            <p class="m-0 text-dark">Are you sure you want to delete <span class="text-primary fw-bold"><?= $mea_record['measurement_name'] ?></span>?</p>
                            <form action="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&measurement_id=' . $mea_record['measurement_id'] . '#Measurements' ?>" method="post" class="mt-3">
                                <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 me-3 rounded border-0 fw-semibold" name="cancel_mea" value="Cancel"></input>
                                <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 ms-3 rounded border-0 fw-semibold" name="delete_mea" value="Delete"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['add_img']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Images' ?>" class="text-decoration-none text-dark">
                                <p class="m-0">Image added succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['warning_img']) && isset($_GET['image_id'])) {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <?php
                            $img_record = $image->fetch($_GET['image_id']);
                            ?>
                            <p class="m-0 text-dark">Are you sure you want to delete <span class="text-primary fw-bold"><?= $img_record['image_file'] ?></span>?</p>
                            <form action="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&image_id=' . $img_record['image_id'] . '#Images' ?>" method="post" class="mt-3">
                                <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 me-3 rounded border-0 fw-semibold" name="cancel_img" value="Cancel"></input>
                                <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 ms-3 rounded border-0 fw-semibold" name="delete_img" value="Delete"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else if (isset($_POST['delete_img']) && $success == 'success') {
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <a href="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '#Images' ?>" class="text-decoration-none text-dark">
                                <p class="m-0 text-dark">Image has been deleted! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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