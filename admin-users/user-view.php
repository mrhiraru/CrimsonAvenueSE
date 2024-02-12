<?php
session_start();

require_once('../tools/functions.php');
require_once('../classes/account.class.php');

$account = new Account();
$record = $account->fetch($_GET['id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
} else if (!isset($_GET['id']) || $record['is_deleted'] == 1 || !isset($record['account_id'])) {
    header('location: ./index.php');
}

if (isset($_POST['user_role'])) {

    $account->user_role = htmlentities($_POST['user_role']);
    $account->account_id = $_GET['id'];

    if (validate_field($account->user_role)) {
        if ($account->update_role()) {

            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['restriction'])) {

    $account->restriction_status = htmlentities($_POST['restriction']);
    $account->account_id = $_GET['id'];

    if (validate_field($account->restriction_status)) {
        if ($account->update_restriction()) {
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
$title = "User View | Crimson Avenue";
$users_page = "active";
$user_page = "active";
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
                    <div class="container-fluid bg-white shadow rounded m-0 p-3">
                        <div class="row d-flex justify-content-between m-0 p-0">
                            <div class="col-12 col-lg-auto m-0 p-3 d-flex flex-column justify-content-center align-items-center">
                                <img src="<?php if (isset($record['profile_image'])) {
                                                echo "../images/data/" . $record['profile_image'];
                                            } else {
                                                echo "../images/main/no-profile.jpg";
                                            } ?>" alt="" class="profile-size border border-secondary-subtle rounded-2">
                            </div>
                            <div class="col-auto d-none d-lg-block p-0 m-0 border-start"></div>
                            <div class="col-12 col-lg-auto m-0 p-3 d-flex justify-content-start align-items-start flex-fill row">

                                <table class="table table-sm border-top m-0">
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Name</td>
                                        <td class="fw-semibold text-dark ps-3"><?php if (isset($record['middlename'])) {
                                                                                    echo ucwords(strtolower($record['firstname'] . ' ' . $record['middlename'] . ' ' . $record['lastname']));
                                                                                } else {
                                                                                    echo ucwords(strtolower($record['firstname'] . ' ' . $record['lastname']));
                                                                                } ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Gender</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $record['gender'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Affiliation</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $record['affiliation'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">College</td>
                                        <td class="fw-semibold text-dark ps-3"><?php if (isset($record['college_name'])) {
                                                                                    echo $record['college_name'];
                                                                                } else {
                                                                                    echo "No College";
                                                                                } ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Department</td>
                                        <td class="fw-semibold text-dark ps-3"><?php if (isset($record['department_name'])) {
                                                                                    echo $record['department_name'];
                                                                                } else {
                                                                                    echo "No Department";
                                                                                }  ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Email</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $record['email'] ?> <span class="text-primary fw-semibold float-end"><?= $record['verification_status'] ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Contact</td>
                                        <td class="fw-semibold text-dark ps-3"><?= $record['contact'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Address</td>
                                        <td class="fw-semibold text-dark ps-3"><?php if (isset($record['address'])) {
                                                                                    echo $record['address'];
                                                                                } else {
                                                                                    echo "No Address";
                                                                                } ?> </td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">User Role</td>
                                        <td class="fw-semibold text-dark ps-3">
                                            <?php if ($record['user_role'] == 0) {
                                                echo "Administrator";
                                            } else if ($record['user_role'] == 1) {
                                                echo "Moderator";
                                            } else if ($record['user_role'] == 2) {
                                                echo "User";
                                            }
                                            if ($record['user_role'] != 0) { ?> <button class="text-primary float-end border-0 bg-white fw-semibold " data-bs-toggle="modal" data-bs-target="#userRoleModal">Change</button> <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Restriction</td>
                                        <td class="fw-semibold text-dark ps-3">
                                            <?php echo $record['restriction_status'];
                                            if ($record['user_role'] != 0) { ?> <button class="text-primary float-end border-0 bg-white fw-semibold" data-bs-toggle="modal" data-bs-target="#restrictionModal">Change</button> <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <div class="modal fade" id="userRoleModal" tabindex="-1" aria-labelledby="userRoleModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header py-2 px-3">
                    <h1 class="modal-title fs-6 text-primary" id="exampleModalLabel">Update User Role</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <form action="./user-view.php?id=<?= $record['account_id'] ?>" method="post" class="col-12 m-0" name="useRole" id="useRole">
                                <div class="form-group m-0 p-0 d-flex row justify-content-evenly">
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="user_role" id="user" value="2" onchange="autoSubmitRole()" <?php if ($record['user_role'] == 2) {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>>
                                        <label class="form-check-label" for="user">
                                            User
                                        </label>
                                    </div>
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="user_role" id="moderator" value="1" onchange="autoSubmitRole()" <?php if ($record['user_role'] == 1) {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>>
                                        <label class="form-check-label" for="moderator">
                                            Moderator
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="restrictionModal" tabindex="-1" aria-labelledby="restrictionModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2 px-3">
                    <h1 class="modal-title fs-6 text-primary" id="exampleModalLabel">Update Restriction</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <form action="./user-view.php?id=<?= $record['account_id'] ?>" method="post" class="col-12 m-0" name="accRestriction" id="accRestriction">
                                <div class="form-group m-0 p-0 row d-flex justify-content-evenly">
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="restriction" id="unrestricted" value="Unrestricted" onchange="autoSubmitRestriction()" <?php if ($record['restriction_status'] == "Unrestricted") {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>>
                                        <label class="form-check-label" for="unrestricted">
                                            Unrestricted
                                        </label>
                                    </div>
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="restriction" id="temporary" value="Restricted" onchange="autoSubmitRestriction()" <?php if ($record['restriction_status'] == "Restricted") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                        <label class="form-check-label" for="temporary">
                                            Restrict
                                        </label>
                                    </div>
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="restriction" id="permanent" value="Terminated" onchange="autoSubmitRestriction()" <?php if ($record['restriction_status'] == "Terminated") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                        <label class="form-check-label" for="permanent">
                                            Terminate
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['user_role']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a class="text-decoration-none text-dark" href="./user-view.php?id=<?= $record['account_id'] ?>">
                                    <p class="m-0">User role has been updated successfully!</br><span class="text-primary fw-bold">Click to continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['restriction']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a class="text-decoration-none text-dark" href="./user-view.php?id=<?= $record['account_id'] ?>">
                                    <p class="m-0">Restriction has been updated successfully!</br><span class="text-primary fw-bold">Click to continue</span>.</p>
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
        function autoSubmitRole() {
            var formObject = document.forms['useRole'];
            formObject.submit();
        }

        function autoSubmitRestriction() {
            var formObject = document.forms['accRestriction'];
            formObject.submit();
        }
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
        myModal.show()
    </script>
</body>

</html>