<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/image.class.php";
require_once "../classes/account.class.php";


$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);

if (isset($_POST['add'])) {

    $store->store_id = htmlentities($record['store_id']);
    $store->account_id = htmlentities($_POST['account_id']);
    $store->staff_role = htmlentities($_POST['staff_role']);

    if (validate_field($store->account_id) && validate_field($store->staff_role) && validate_field($store->store_id)) {
        if ($store->add_staff()) {
            $success = 'success';
        } else {
            $success = 'failed';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save'])) {
    $store->store_staff_id = htmlentities($_GET['store_staff_id']);
    $store->account_id = htmlentities($_POST['account_id']);
    $store->staff_role = htmlentities($_POST['staff_role']);

    if (validate_field($store->account_id) && validate_field($store->staff_role) && validate_field($store->store_staff_id)) {
        if ($store->update_staff()) {
            $success = 'success';
        } else {
            $success = 'failed';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['cancel'])) {

    header('location: ./staff.php?store_id=' . $record['store_id']);
} else if (isset($_POST['delete'])) {

    $store->store_staff_id = htmlentities($_GET['store_staff_id']);
    $store->is_deleted = 1;

    if ($store->delete_staff()) {
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
$title = "Store Staff | Crimson Avenue";
$settings_page = "active";
$staff_page = "active";
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
                require_once('../includes/sidepanel.store.php')
                ?>
                <main class="col-md-9 col-lg-10 p-4 row m-0">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row h-auto d-flex justify-content-between m-0 p-0">
                            <form method="post" action="" class="col-12 col-lg-7">
                                <div class="row">
                                    <div class="input-group mb-2 p-0 col-12">
                                        <?php
                                        if (isset($_POST['edit']) || isset($_POST['save'])) {
                                            $record = $store->staff_fetch($_GET['store_staff_id']);
                                        ?>
                                            <select id="account_id" name="account_id" class="form-select">
                                                <option value="<?= $record['account_id'] ?>" selected><?php if (isset($record['middlename'])) {
                                                                                                            echo ucwords(strtolower($record['firstname'] . ' ' . $record['middlename'] . ' ' . $record['lastname']));
                                                                                                        } else {
                                                                                                            echo ucwords(strtolower($record['firstname'] . ' ' . $record['lastname']));
                                                                                                        } ?></option>
                                            </select>
                                            <select id="staff_role" name="staff_role" class="form-select">
                                                <option value="">Select Role</option>
                                                <option value="2" <?php if ((isset($_POST['staff_role']) && $_POST['staff_role'] == 2) || (isset($_POST['edit']) && $record['staff_role'] == '2')) {
                                                                        echo 'selected';
                                                                    } ?>>Courier</option>
                                            </select>
                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" id="basic-addon1" name="cancel" value="Cancel">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="save" value="Save">
                                        <?php
                                        } else {
                                        ?>
                                            <select id="account_id" name="account_id" class="form-select">
                                                <option value="">Select User</option>
                                                <?php
                                                $account = new Account();
                                                $accountArray = $account->show_user_store();
                                                foreach ($accountArray as $item) { ?>
                                                    <option value="<?= $item['account_id'] ?>" <?php if ((isset($_POST['account_id']) && $_POST['account_id'] == $item['account_id'])) {
                                                                                                    echo 'selected';
                                                                                                } ?>> <?php echo ucwords(strtolower($item['firstname'] . ' ' . $item['lastname'])) . ' | ' . $item['email']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <select id="staff_role" name="staff_role" class="form-select">
                                                <option value="">Select Role</option>
                                                <option value="2" <?php if ((isset($_POST['staff_role']) && $_POST['staff_role'] == 2)) {
                                                                        echo 'selected';
                                                                    } ?>>Courier</option>
                                            </select>
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="add" value="Add">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if (isset($_POST['add']) && isset($_POST['account_id']) && isset($_POST['staff_role']) && !validate_field($_POST['account_id']) && !validate_field($_POST['staff_role'])) {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">Please select user and staff role.</p>
                                        </div>
                                    <?php
                                    } else if (isset($_POST['save']) && isset($_POST['account_id']) && isset($_POST['staff_role']) && !validate_field($_POST['account_id']) && !validate_field($_POST['staff_role'])) {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">Update Failed! Please select user and staff role.</p>
                                        </div>
                                        <?php
                                    } else {
                                        if (isset($_POST['add']) && isset($_POST['account_id']) && !validate_field($_POST['account_id'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">No user selected.</p>
                                            </div>
                                        <?php
                                        }

                                        if (isset($_POST['add']) && isset($_POST['staff_role']) && !validate_field($_POST['staff_role'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">No staff role selected selected.</p>
                                            </div>
                                        <?php
                                        } else if (isset($_POST['save']) && isset($_POST['account_id']) && !validate_field($_POST['account_id'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Update failed! No user selected.</p>
                                            </div>
                                        <?php
                                        } else if (isset($_POST['save']) && isset($_POST['staff_role']) && !validate_field($_POST['staff_role'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Update failed! No staff role selected.</p>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </form>
                            <div class="search-keyword col-12 col-lg-4 mb-2 p-0">
                                <div class="input-group">
                                    <input type="text" name="keyword" id="keyword" placeholder="" class="form-control">
                                    <span class="input-group-text text-white bg-primary border-primary btn-settings-size fw-semibold" id="basic-addon1"><span class="mx-auto">Search</span></span>
                                </div>
                            </div>
                            <table id="moderators" class="table table-lg mt-1">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col"></th>
                                        <th scope="col">Staff</th>
                                        <th scope="col">Role</th>
                                        <th scope="col" class="text-end"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    $staffArray = $store->show_staff($record['store_id']);
                                    foreach ($staffArray as $item) {
                                    ?>
                                        <tr class="align-middle">
                                            <td> <?= $counter ?> </td>
                                            <td> <?php if (isset($item['middlename'])) {
                                                        echo ucwords(strtolower($item['firstname'] . ' ' . $item['middlename'] . ' ' . $item['lastname']));
                                                    } else {
                                                        echo ucwords(strtolower($item['firstname'] . ' ' . $item['lastname']));
                                                    } ?></td>
                                            <td> <?php if ($item['staff_role'] == 0) {
                                                        echo "Administrator";
                                                    } else if ($item['staff_role'] == 1) {
                                                        echo "Moderator";
                                                    } else if ($item['staff_role'] == 2) {
                                                        echo "Courier";
                                                    } ?></td>
                                            <td class="text-end text-nowrap">
                                                <div class="m-0 p-0">
                                                    <form action="./staff.php?store_id=<?= $record['store_id'] . "&store_staff_id=" . $item['store_staff_id'] ?>" method="post">
                                                        <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 rounded border-0 fw-semibold" id="edit" name="edit" value="Edit"></input>
                                                        <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="warning" value="Remove"></input>
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
                </main>
            </div>
        </div>
    </main>
    <!-- modals -->
    <?php
    if (isset($_POST['add']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./staff.php?store_id=<?= $record['store_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0">Staff assigned succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                                <a href="./staff.php?store_id=<?= $record['store_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0">Staff updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                                <a href="./staff.php?store_id=<?= $record['store_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0 text-dark">Staff has been removed! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['warning']) && isset($_GET['store_staff_id'])) {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <?php
                                $record = $store->staff_fetch($_GET['store_staff_id']);
                                ?>
                                <p class="m-0 text-dark">Are you sure you want to remove <span class="text-primary fw-bold"><?= ucwords(strtolower($record['firstname'] . ' ' . $record['lastname'])) ?></span> as staff of this store?</p>
                                <form action="./staff.php?store_id=<?= $record['store_id'] . "&store_staff_id=" . $record['store_staff_id'] ?>" method="post" class="mt-3">
                                    <input type="submit" class="btn btn-primary-opposite btn-settings-size py-1 px-2 me-3 rounded border-0 fw-semibold" id="college-edit" name="cancel" value="Cancel"></input>
                                    <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 ms-3 rounded border-0 fw-semibold" name="delete" value="Delete"></input>
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
    <?php
    require_once('../includes/js.php');
    ?>
    <script src="../js/moderators.datatable.js"></script>
</body>

</html>