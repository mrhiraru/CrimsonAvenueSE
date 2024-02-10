<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
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
                                <img src="../images/main/no-profile.jpg" alt="" class="profile-responsive border border-secondary-subtle rounded-2">
                            </div>
                            <div class="col-auto d-none d-lg-block p-0 m-0 border-start"></div>
                            <div class="col-12 col-lg-auto m-0 p-3 d-flex justify-content-start align-items-start flex-fill row">
                                <table class="table table-sm border-top m-0">
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Name</td>
                                        <td class="fw-semibold text-dark ps-3">Last First Middle</td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Gender</td>
                                        <td class="fw-semibold text-dark ps-3">Male</td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Affiliation</td>
                                        <td class="fw-semibold text-dark ps-3">Student</td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">College</td>
                                        <td class="fw-semibold text-dark ps-3">Computing Studies</td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Department</td>
                                        <td class="fw-semibold text-dark ps-3">Computer Science</td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Email</td>
                                        <td class="fw-semibold text-dark ps-3">qb3242342@wmsu.edu.ph</td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Contact</td>
                                        <td class="fw-semibold text-dark ps-3">09876543213</td>
                                    </tr>
                                    <tr>
                                        <td class=" pe-3 text-secondary d-none d-md-block">Address</td>
                                        <td class="fw-semibold text-dark ps-3">452, Lanzones Dr. Guiwan, Zamboanga City</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <section class="container-fluid row m-0 mt-3 p-0 h-100">
                        <div class="col-lg-auto m-0 me-lg-2 p-3 bg-white shadow rounded d-flex flex-fill">
                            <form action="" method="post" class="col-12 row m-0">
                                <div class="mb-3 p-0 col-12">
                                    <label for="user_role">User Role</label>
                                </div>
                                <div class="form-group m-0 mb-3 p-0 row d-flex justify-content-evenly">
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="user_role" id="user" value="2" <?php if (isset($_POST['user_role']) && $_POST['user_role'] == 2) {
                                                                                                                                echo 'checked';
                                                                                                                            } else {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                        <label class="form-check-label" for="user">
                                            User
                                        </label>
                                    </div>
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="user_role" id="moderator" value="1" <?php if (isset($_POST['user_role']) && $_POST['user_role'] == 1) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                        <label class="form-check-label" for="moderator">
                                            Moderator
                                        </label>
                                    </div>
                                </div>
                                <div class="p-0 btn btn-settings-size">
                                    <input type="submit" class="btn btn-primary w-100 fw-semibold" name="signup" value="Save">
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-auto m-0 mt-3 ms-lg-2 mt-lg-0 p-3 bg-white shadow rounded d-flex flex-fill">
                            <form action="" method="post" class="col-12 row m-0">
                                <div class="mb-3 p-0 col-12">
                                    <label for="user_role"></label>
                                </div>
                                <div class="form-group m-0 p-0 row d-flex justify-content-evenly">
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="user_role" id="user" value="2" <?php if (isset($_POST['user_role']) && $_POST['user_role'] == 2) {
                                                                                                                                echo 'checked';
                                                                                                                            } else {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                        <label class="form-check-label" for="user">
                                            User
                                        </label>
                                    </div>
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="user_role" id="moderator" value="1" <?php if (isset($_POST['user_role']) && $_POST['user_role'] == 1) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                        <label class="form-check-label" for="moderator">
                                            Moderator
                                        </label>
                                    </div>
                                </div>
                                <div class="p-0 btn btn-settings-size">
                                    <input type="submit" class="btn btn-primary w-100 fw-semibold" name="signup" value="Save">
                                </div>
                            </form>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>