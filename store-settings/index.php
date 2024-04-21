<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/image.class.php";

$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);


if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Store Information | Crimson Avenue";
$settingsindex_page = "active";
$settings_page = "active";
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
                <main class="col-md-9 col-lg-10 p-4 row m-0">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row d-flex justify-content-start m-0 p-0">
                            <div class="col-12 m-0 p-0 px-1">
                                <p class="m-0 p-0 fs-5 fw-medium text-dark lh-1 flex-fill">
                                    Store Information
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="my-2">
                            </div>
                            <form method="post" action="" class="col-12">
                                <div class="row">
                                    <?php
                                   // $sem = new Semester();
                                    //$current_sem = $sem->fetch();
                                    ?>
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-3">
                                        <span class="m-1">Start Date:</span>
                                        <input type="date" class="form-control" id="sdate" name="sdate" placeholder="YYYY-MM-DD" value="" required>
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
                                        <input type="date" class="form-control" id="edate" name="edate" placeholder="End Date" value="" required>
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
                                        <input type="number" min="1" max="3" pattern="[1-3]" class="form-control" id="sem" name="sem" placeholder="Semester" oninput="validateinputsem(this)" value="">
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
                </main>
            </div>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>