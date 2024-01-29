<?php 
session_start();

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
                <main class="col-md-9 pt-3 ms-sm-auto col-lg-10 px-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="container-fluid mb-3 p-3 bg-white shadow rounded">
                                <div class="row h-auto mb-4 d-flex justify-content-center">
                                    <h2 class="h2 text-primary fw-bold">Settings</h2>
                                    <hr class="text-secondary">
                                    <!-- Start content -->
                                    <div class="col-12" id="semester">
                                        <hr class="text-secondary d-none">
                                        <h2 class="h4 text-primary fw-semibold">Semester & School Year</h2>
                                        <form method="post" action="" class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="mb-2 col-12">
                                                    <label for="sem" class="form-label">Semester:</label>
                                                    <input type="text" class="form-control" id="sem" name="sem" required>
                                                    <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                </div>
                                                <div class="mb-2 col-12 col-lg-6">
                                                    <label for="sdate" class="form-label">Start Date:</label>
                                                    <input type="datetime-local" class="form-control" id="sdate" name="sdate" required>
                                                    <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                </div>

                                                <div class="mb-2 col-12 col-lg-6">
                                                    <label for="edate" class="form-label">End Date:</label>
                                                    <input type="datetime-local" class="form-control" id="edate" name="edate" required>
                                                    <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                </div>
                                                <div class="mt-2 col-12 text-end  text-lg-start">
                                                    <!-- change back to submit  -->
                                                    <button type="button" class="btn btn-success brand-bg-color" id="createNewStoreButton" data-bs-toggle="modal" data-bs-target="#addsSemModal">Save</button>
                                                    <a href="./set-semester.php" class="text-decoration-none text-white btn btn-primary border-0 flex-grow-1 flex-sm-grow-0 ms-2">
                                                        View
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end content -->
                                    <!-- Start content -->
                                    <div class="col-12" id="college">
                                        <hr class="text-secondary">
                                        <h2 class="h4 text-primary fw-semibold">College</h2>
                                        <form method="post" action="" class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="mb-2 col-12">
                                                    <label for="col-name" class="form-label">College Name:</label>
                                                    <input type="text" class="form-control" id="col-name" name="col-name" required>
                                                    <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                </div>
                                                <div class="mb-2 col-12"><label for="select-moderator" class="form-label">Moderator:</label>
                                                    <select name="select-moderator" id="select-moderator" class="form-select">
                                                        <option value=""></option>
                                                        <option value="">Mark Flores</option>
                                                        <option value="">Rubert V. Dela Cruz</option>
                                                    </select>
                                                    <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                </div>
                                                <div class="mt-2 col-12 text-end  text-lg-start">
                                                    <!-- change back to submit  -->
                                                    <button type="button" class="btn btn-success brand-bg-color" id="createNewStoreButton" data-bs-toggle="modal" data-bs-target="#addsColModal">Save</button>
                                                    <a href="./set-college.php" class="text-decoration-none text-white btn btn-primary border-0 flex-grow-1 flex-sm-grow-0 ms-2">
                                                        View
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end content -->
                                    <!-- Start content -->
                                    <div class="col-12" id="department">
                                        <hr class="text-secondary">
                                        <h2 class="h4 text-primary fw-semibold">Department</h2>
                                        <div class="col-12">

                                            <form method="post" action="" class="col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="mb-2 col-12">
                                                        <label for="col-name" class="form-label">Department Name:</label>
                                                        <input type="text" class="form-control" id="col-name" name="col-name" required>
                                                        <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                    </div>
                                                    <div class="mb-2 col-12"><label for="select-college" class="form-label">Select College:</label>
                                                        <select name="select-college" id="select-college" class="form-select">
                                                            <option value=""></option>
                                                            <option value="College of Agriculture">College of Agriculture</option>
                                                            <option value="College of Architecture">College of Architecture</option>
                                                            <option value="College of Asian and Islamic Studies">College of Asian and Islamic Studies</option>
                                                            <option value="College of Computing Studies">College of Computing Studies</option>
                                                            <option value="College of Criminal Justice Education">College of Criminal Justice Education</option>
                                                            <option value="College of Engineering">College of Engineering</option>
                                                            <option value="College of Forestry and Environmental Studies">College of Forestry and Environmental Studies</option>
                                                            <option value="College of Home Economics">College of Home Economics</option>
                                                            <option value="College of Law">College of Law</option>
                                                            <option value="College of Liberal Arts">College of Liberal Arts</option>
                                                            <option value="College of Nursing">College of Nursing</option>
                                                            <option value="College of Public Administration and Development Justice">College of Public Administration and Development Justice</option>
                                                            <option value="College of Sport Science and Physical Education">College of Sport Science and Physical Education</option>
                                                            <option value="College of Science and Mathematics">College of Science and Mathematics</option>
                                                            <option value="College of Social Work and Community Development">College of Social Work and Community Development</option>
                                                            <option value="College of Teacher Education">College of Teacher Education</option>
                                                        </select>
                                                        <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                    </div>
                                                    <div class="mt-2 col-12 text-end  text-lg-start">
                                                        <!-- change back to submit  -->
                                                        <button type="button" class="btn btn-success brand-bg-color" id="createNewStoreButton" data-bs-toggle="modal" data-bs-target="#addsDeptModal">Save</button>
                                                        <a href="./set-department.php" class="text-decoration-none text-white btn btn-primary border-0 flex-grow-1 flex-sm-grow-0 ms-2">
                                                            View
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <!-- end content -->
                                    <!-- Start content -->
                                    <div class="col-12" id="category">
                                        <hr class="text-secondary">
                                        <h2 class="h4 text-primary fw-semibold">Product Category</h2>
                                        <div class="col-12">
                                            <form method="post" action="" class="col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="mb-2 col-12">
                                                        <label for="cat-name" class="form-label">Category Name:</label>
                                                        <input type="text" class="form-control" id="cat-name" name="cat-name" required>
                                                        <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                    </div>
                                                    <div class="mt-2 col-12 text-end text-lg-start">
                                                        <!-- change back to submit  -->
                                                        <button type="button" class="btn btn-success brand-bg-color" id="createNewStoreButton" data-bs-toggle="modal" data-bs-target="#addsCatModal">Save</button>
                                                        <a href="./set-category.php" class="text-decoration-none text-white btn btn-primary border-0 flex-grow-1 flex-sm-grow-0 ms-2">
                                                            View
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- end content -->
                                    <!-- Start content -->
                                    <div class="col-12" id="privilege">
                                        <hr class="text-secondary">
                                        <h2 class="h4 text-primary fw-semibold">Transfer Administrator Privilege</h2>
                                        <form method="post" action="" class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="mb-2 col-12">
                                                    <label for="newadmin" class="form-label">New Administrator:</label>
                                                    <input type="text" class="form-control" id="newadmin" name="newadmin" list="usernames" required>
                                                    <datalist id="usernames">
                                                        <option value="Franklin Oliveros">
                                                        <option value="Hilal Abdulajid">
                                                        <option value="Wilfred Borjal">
                                                    </datalist>
                                                    <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                </div>
                                                <div class="mb-2 col-12">
                                                    <label for="password" class="form-label">Enter your Password:</label>
                                                    <input type="text" class="form-control" id="password" name="password" required>
                                                    <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                </div>
                                                <div class="mt-2 col-12 text-end  text-lg-start">
                                                    <!-- change back to submit  -->
                                                    <button type="button" class="btn btn-success brand-bg-color" id="createNewStoreButton" data-bs-toggle="modal" data-bs-target="#transferModal">Transfer</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end content -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <!-- Sem Created Modal -->
    <div class=" modal fade" id="addsSemModal" tabindex="-1" aria-labelledby="addsSemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="" class="row d-flex">
                        <div class=" col-12 text-center">
                            <button type="button" class="btn border-0 " data-bs-dismiss="modal" aria-label="Close"><span class="text-primary fw-semibold ">Semester and School Year is successfully added!</span><br>Click to Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sem Created Modal -->
    <!-- College Created Modal -->
    <div class=" modal fade" id="addsColModal" tabindex="-1" aria-labelledby="addsColModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="" class="row d-flex">
                        <div class=" col-12 text-center">
                            <button type="button" class="btn border-0 " data-bs-dismiss="modal" aria-label="Close"><span class="text-primary fw-semibold ">College is successfully added!</span><br>Click to Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- College Created Modal -->
    <!-- Department Created Modal -->
    <div class=" modal fade" id="addsDeptModal" tabindex="-1" aria-labelledby="addsDeptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="" class="row d-flex">
                        <div class=" col-12 text-center">
                            <button type="button" class="btn border-0 " data-bs-dismiss="modal" aria-label="Close"><span class="text-primary fw-semibold ">Department is successfully added!</span><br>Click to Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Department Created Modal -->
    <!-- Category Created Modal -->
    <div class=" modal fade" id="addsCatModal" tabindex="-1" aria-labelledby="addsCatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="" class="row d-flex">
                        <div class=" col-12 text-center">
                            <button type="button" class="btn border-0 " data-bs-dismiss="modal" aria-label="Close"><span class="text-primary fw-semibold ">Category is successfully added!</span><br>Click to Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Category Created Modal -->
    <!-- Transfer Created Modal -->
    <div class=" modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="" class="row d-flex">
                        <div class=" col-12 text-center">
                        <h6 class="h6 text-primary fw-semibold">Are you sure you want to transfer administrator privileges to <span class="text-secondary">[Name of New Admin]</span>?</h6>
                        </div>
                        <div class=" col-12 text-center">
                            <button type="button" class="btn btn-success brand-bg-color" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-danger brand-bg-color" name="transfer">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Transfer Created Modal -->
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>