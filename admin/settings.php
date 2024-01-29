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
                <main class="col-md-9 pt-4 ms-sm-auto col-lg-10 px-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="container-fluid mb-3 p-0 bg-white shadow rounded">
                                <div class="row h-auto m-0 mb-4 d-flex justify-content-center">
                                    <h2 class="h2 mb-3 mt-3 ms-3 lh-1 text-primary fw-bold">Settings</h2>
                                    <!-- accordian settings -->
                                    <div class="accordion accordion-flush p-0 border-0" id="accordionExample">
                                        <div class="accordion-item border-0">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    <p class="m-0 p-0 text-dark fw-semibold">Semester & School Year</p>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <hr class="m-0 text-dark opacity-25 ">
                                                <div class="accordion-body">
                                                    <form method="post" action="" class="col-12">
                                                        <div class="row">
                                                            <div class="mb-2 col-4">
                                                                <label for="sem" class="form-label">Semester:</label>
                                                                <input type="text" class="form-control" id="sem" name="sem" required>
                                                                <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                            </div>
                                                            <div class="mb-2 col-4">
                                                                <label for="sdate" class="form-label">Start Date:</label>
                                                                <input type="datetime-local" class="form-control" id="sdate" name="sdate" required>
                                                                <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                            </div>
                                                            <div class="mb-2 col-4">
                                                                <label for="edate" class="form-label">End Date:</label>
                                                                <input type="datetime-local" class="form-control" id="edate" name="edate" required>
                                                                <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                                                            </div>
                                                            <div class="mt-2 col-12 text-end">
                                                                <!-- change back to submit  -->
                                                                <input type="submit" class="btn btn-primary " value="Save">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <hr class="m-0 text-dark opacity-25 ">
                                            </div>
                                        </div>
                                        <div class="accordion-item border-0 rounded-0">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <p class="m-0 p-0 text-dark fw-semibold">College</p>
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item border-0 rounded-0">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Accordion Item #3
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>