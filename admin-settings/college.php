<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/college.class.php');

$college = new College();
if (isset($_POST['add'])) {


    $college->college_name = htmlentities($_POST['col-name']);

    if (validate_field($college->college_name)) {
        if ($college->add()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save'])) {

    $college->college_name = htmlentities($_POST['col-name']);
    $college->college_id = $_GET['id'];

    if (validate_field($college->college_name)) {
        if ($college->edit()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['cancel'])) {

    header('location: ./college.php');
} else if (isset($_POST['delete'])) {

    $college->college_id = $_GET['id'];
    $college->is_deleted = 1;

    if ($college->delete()) {
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
$college_page = "active";
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
                <main class="col-md-9 col-lg-10 p-4 row m-0">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row h-auto d-flex justify-content-between m-0 p-0">
                            <form method="post" action="" class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="input-group mb-2 p-0 col-12">
                                        <?php
                                        if (isset($_POST['edit']) || isset($_POST['save'])) {
                                            $record = $college->fetch($_GET['id']);
                                        ?>
                                            <input type="text" class="form-control" id="col-name" name="col-name" placeholder="College Name" value="<?php if (isset($_POST['col-name'])) {
                                                                                                                                                        echo $_POST['col-name'];
                                                                                                                                                    } else {
                                                                                                                                                        echo $record['college_name'];
                                                                                                                                                    } ?>">
                                            <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" id="basic-addon1" name="cancel" value="Cancel">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="save" value="Save">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" class="form-control" id="col-name" name="col-name" placeholder="College Name" value="<?php if (isset($_POST['col-name'])) {
                                                                                                                                                        echo $_POST['col-name'];
                                                                                                                                                    } ?>">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon1" name="add" value="Add">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if (isset($_POST['add']) && isset($_POST['col-name']) && !validate_field($_POST['col-name'])) {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">College name is required.</p>
                                        </div>
                                    <?php
                                    } else if (isset($_POST['save']) && isset($_POST['col-name']) && !validate_field($_POST['col-name'])) {
                                    ?>
                                        <div class="mb-2 col-auto mb-2 p-0">
                                            <p class="fs-7 text-primary mb-2 ps-2">Update failed! College name is required.</p>
                                        </div>
                                    <?php
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
                            <table id="colleges" class="table table-lg mt-1">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col"></th>
                                        <th scope="col">College Name</th>
                                        <th scope="col" class="text-center">No of Department</th>
                                        <th scope="col" class="text-center">No of Store</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    $collegeArray = $college->show();
                                    foreach ($collegeArray as $item) {
                                    ?>
                                        <tr class="align-middle">
                                            <td><?= $counter ?></td>
                                            <td> <?= $item['college_name'] ?> </td>
                                            <td class="text-center"><?= $item['dept_count'] ?></td>
                                            <td class="text-center"><?= 0 ?></td>
                                            <td class="text-center text-nowrap">
                                                <div class="m-0 p-0">
                                                    <form action="./college.php?id=<?= $item['college_id'] ?>" method="post">
                                                        <input type="submit" class="btn btn-primary btn-settings-size py-1 px-2 rounded border-0 fw-semibold" id="college-edit" name="edit" value="Edit"></input>
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
                </main>
            </div>
        </div>
    </main>
    <!-- modals  -->
    <?php
    if (isset($_POST['add']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./college.php" class="text-decoration-none text-dark">
                                    <p class="m-0">College added succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                                <a href="./college.php" class="text-decoration-none text-dark">
                                    <p class="m-0">College updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                                <a href="./college.php" class="text-decoration-none text-dark">
                                    <p class="m-0 text-dark">College has been deleted! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                                $record = $college->fetch($_GET['id']);
                                ?>
                                <p class="m-0 text-dark">Are you sure you want to delete <span class="text-primary fw-bold"><?= $record['college_name'] ?></span>?</p>
                                <form action="./college.php?id=<?= $record['college_id'] ?>" method="post" class="mt-3">
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
    <script src="../js/colleges.datatable.js"></script>
</body>

</html>