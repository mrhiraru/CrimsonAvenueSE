<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/moderator.class.php');
require_once('../classes/college.class.php');

$moderator = new Moderator();
if (isset($_POST['add'])) {

    $moderator->account_id = htmlentities($_POST['acc-id']);
    $moderator->college_id = htmlentities($_POST['col-id']);

    if (validate_field($moderator->account_id) && validate_field($moderator->college_id)) {
        if ($moderator->add()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save'])) {
    $moderator->account_id = htmlentities($_POST['acc-id']);
    $moderator->college_id = htmlentities($_POST['col-id']);
    $moderator->moderator_id = $_GET['id'];

    if (validate_field($moderator->account_id) && validate_field($moderator->college_id)) {
        if ($moderator->edit()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['cancel'])) {

    header('location: ./settings-moderator.php');
} else if (isset($_POST['delete'])) {

    $moderator->moderator_id = $_GET['id'];
    $moderator->is_deleted = 1;

    if ($moderator->delete()) {
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
$title = "Settings | Crimson Avenue";
$settings_page = "active";
$moderator_page = "active";
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
                <main class="col-md-9 col-lg-10 p-4">
                    <div class="row m-0 p-0 h-100">
                        <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                            <div class="row h-auto d-flex justify-content-between m-0 p-0">
                                <form method="post" action="" class="col-12 col-lg-7">
                                    <div class="row">
                                        <div class="input-group mb-2 p-0 col-12">
                                            <?php
                                            if (isset($_POST['edit']) || isset($_POST['save'])) {
                                                $record = $moderator->fetch($_GET['id']);
                                            ?>
                                                <select id="acc-id" name="acc-id" class="form-select">
                                                    <option value="<?= $record['account_id'] ?>" selected><?php if (isset($record['middlename'])) {
                                                                                                                echo ucwords(strtolower($record['firstname'] . ' ' . $record['middlename'] . ' ' . $record['lastname']));
                                                                                                            } else {
                                                                                                                echo ucwords(strtolower($record['firstname'] . ' ' . $record['lastname']));
                                                                                                            } ?></option>
                                                </select>
                                                <select id="col-id" name="col-id" class="form-select">
                                                    <option value="">Select College</option>
                                                    <?php
                                                    $college = new College();
                                                    $collegeArray = $college->show();
                                                    foreach ($collegeArray as $item) { ?>
                                                        <option value="<?= $item['college_id'] ?>" <?php if ((isset($_POST['col-id']) && $_POST['col-id'] == $item['college_id']) || (isset($_POST['edit']) && $record['college_id'] == $item['college_id'])) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= $item['college_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" id="basic-addon1" name="cancel" value="Cancel">
                                                <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="save" value="Save">
                                            <?php
                                            } else {
                                            ?>
                                                <select id="acc-id" name="acc-id" class="form-select">
                                                    <option value="">Select Moderator</option>
                                                    <?php
                                                    $moderatorArray = $moderator->show_unassigned();
                                                    foreach ($moderatorArray as $item) { ?>
                                                        <option value="<?= $item['account_id'] ?>"><?php if (isset($item['middlename'])) {
                                                                                                        echo ucwords(strtolower($item['firstname'] . ' ' . $item['middlename'] . ' ' . $item['lastname']));
                                                                                                    } else {
                                                                                                        echo ucwords(strtolower($item['firstname'] . ' ' . $item['lastname']));
                                                                                                    } ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <select id="col-id" name="col-id" class="form-select">
                                                    <option value="">Select College</option>
                                                    <?php
                                                    $college = new College();
                                                    $collegeArray = $college->show();
                                                    foreach ($collegeArray as $item) {
                                                    ?>
                                                        <option value="<?= $item['college_id'] ?>"><?= $item['college_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="add" value="Assign">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (isset($_POST['add']) && isset($_POST['acc-id']) && isset($_POST['col-id']) && !validate_field($_POST['acc-id']) && !validate_field($_POST['col-id'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Please select moderator and college.</p>
                                            </div>
                                        <?php
                                        } else if (isset($_POST['save']) && isset($_POST['acc-id']) && isset($_POST['col-id']) && !validate_field($_POST['acc-id']) && !validate_field($_POST['col-id'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Update Failed! Please select moderator and college.</p>
                                            </div>
                                            <?php
                                        } else {
                                            if (isset($_POST['add']) && isset($_POST['acc-id']) && !validate_field($_POST['acc-id'])) {
                                            ?>
                                                <div class="mb-2 col-auto mb-2 p-0">
                                                    <p class="fs-7 text-primary mb-2 ps-2">No moderator selected.</p>
                                                </div>
                                            <?php
                                            }

                                            if (isset($_POST['add']) && isset($_POST['col-id']) && !validate_field($_POST['col-id'])) {
                                            ?>
                                                <div class="mb-2 col-auto mb-2 p-0">
                                                    <p class="fs-7 text-primary mb-2 ps-2">No college selected.</p>
                                                </div>
                                            <?php
                                            } else if (isset($_POST['save']) && isset($_POST['acc-id']) && !validate_field($_POST['acc-id'])) {
                                            ?>
                                                <div class="mb-2 col-auto mb-2 p-0">
                                                    <p class="fs-7 text-primary mb-2 ps-2">Update failed! No moderator selected.</p>
                                                </div>
                                            <?php
                                            } else if (isset($_POST['save']) && isset($_POST['col-id']) && !validate_field($_POST['col-id'])) {
                                            ?>
                                                <div class="mb-2 col-auto mb-2 p-0">
                                                    <p class="fs-7 text-primary mb-2 ps-2">Update failed! No college selected.</p>
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
                                            <th scope="col">Moderator Name</th>
                                            <th scope="col">College Assigned</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        $moderatorArray = $moderator->show_assigned();
                                        foreach ($moderatorArray as $item) {
                                        ?>
                                            <tr class="align-middle">
                                                <td> <?= $counter ?> </td>
                                                <td><?php if (isset($item['middlename'])) {
                                                        echo ucwords(strtolower($item['firstname'] . ' ' . $item['middlename'] . ' ' . $item['lastname']));
                                                    } else {
                                                        echo ucwords(strtolower($item['firstname'] . ' ' . $item['lastname']));
                                                    } ?></td>

                                                <td> <?= $item['college_name'] ?></td>
                                                <td class="text-center text-nowrap">
                                                    <div class="m-0 p-0">
                                                        <form action="./settings-moderator.php?id=<?= $item['moderator_id'] ?>" method="post">
                                                            <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 rounded border-0 fw-semibold" id="college-edit" name="edit" value="Edit"></input>
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
                                <a href="./moderator.php" class="text-decoration-none text-dark">
                                    <p class="m-0">Moderator assigned succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                                <a href="./moderator.php" class="text-decoration-none text-dark">
                                    <p class="m-0">Moderator updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                                <a href="./moderator.php" class="text-decoration-none text-dark">
                                    <p class="m-0 text-dark">Moderator has been unassigned! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['warning']) && isset($_GET['id'])) {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <?php
                                $record = $moderator->fetch($_GET['id']);
                                ?>
                                <p class="m-0 text-dark">Are you sure you want to remove <span class="text-primary fw-bold"><?= ucwords(strtolower($record['firstname'] . ' ' . $record['lastname'])) ?></span> as moderator of <span class="text-primary fw-bold"><?= ucwords(strtolower($record['college_name'])) ?></span>?</p>
                                <form action="./moderator.php?id=<?= $record['moderator_id'] ?>" method="post" class="mt-3">
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
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
        myModal.show()
    </script>
</body>

</html>