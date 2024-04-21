<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/semester.class.php');
require_once('../classes/admin-settings.class.php');

if (isset($_POST['save-sem'])) {
    $semester = new Semester();

    $semester->semester_number = htmlentities($_POST['sem']);
    $semester->start_date = htmlentities($_POST['sdate']);
    $semester->end_date = htmlentities($_POST['edate']);
    $semester->status = "Current";

    if (
        validate_field($semester->semester_number) &&
        validate_field($semester->start_date) &&
        validate_field($semester->end_date) &&
        validate_field($semester->status) &&
        check_date($semester->start_date, $semester->end_date)
    ) {
        if ($semester->add()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['edit-sem'])) {
    $semester = new Semester();

    $semester->semester_number = htmlentities($_POST['sem']);
    $semester->start_date = htmlentities($_POST['sdate']);
    $semester->end_date = htmlentities($_POST['edate']);
    $semester->semester_id = htmlentities($_POST['semester_id']);

    if (
        validate_field($semester->semester_number) &&
        validate_field($semester->start_date) &&
        validate_field($semester->end_date) &&
        validate_field($semester->semester_id) &&
        check_date($semester->start_date, $semester->end_date)
    ) {
        if ($semester->edit()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save-com'])) {
    $admin_settings = new AdminSettings();

    $admin_settings->commission = htmlentities($_POST['commission']);
    if (isset($_POST['commission_type'])) {
        $admin_settings->commission_type = htmlentities($_POST['commission_type']);
    } else {
        $admin_settings->commission_type = '';
    }

    if (
        validate_field($admin_settings->commission) &&
        validate_number($admin_settings->commission) &&
        validate_field($admin_settings->commission_type)
    ) {
        if ($admin_settings->update_commission()) {
            if ($admin_settings->calculate_commissions($admin_settings->commission, $admin_settings->commission_type)) {
                $success = 'success';
            } else {
                echo 'An error occured while adding in the database.';
            }
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
$title = "Settings | Crimson Avenue";
$settings_page = "active";
$semester_page = "active";
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
                <main class="col-md-9 col-lg-10 p-4 row m-0 h-100">
                    <div class="container-fluid bg-white shadow rounded m-0 mb-4 p-3">
                        <div class="row d-flex justify-content-start m-0 p-0">
                            <div class="col-12 m-0 p-0 px-1">
                                <p class="m-0 p-0 fs-5 fw-medium text-dark lh-1 flex-fill">
                                    School Year & Semester
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="my-2">
                            </div>
                            <form method="post" action="" class="col-12">
                                <div class="row">
                                    <?php
                                    $sem = new Semester();
                                    $current_sem = $sem->fetch();
                                    ?>
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-3">
                                        <span class="m-1">Start Date:</span>
                                        <input type="date" class="form-control" id="sdate" name="sdate" placeholder="YYYY-MM-DD" value="<?php if (isset($current_sem['start_date'])) {
                                                                                                                                            echo $current_sem['start_date'];
                                                                                                                                        } else if (isset($_POST['sdate'])) {
                                                                                                                                            echo $_POST['sdate'];
                                                                                                                                        } ?>" required>
                                        <?php
                                        if (isset($_POST['sdate']) && !validate_field($_POST['sdate'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Start date is required.</p>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-3">
                                        <span class="m-1">End Date:</span>
                                        <input type="date" class="form-control" id="edate" name="edate" placeholder="End Date" value="<?php if (isset($current_sem['end_date'])) {
                                                                                                                                            echo $current_sem['end_date'];
                                                                                                                                        } else if (isset($_POST['edate'])) {
                                                                                                                                            echo $_POST['edate'];
                                                                                                                                        } ?>" required>
                                        <?php
                                        if (isset($_POST['edate']) && !validate_field($_POST['edate'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">End date is required.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-3">
                                        <span class="m-1" id="basic-addon1">Semester:</span>
                                        <input type="number" min="1" max="3" pattern="[1-3]" class="form-control" id="sem" name="sem" placeholder="Semester" oninput="validateinputsem(this)" value="<?php if (isset($current_sem['semester_number'])) {
                                                                                                                                                                                                            echo $current_sem['semester_number'];
                                                                                                                                                                                                        } else if (isset($_POST['sem'])) {
                                                                                                                                                                                                            echo $_POST['sem'];
                                                                                                                                                                                                        } ?>">
                                        <?php
                                        if (isset($_POST['sem']) && !validate_field($_POST['sem'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Semester number is required.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-3 text-end">
                                        <br>
                                        <?php
                                        if (isset($current_sem['semester_id'])) {
                                        ?>
                                            <input type="hidden" name="semester_id" value="<?= $current_sem['semester_id'] ?>">
                                            <input type="submit" class="btn btn-primary btn-settings-size" name="edit-sem" value="Update">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="submit" class="btn btn-primary btn-settings-size" name="save-sem" value="Save">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mb-4 p-3">
                        <div class="row d-flex justify-content-start m-0 p-0">
                            <div class="col-12 m-0 p-0 px-1">
                                <p class="m-0 p-0 fs-5 fw-medium text-dark lh-1 flex-fill">
                                    Transaction Commission
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="my-2">
                            </div>
                            <?php
                            $admin_settings = new AdminSettings();
                            $admin_data = $admin_settings->fetch();
                            ?>
                            <form method="post" action="" class="col-12">
                                <div class="row">
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-4">
                                        <span for="commission" class="form-label">Commission Amount:</span>
                                        <input type="number" class="form-control" id="commission" name="commission" require step="any" oninput="negativetozero(this)" value="<?php if (isset($admin_data['commission'])) {
                                                                                                                                                                                    echo $admin_data['commission'];
                                                                                                                                                                                } else if (isset($_POST['commission'])) {
                                                                                                                                                                                    echo $_POST['commission'];
                                                                                                                                                                                } ?>">
                                        <?php
                                        if (isset($_POST['commission']) && !validate_field($_POST['commission'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Commission amount is required.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-4">
                                        <span for="commission_type" class="form-label">Commission Type:</span>
                                        <select class="form-select" id="commission_type" name="commission_type">
                                            <option value=""> </option>
                                            <option value="Percentage" <?php if ((isset($_POST['commission_type']) && $_POST['commission_type'] == "Percentage")) {
                                                                            echo 'selected';
                                                                        } else if ((isset($admin_data['commission_type']) && $admin_data['commission_type'] == "Percentage")) {
                                                                            echo 'selected';
                                                                        } ?>>Percentage</option>
                                            <option value="Fixed" <?php if ((isset($_POST['commission_type']) && $_POST['commission_type'] == "Fixed")) {
                                                                        echo 'selected';
                                                                    } else if ((isset($admin_data['commission_type']) && $admin_data['commission_type'] == "Fixed")) {
                                                                        echo 'selected';
                                                                    } ?>>Fixed</option>
                                        </select>
                                        <?php
                                        if (isset($_POST['commission_type']) && !validate_field($_POST['commission_type'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">No commission type is selected.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-4 text-end">
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-settings-size" value="Update" name="save-com">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- d-none eto sa baba, because not yet working  -->
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 d-none">
                        <div class="row d-flex justify-content-start m-0 p-0">
                            <div class="col-12 m-0 p-0 px-1">
                                <p class="m-0 p-0 fs-5 fw-medium text-dark lh-1 flex-fill">
                                    Transfer Administrator Privilege
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="my-2">
                            </div>
                            <form method="post" action="" class="col-12">
                                <div class="row">
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-4">
                                        <span for="newadmin" class="form-label">New Administrator:</span>
                                        <input type="text" class="form-control" id="newadmin" name="newadmin" required>
                                        <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                    </div>
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-4">
                                        <span for="password" class="form-label">Enter your password:</span>
                                        <input type="text" class="form-control" id="password" name="password" required>
                                        <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                    </div>
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-4 text-end">
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-settings-size" value="Save">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <!-- semester modal  -->
    <?php
    if (isset($_POST['save-sem']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./index.php" class="text-decoration-none text-dark">
                                    <p class="m-0">Semester has been successfully set up! <span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else  if (isset($_POST['edit-sem']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./index.php" class="text-decoration-none text-dark">
                                    <p class="m-0">Semester has been successfully updated! <span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else  if (isset($_POST['save-com']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./index.php" class="text-decoration-none text-dark">
                                    <p class="m-0">Commission has been successfully updated! <span class="text-primary fw-bold">Click to Continue</span>.</p>
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