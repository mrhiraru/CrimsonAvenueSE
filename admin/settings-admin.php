<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');

if (isset($_POST['add'])) {
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Settings | Crimson Avenue";
$settings_page = "active";
$admin = "active";
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
                                        <div class="mb-2 col-md-6 col-lg-4">
                                            <label for="newadmin" class="form-label">New Administrator:</label>
                                            <input type="text" class="form-control" id="newadmin" name="newadmin" list="usernames" required>
                                            <datalist id="usernames">
                                                <option value="Franklin Oliveros">
                                                <option value="Hilal Abdulajid">
                                                <option value="Wilfred Borjal">
                                            </datalist>
                                            <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                        </div>
                                        <div class="mb-2 col-md-6 col-lg-4">
                                            <label for="password" class="form-label">Enter your password:</label>
                                            <input type="text" class="form-control" id="password" name="password" required>
                                            <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                        </div>
                                        <div class="mt-2 col-lg-4 text-end">
                                            <br class="d-none d-lg-block ">
                                            <input type="submit" class="btn btn-primary btn-settings-size" value="Save">
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