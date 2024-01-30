<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/semester.class.php');
require_once('../classes/college.class.php');
require_once('../classes/department.class.php');


if (isset($_POST['save-sem'])) {
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
                                    <div class="list-group list-group-flush p-0">
                                        <a href="./settings.semester.php" class="list-group-item list-group-item-action text-dark fw-semibold">School Year and Semester</a>
                                        <a href="./settings.college.php" class="list-group-item list-group-item-action text-dark fw-semibold ">Colleges</a>
                                        <a href="./settings.department.php" class="list-group-item list-group-item-action text-dark fw-semibold ">Departments</a>
                                        <a href="#" class="list-group-item list-group-item-action text-dark fw-semibold ">Moderators</a>
                                        <a href="#" class="list-group-item list-group-item-action text-dark fw-semibold ">Transfer Administrator Privilege</a>
                                    </div>

                                    <!-- accordian settings -->
                                    <div class="accordion accordion-flush p-0 mb-3" id="accordionExample">
                                        <div class="accordion-item border-0">
                                            <h2 class="accordion-header" id="headingOne">

                                                <div class="accordion-item border-0 rounded-0">
                                                    <h2 class="accordion-header" id="headingFive">
                                                        <button class="accordion-button <?php if (!isset($_GET['moderator-id'])) {
                                                                                            echo 'collapsed';
                                                                                        } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="<?php if (!isset($_GET['moderator-id'])) {
                                                                                                                                                                                    echo 'false';
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo 'true';
                                                                                                                                                                                } ?>" aria-controls="collapseFive">
                                                            <p class="m-0 p-0 text-dark fw-semibold">Assign Moderator</p>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseFive" class="accordion-collapse collapse <?php if (isset($_GET['moderator-id'])) {
                                                                                                                    echo 'show';
                                                                                                                } ?>" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                        <hr class="m-0 text-dark opacity-25 ">
                                                        <div class="accordion-body m-0">
                                                            <form method="post" action="" class="col-12">
                                                                <div class="row">
                                                                    <div class="mb-2 col-md-6 col-lg-4"><label for="select-college" class="form-label">Select College:</label>
                                                                        <select name="select-college" id="select-college" class="form-select">
                                                                            <option value=""></option>
                                                                            <option value="College of Agriculture">College of Agriculture</option>\
                                                                        </select>
                                                                        <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                                    </div>
                                                                    <div class="mb-2 col-md-6 col-lg-4"><label for="select-mod" class="form-label">Select Moderator:</label>
                                                                        <select name="select-mod" id="select-mod" class="form-select">
                                                                            <option value=""></option>
                                                                            <option value="Moderator value">Name of the moderator</option>\
                                                                        </select>
                                                                        <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                                    </div>
                                                                    <div class="mb-4 mt-2 col-lg-4 text-end">
                                                                        <br class="d-none d-lg-block ">
                                                                        <?php
                                                                        if (isset($_GET['moderator-id']) && $_GET['moderator-id'] != 0) {
                                                                        ?>
                                                                            <a href="?moderator-id=0" class="btn btn-cancel btn-settings-size">Cancel</a>
                                                                            <input type="submit" class="btn btn-primary btn-settings-size" name="save" value="Save">
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <input type="submit" class="btn btn-primary btn-settings-size" name="add" value="Add">
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                                                                <div class="col">
                                                                    <div class="card p-2">
                                                                        <div class="card-body row m-0 py-1 px-2">
                                                                            <div class="col-12 p-0 fw-semibold text-nowrap overflow-hidden ">
                                                                                Moderator ASAKLHSAHSAHLHASLHALKSa
                                                                            </div>
                                                                            <div class="col-12 p-0 d-flex flex-row justify-content-end">
                                                                                <a href="?moderator-id=1" class="text-dark text-decoration-none pe-3">Edit</a>
                                                                                <form action="" method="post">
                                                                                    <input type="submit" class="text-primary border-0 bg-white" value="Delete">
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="m-0 text-dark opacity-25 ">
                                                    </div>
                                                </div>
                                                <div class="accordion-item border-0 rounded-0">
                                                    <h2 class="accordion-header" id="headingFour">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                            <p class="m-0 p-0 text-dark fw-semibold">Transfer Administrator Privilege</p>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                        <hr class="m-0 text-dark opacity-25 ">
                                                        <div class="accordion-body m-0">
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
                                                                        <label for="password" class="form-label">Enter your Password:</label>
                                                                        <input type="text" class="form-control" id="password" name="password" required>
                                                                        <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                                    </div>
                                                                    <div class="mb-4 mt-2 col-lg-4 text-end">
                                                                        <br class="d-none d-lg-block ">
                                                                        <input type="submit" class="btn btn-primary " value="Save">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <hr class="m-0 text-dark opacity-25 ">
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
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