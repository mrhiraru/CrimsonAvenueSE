<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/college.class.php');

if (isset($_POST['add'])) {
    $college = new College();

}


?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Settings | Crimson Avenue";
$settings_page = "active";
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
                <main class="col-md-9 pt-4 ms-sm-auto col-lg-10 px-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="container-fluid mb-3 p-0 bg-white shadow rounded">
                                <div class="row h-auto m-0 mb-4 d-flex justify-content-center">
                                    <h2 class="h2 mb-3 mt-3 ms-3 lh-1 text-primary fw-bold">Settings</h2>
                                    <hr class="m-0 text-primary opacity-25">
                                    <!-- new design  -->
                                    <div class="list-group list-group-flush p-0 mb-2">
                                        <a href="./settings.colleges.php" class="list-group-item list-group-item-action text-dark fw-semibold active disabled ">
                                            Colleges
                                        </a>
                                    </div>
                                    <form method="post" action="" class="col-12 my-3">
                                        <div class="row">
                                            <div class="mb-2 col-lg-6">
                                                <label for="col-name" class="form-label">College Name:</label>
                                                <input type="text" class="form-control" id="col-name" name="col-name">
                                                <?php
                                                if (isset($_POST['col-name']) && !validate_field($_POST['col-name'])) {
                                                ?>
                                                    <p class="fs-7 text-primary m-0 ps-2">College name is required.</p>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="mt-2 col-lg-6 text-end">
                                                <br class="d-none d-lg-block ">
                                                <input type="submit" class="btn btn-primary btn-settings-size" name="add" value="Add">
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
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