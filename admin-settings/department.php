<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/department.class.php');
require_once('../classes/college.class.php');



$department = new Department();
if (isset($_POST['add'])) {

    $department->college_id = htmlentities($_POST['col-id']);
    $department->department_name = htmlentities($_POST['dept-name']);

    if (validate_field($department->college_id) && validate_field($department->department_name)) {
        if ($department->add()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save'])) {
    $department->department_name = htmlentities($_POST['dept-name']);
    $department->department_id = $_GET['id'];
    $department->college_id = htmlentities($_POST['col-id']);

    if (validate_field($department->department_name) && validate_field($department->college_id)) {
        if ($department->edit()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['cancel'])) {

    header('location: ./settings-department.php');
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
$title = "Settings | Crimson Avenue";
$settings_page = "active";
$department_page = "active";
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
                                                $record = $department->fetch($_GET['id']);
                                            ?>
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
                                                <input type="text" class="form-control" id="dept-name" name="dept-name" placeholder="Department Name" value="<?php if (isset($_POST['dept-name'])) {
                                                                                                                                                                    echo $_POST['dept-name'];
                                                                                                                                                                } else {
                                                                                                                                                                    echo $record['department_name'];
                                                                                                                                                                } ?>">
                                                <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" id="basic-addon1" name="cancel" value="Cancel">
                                                <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="save" value="Save">
                                            <?php
                                            } else {
                                            ?>
                                                <select name="col-id" id="col-id" class="form-select">
                                                    <option value="">Select College</option>
                                                    <?php
                                                    $college = new College();
                                                    $collegeArray = $college->show();
                                                    foreach ($collegeArray as $item) { ?>
                                                        <option value="<?= $item['college_id'] ?>" <?php if (isset($_POST['col-id']) && $_POST['col-id'] == $item['college_id']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= $item['college_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input type="text" class="form-control" id="dept-name" name="dept-name" placeholder="Department Name" value="<?php if (isset($_POST['dept-name'])) {
                                                                                                                                                                    echo $_POST['dept-name'];
                                                                                                                                                                } ?>">
                                                <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="add" value="Add">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (isset($_POST['add']) && isset($_POST['col-id']) && isset($_POST['dept-name']) && !validate_field($_POST['col-id']) && !validate_field($_POST['dept-name'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Please select a college and enter the department name.</p>
                                            </div>
                                        <?php
                                        } else if (isset($_POST['save']) && isset($_POST['col-id']) && isset($_POST['dept-name']) && !validate_field($_POST['col-id']) && !validate_field($_POST['dept-name'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">Update Failed! Please select a college and enter the department name.</p>
                                            </div>
                                            <?php
                                        } else {
                                            if (isset($_POST['add']) && isset($_POST['col-id']) && !validate_field($_POST['col-id'])) {
                                            ?>
                                                <div class="mb-2 col-auto mb-2 p-0">
                                                    <p class="fs-7 text-primary mb-2 ps-2">No college selected.</p>
                                                </div>
                                            <?php
                                            }

                                            if (isset($_POST['add']) && isset($_POST['dept-name']) && !validate_field($_POST['dept-name'])) {
                                            ?>
                                                <div class="mb-2 col-auto mb-2 p-0">
                                                    <p class="fs-7 text-primary mb-2 ps-2">Department name is required.</p>
                                                </div>
                                            <?php
                                            } else if (isset($_POST['save']) && isset($_POST['dept-name']) && !validate_field($_POST['dept-name'])) {
                                            ?>
                                                <div class="mb-2 col-auto mb-2 p-0">
                                                    <p class="fs-7 text-primary mb-2 ps-2">Update failed! Department name is required.</p>
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
                                <table id="departments" class="table table-lg mt-1">
                                    <thead>
                                        <tr class="align-middle">
                                            <th scope="col"></th>
                                            <th scope="col">Department Name</th>
                                            <th scope="col">College Name</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        $departmentArray = $department->show();
                                        foreach ($departmentArray as $item) {
                                        ?>
                                            <tr class="align-middle">
                                                <td> <?= $counter ?> </td>
                                                <td> <?= $item['department_name'] ?> </td>
                                                <td> <?= $item['college_name'] ?></td>
                                                <td class="text-center text-nowrap">
                                                    <div class="m-0 p-0">
                                                        <form action="./settings-department.php?id=<?= $item['department_id'] ?>" method="post">
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
                                <a href="./department.php" class="text-decoration-none text-dark">
                                    <p class="m-0">Department added succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                                <a href="./department.php" class="text-decoration-none text-dark">
                                    <p class="m-0">Department updated succesfully! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                                <a href="./department.php" class="text-decoration-none text-dark">
                                    <p class="m-0 text-dark">Department has been deleted! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
                                $record = $department->fetch($_GET['id']);
                                ?>
                                <p class="m-0 text-dark">Are you sure you want to delete <span class="text-primary fw-bold"><?= $record['department_name'] ?></span>?</p>
                                <form action="./department.php?id=<?= $record['department_id'] ?>" method="post" class="mt-3">
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
    <script src="../js/departments.datatable.js"></script>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
        myModal.show()
    </script>
</body>

</html>