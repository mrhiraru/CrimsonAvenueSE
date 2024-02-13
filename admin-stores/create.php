<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/college.class.php');
require_once('../classes/account.class.php');
require_once('../classes/store.class.php');


?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Create Store | Crimson Avenue";
$stores_page = "active";
$createstore_page = "active";
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
                require_once('../includes/sidepanel.admin.php');
                ?>
                <main class="col-md-9 col-lg-10 p-4 row m-0">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row h-100 d-flex flex-column justify-content-center align-items-center m-0 p-0">
                            <p class="m-0 mb-3 p-0 text-center fs-3 fw-semibold text-primary">
                                Create Store
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
                                <div class="mb-2 p-0 col-12">
                                    <select name="account_id" id="account_id" class="form-select" list="names">
                                        <option value="">Select Owner's Email</option>
                                        <?php
                                        $account = new Account();
                                        $accountArray = $account->show();
                                        foreach ($accountArray as $item) { ?>
                                            <option value="<?= $item['account_id'] ?>" <?php if ((isset($_POST['account_id']) && $_POST['account_id'] == $item['account_id'])) {
                                                                                            echo 'selected';
                                                                                        } ?>><?php if (isset($item['middlename'])) {
                                                                                                    echo ucwords(strtolower($item['firstname'] . ' ' . $item['middlename'] . ' ' . $item['lastname']));
                                                                                                } else {
                                                                                                    echo ucwords(strtolower($item['firstname'] . ' ' . $item['lastname']));
                                                                                                } ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                    if (isset($_POST['college']) && !validate_field($_POST['college'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">No college selected.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <!-- Upload image or pdf copy of your certificate to verify that you are a WMSU student. -->
                                    <label for="" class="fs-8 text-dark lh-sm ms-2">Upload image or pdf copy of certificate to verify the owner as WMSU student or faculty.</label>
                                    <input type="file" name="cetificate" placeholder="Certificate" class="form-control" value="<?php if (isset($_POST['cetificate'])) {
                                                                                                                                    echo $_POST['cetificate'];
                                                                                                                                } ?>">
                                    <?php
                                    if (isset($_POST['cetificate']) && !validate_field($_POST['cetificate'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">Certificate is required.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group m-0 mb-3 p-0 row col-12 d-flex justify-content-evenly">
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="registration_status" id="verified" value="Verified" <?php if (isset($_POST['registration_status']) && $_POST['registration_status'] == "Verified") {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } else {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>>
                                        <label class="form-check-label" for="verified">
                                            Verified
                                        </label>
                                    </div>
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="registration_status" id="not-verified" value="Not Verified" <?php if (isset($_POST['not-registration_status']) && $_POST['registration_status'] == "Not Verified") {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        } ?>>
                                        <label class="form-check-label" for="moderator">
                                            Not Verified
                                        </label>
                                    </div>
                                    <?php
                                    if ((isset($_POST['registration_status'])  && !validate_field($_POST['registration_status']))) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2 col-12">No registration status selected.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <input type="submit" class="btn btn-primary w-100 fw-semibold" name="create" value="Save">
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

    <script>
        var select_account = document.querySelector('#account_id');
        dselect(select_account, {
            search: true,
            maxHeight: '100px',
        });

        var select_college = document.querySelector('#college_id');
        dselect(select_college, {
            search: true,
            maxHeight: '100px',
        });
    </script>
</body>

</html>