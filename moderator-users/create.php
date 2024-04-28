<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1 || !isset($_SESSION['college_assigned'])) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/account.class.php');
require_once("../classes/college.class.php");

if (isset($_POST['signup'])) {
    $account = new Account();

    $account->email = htmlentities($_POST['email']);
    $account->password = htmlentities($_POST['password']);
    if (isset($_POST['affiliation'])) {
        $account->affiliation = htmlentities($_POST['affiliation']);
    } else {
        $account->affiliation = '';
    }
    $account->firstname = ucfirst(strtolower(htmlentities($_POST['first-name'])));
    if (isset($_POST['middle-name'])) {
        $account->middlename = ucfirst(strtolower(htmlentities($_POST['middle-name'])));
    } else {
        $account->middlename = '';
    }
    $account->lastname = ucfirst(strtolower(htmlentities($_POST['last-name'])));
    if (isset($_POST['gender'])) {
        $account->gender = htmlentities($_POST['gender']);
    } else {
        $account->gender = '';
    }

    $college = new College();
    if ($account->affiliation == 'Non-student') {
        $account->college_id = null;
    } else {
        $account->college_id = htmlentities($_POST['college']);
    }

    $account->contact = htmlentities($_POST['contact']);
    $account->user_role = htmlentities($_POST['user_role']); // user_role (0 = admin, 1 = mod, 2 = user)

    if (
        validate_field($account->email) &&
        validate_field($account->password) &&
        validate_field($account->affiliation) &&
        validate_field($account->firstname) &&
        // validate_field($account->middlename) &&
        validate_field($account->lastname) &&
        validate_field($account->gender) &&
        validate_affiliation($account->affiliation, $account->college_id) &&
        validate_field($account->contact) &&
        validate_password($account->password) &&
        validate_cpw($account->password, $_POST['confirm-password']) &&
        validate_email($account->email) == 'success' && !$account->is_email_exist() &&
        validate_wmsu_email($account->email, $account->affiliation) &&
        validate_field($account->user_role)
    ) {
        if ($account->add()) {
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
$title = "Create Account | Crimson Avenue";
$users_page = "active";
$create_page = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body onload="affiliation_effect()">
    <?php
    require_once('../includes/header.admin.php');
    ?>
    <main>
        <div class="container-fluid">
            <div class="row">
                <?php
                require_once('../includes/sidepanel.moderator.php')
                ?>
                <main class="col-md-9 col-lg-10 p-4 row m-0 h-100">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3">
                        <div class="row d-flex justify-content-center m-0 p-0">
                            <p class="m-0 mb-3 p-0 text-center fs-3 fw-semibold text-primary">
                                Create Account
                            </p>
                            <form action="" method="post" class="row d-flex p-2 p-md-0 m-0 col-lg-5">
                                <div class="mb-3 p-0 col-12">
                                    <input type="email" name="email" placeholder="Email" class="form-control" value="<?php if (isset($_POST['email'])) {
                                                                                                                            echo $_POST['email'];
                                                                                                                        } ?>">

                                    <?php
                                    $new_account = new Account();
                                    if (isset($_POST['email'])) {
                                        $new_account->email = htmlentities($_POST['email']);
                                    } else {
                                        $new_account->email = '';
                                    }

                                    if (isset($_POST['email']) && strcmp(validate_email($_POST['email']), 'success') != 0) {

                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2"><?= validate_email($_POST['email']) ?></p>
                                    <?php
                                    } else if ($new_account->is_email_exist() && $_POST['email']) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">Email you've entered already exist.</p>
                                    <?php
                                    } else if ((isset($_POST['affiliation']) && $_POST['affiliation'] == 'Student') && !validate_wmsu_email($_POST['email'], $_POST['affiliation'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">Student must use wmsu email.</p>
                                    <?php
                                    } else if ((isset($_POST['affiliation']) && $_POST['affiliation'] == 'Faculty') && !validate_wmsu_email($_POST['email'], $_POST['affiliation'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">Faculty must use wmsu email.</p>
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <input type="password" name="password" placeholder="Password" class="form-control" value="<?php if (isset($_POST['password'])) {
                                                                                                                                    echo $_POST['password'];
                                                                                                                                } ?>">
                                    <?php
                                    if (isset($_POST['password']) && validate_password($_POST['password']) !== "success") {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2"><?= validate_password($_POST['password']) ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control" value="<?php if (isset($_POST['confirm-password'])) {
                                                                                                                                                    echo $_POST['confirm-password'];
                                                                                                                                                } ?>">
                                    <?php
                                    if (isset($_POST['password']) && isset($_POST['confirm-password']) && !validate_cpw($_POST['password'], $_POST['confirm-password'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">Password did not match.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group m-0 mb-3 p-0 row col-12 d-flex justify-content-evenly">
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="affiliation" id="student" onclick="affiliation_effect()" value="Student" <?php if (isset($_POST['affiliation']) && $_POST['affiliation'] == 'Student') {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?>>
                                        <label class="form-check-label" for="student">
                                            Student
                                        </label>
                                    </div>
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="affiliation" id="faculty" onclick="affiliation_effect()" value="Faculty" <?php if (isset($_POST['affiliation']) && $_POST['affiliation'] == 'Faculty') {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?>>
                                        <label class="form-check-label" for="faculty">
                                            Faculty
                                        </label>
                                    </div>
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="affiliation" id="non-student" onclick="affiliation_effect()" value="Non-student" <?php if (isset($_POST['affiliation']) && $_POST['affiliation'] == 'Non-student') {
                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            } ?>>
                                        <label class="form-check-label" for="non-student">
                                            Non-student
                                        </label>
                                    </div>
                                    <?php
                                    if ((!isset($_POST['affiliation']) && isset($_POST['signup'])) || (isset($_POST['affiliation']) && !validate_field($_POST['affiliation']))) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2 col-12">No affiliation selected.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <input type="text" name="first-name" placeholder="First Name" class="form-control" value="<?php if (isset($_POST['first-name'])) {
                                                                                                                                    echo $_POST['first-name'];
                                                                                                                                } ?>">
                                    <?php
                                    if (isset($_POST['first-name']) && !validate_field($_POST['first-name'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">First name is required.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <input type="text" name="middle-name" placeholder="Middle Name (Optional)" class="form-control" value="<?php if (isset($_POST['middle-name'])) {
                                                                                                                                                echo $_POST['middle-name'];
                                                                                                                                            } ?>">
                                    <?php
                                    // if (isset($_POST['middle-name']) && !validate_field($_POST['middle-name'])) {
                                    ?>
                                    <!-- <p class="fs-7 text-primary m-0 ps-2">Middle name you've entered is invalid.</p> -->
                                    <?php
                                    // }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <input type="text" name="last-name" placeholder="Last Name" class="form-control" value="<?php if (isset($_POST['last-name'])) {
                                                                                                                                echo $_POST['last-name'];
                                                                                                                            } ?>">
                                    <?php
                                    if (isset($_POST['last-name']) && !validate_field($_POST['last-name'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">Last name is required.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group m-0 p-0 mb-3 row col-12 d-flex justify-content-evenly">
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Male') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Female') {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                    <div class="m-0 p-0 col-auto">
                                        <input class="form-check-input" type="radio" name="gender" id="other" value="Other" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Other') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                        <label class="form-check-label" for="other">
                                            Other
                                        </label>
                                    </div>
                                    <?php
                                    if ((!isset($_POST['gender']) && isset($_POST['signup'])) || (isset($_POST['gender']) && !validate_field($_POST['gender']))) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2 col-12">No gender selected.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12 d-none" id="college_div">
                                    <select name="college" id="college_id" class="form-select">
                                        <option value="">Select College</option>
                                        <?php
                                        $college = new College();
                                        $collegeArray = $college->show_mod($_SESSION['college_assigned']);
                                        foreach ($collegeArray as $item) { ?>
                                            <option value="<?= $item['college_id'] ?>" <?php if ((isset($_POST['college']) && $_POST['college'] == $item['college_id'])) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $item['college_name'] ?></option>
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
                                    <input type="tel" pattern="09\d{9}" maxlength="11" name="contact" id="contact" placeholder="Contact Number" class="form-control" onfocus="if(this.value==='') this.value='09';" oninput="validateinput(this)" value="<?php if (isset($_POST['contact'])) {
                                                                                                                                                                                                                                                                echo $_POST['contact'];
                                                                                                                                                                                                                                                            } ?>">
                                    <?php
                                    if (isset($_POST['contact']) && !validate_field($_POST['contact'])) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2">Contact number is required.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group m-0 mb-3 p-0 row col-12 d-flex justify-content-evenly">
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
                                    <?php
                                    if ((isset($_POST['user_role']) && !validate_field($_POST['user_role']))) {
                                    ?>
                                        <p class="fs-7 text-primary m-0 ps-2 col-12">No user role selected.</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-3 p-0 col-12">
                                    <input type="submit" class="btn btn-primary w-100 fw-semibold" name="signup" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <!-- modal  -->
    <?php
    if (isset($_POST['signup']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./create.php" class="text-decoration-none text-dark">
                                    <p class="m-0 text-dark">Account is successfully created! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
        var select_college = document.querySelector('#college_id');
        dselect(select_college, {
            search: true,
            maxHeight: '100px',
        });
    </script>
</body>

</html>