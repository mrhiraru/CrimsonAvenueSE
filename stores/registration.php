<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($_SESSION['user_role'])) {
    header('location: ../user/login.php');
} else if (isset($_SESSION['affiliation']) && $_SESSION['affiliation'] == 'Non-student') {
    header('location: ../store/stores.php');
}

require_once('../tools/functions.php');
require_once('../classes/college.class.php');
require_once('../classes/account.class.php');
require_once('../classes/store.class.php');

if (isset($_POST['register'])) {
    $store = new Store();

    $store->store_name = htmlentities($_POST['store-name']);
    $store->account_id = $_SESSION['account_id'];
    $store->staff_role = 0;

    if (!isset($_POST['college_id']) || $_POST['college_id'] == 'null') {
        $store->college_id = null;
    } else {
        $store->college_id = htmlentities($_POST['college_id']);
    }
    $store->certificate = htmlentities($_POST['certificate']);
    $store->verification_status = 'Not Verified';

    if (
        validate_field($store->store_name) &&
        validate_field($store->account_id) &&
        validate_field($store->certificate) &&
        validate_field($store->verification_status)
    ) {
        if ($store->add()) {
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
$title = "Store Registration | Crimson Avenue";
$store_page = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body class="min-vh-100">
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto">
        <main>
            <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                <div class="row d-flex flex-column justify-content-center align-items-center m-0 my-5 p-0">
                    <p class="m-0 mb-3 p-0 text-center fs-3 fw-semibold text-primary">
                        Store Registration
                    </p>
                    <form action="" method="post" class="row d-flex p-2 p-md-0 m-0 col-lg-5">
                        <div class="mb-3 p-0 col-12">
                            <input type="text" name="store-name" placeholder="Store Name" class="form-control" value="<?php if (isset($_POST['store-name'])) {
                                                                                                                            echo $_POST['store-name'];
                                                                                                                        } ?>">
                            <?php
                            if (isset($_POST['store-name']) && !validate_field($_POST['store-name'])) {
                            ?>
                                <p class="fs-7 text-primary m-0 ps-2">Store name is required.</p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="mb-2 p-0 col-12">
                            <select name="college_id" id="college_id" class="form-select">
                                <option value="">Select College</option>
                                <option value="null" <?php if ((isset($_POST['college_id']) && $_POST['college_id'] == 'null')) {
                                                            echo 'selected';
                                                        } ?>>Independent (No College)</option>
                                <?php
                                $college = new College();
                                $collegeArray = $college->show();
                                foreach ($collegeArray as $item) { ?>
                                    <option value="<?= $item['college_id'] ?>" <?php if ((isset($_POST['college_id']) && $_POST['college_id'] == $item['college_id'])) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $item['college_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <?php
                            if (isset($_POST['college_id']) && !validate_field($_POST['college_id'])) {
                            ?>
                                <p class="fs-7 text-primary m-0 ps-2">No college selected.</p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="mb-3 p-0 col-12">
                            <!-- Upload image or pdf copy of your certificate to verify that you are a WMSU student. -->
                            <label for="certificate" class="fs-8 text-dark lh-sm ms-2">Upload image or pdf copy of your certificate to verify that you're a WMSU student or faculty.</label>
                            <input type="file" id="certificate" name="certificate" placeholder="Certificate" class="form-control" value="<?php if (isset($_POST['cetificate'])) {
                                                                                                                                                echo $_POST['cetificate'];
                                                                                                                                            } ?>">
                            <?php
                            if (isset($_POST['certificate']) && !validate_field($_POST['certificate'])) {
                            ?>
                                <p class="fs-7 text-primary m-0 ps-2">Certificate is required.</p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="mb-3 p-0 col-12">
                            <input type="submit" class="btn btn-primary w-100 fw-semibold" name="register" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <section>
            <!-- Code Here Extra Section -->
        </section>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <!-- modals  -->
    <?php
    if (isset($_POST['register']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./registration.php" class="text-decoration-none text-dark">
                                    <p class="m-0 text-dark">Store is successfully created! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    require_once('../includes/js.php');
    ?>
    <script>
        var select_college = document.querySelector('#college_id');
        dselect(select_college, {
            search: true,
            maxHeight: '100px',
        });

        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
        myModal.show();
    </script>
</body>

</html>