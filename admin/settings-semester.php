<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/semester.class.php');

if (isset($_POST['save'])) {
    $semester = new Semester();

    $semester->semester_number = htmlentities($_POST['sem']);
    $semester->start_date = htmlentities($_POST['sdate']);
    $semester->end_date = htmlentities($_POST['edate']);

    if (
        validate_field($semester->semester_number) &&
        validate_field($semester->start_date) &&
        validate_field($semester->end_date) &&
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
                            <div class="row h-auto d-flex justify-content-center m-0 p-0">
                                <form method="post" action="" class="col-12">
                                    <div class="row">
                                        <div class="mb-2 col-md-6">
                                            <label for="sdate" class="form-label">Start Date:</label>
                                            <input type="datetime-local" class="form-control" id="sdate" name="sdate" value="<?php if (isset($_POST['sdate'])) {
                                                                                                                                    echo $_POST['sdate'];
                                                                                                                                } ?>" required>
                                            <?php
                                            if (isset($_POST['sdate']) && !validate_field($_POST['sdate'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">Start date is required.</p>
                                            <?php
                                            } else if (isset($_POST['sdate']) && !check_date($_POST['sdate'], $_POST['edate'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">Start date can't be later than the end date.</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <label for="edate" class="form-label">End Date:</label>
                                            <input type="datetime-local" class="form-control" id="edate" name="edate" value="<?php if (isset($_POST['edate'])) {
                                                                                                                                    echo $_POST['edate'];
                                                                                                                                } ?>" required>
                                            <?php
                                            if (isset($_POST['edate']) && !validate_field($_POST['edate'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">End date is required.</p>
                                            <?php
                                            } else if (isset($_POST['edate']) && !check_date($_POST['sdate'], $_POST['edate'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">End date can't be earlier than the start date.</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <label for="sem" class="form-label">Semester:</label>
                                            <input type="number" min="1" max="3" pattern="[1-3]" class="form-control" id="sem" name="sem" oninput="validateinputsem(this)" value="<?php if (isset($_POST['sem'])) {
                                                                                                                                                                                        echo $_POST['sem'];
                                                                                                                                                                                    } ?>" required>
                                            <?php
                                            if (isset($_POST['sem']) && !validate_field($_POST['sem'])) {
                                            ?>
                                                <p class="fs-7 text-primary m-0 ps-2">Semester is required.</p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="mt-2 col-md-6 text-end">
                                            <br class="d-none d-md-block ">
                                            <input type="submit" class="btn btn-primary btn-settings-size" name="save" value="Save">
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                <a href="./settings.php" class="text-decoration-none text-dark">
                                    <p class="m-0">Semester has been successfully set up! <span class="text-primary fw-bold">Click to Continue</span>.</p>
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
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
        myModal.show()
    </script>
</body>

</html>