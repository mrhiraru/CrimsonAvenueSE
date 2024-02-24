<?php
if (!isset($pro_record['store_id']) || !isset($pro_record['product_id'])) {
    header('location: ./index.php?store_id=' . $record['store_id']);
}
?>

<?php
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
                                <p class="m-0">Department updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                            <form action="<?= './product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] . '&desc_id=' . $item['desc_id'] . '#Descriptions' ?>" method="post" class="mt-3">
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
}
?>