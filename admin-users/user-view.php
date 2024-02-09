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
                <main class="col-md-9 col-lg-10 p-4 row m-0">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3">
                        <div class="row h-auto d-flex justify-content-between m-0 p-0">
                            <div class="col-12 col-lg-auto p-0 d-flex justify-content-center p-3">
                                <img src="../images/main/no-profile.jpg" alt="" class="profile-responsive border border-black">
                            </div>
                            <div class="col-12 col-lg-auto p-0 d-flex justify-content-center p-3 ps-0 flex-fill">
                                
                            </div>
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