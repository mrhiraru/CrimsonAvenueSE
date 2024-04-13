<?php
session_start();

require_once("../classes/account.class.php");
require_once("../tools/functions.php");

$account = new Account();

if (isset($_SESSION['user_role']) || $account->check_for_admin(0)) {
    header('location: ../index.php');
}

if (isset($_POST['signup'])) {


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

    $account->contact = htmlentities($_POST['contact']);
    $account->user_role = 0; // user_role (0 = admin, 1 = mod, 2 = user)

    if (
        validate_field($account->email) &&
        validate_field($account->password) &&
        validate_field($account->affiliation) &&
        validate_field($account->firstname) &&
        // validate_field($account->middlename) &&
        validate_field($account->lastname) &&
        validate_field($account->gender) &&
        validate_field($account->contact) &&
        validate_password($account->password) &&
        validate_cpw($account->password, $_POST['confirm-password']) &&
        validate_email($account->email) == 'success' && !$account->is_email_exist() &&
        validate_wmsu_email($account->email, $account->affiliation) &&
        isset($_POST['terms'])
    ) {
        if ($account->add_admin()) {
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
$title = "Admin Signup | Crimson Avenue";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body class="bg-tertiary">
    <main class="row m-0 min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row position-absolute start-0 top-0 w-100 m-0 p-2">
            <div class="col-8 p-0">
                <a class="navbar-brand h-1 fs-3 fw-bolder me-auto d-flex align-items-center text-white" href="../index.php">
                    <img src="../images/main/ca-nospace.png" alt="" width="40" height="40" class="d-inline-block me-2">
                    <span class="d-lg-inline d-md-inline d-none">Crimson Avenue </span>
                </a>
            </div>
        </div>
        <div class="col-12 m-0 mb-5"></div>
        <div class="col-10 custom-size my-5 px-3 py-3 px-md-5 bg-light shadow-lg rounded d-flex flex-column justify-content-center align-items-center">
            <img src="../images/main/ca-icon-noword.png" alt="" class=" img-thumbnail border border-0 bg-light mb-4">
            <?php
            if (isset($_POST['signup']) && $success == 'success') {
            ?>
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row d-flex">
                                    <div class="col-12 text-center">
                                        <a href="../user/login.php" class="text-decoration-none text-dark">
                                            <p class="m-0">Account is successfully created!</br><span class="text-primary fw-bold">Login to verify your account</span>.</p>
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
            <form action="" method="post" class="row d-flex p-2 p-md-0">

                <div class="mb-2 p-0 col-12">
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
                <div class="mb-2 p-0 col-12">
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
                <div class="mb-2 p-0 col-12">
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
                <div class="form-group m-0 mb-2 p-0 row col-12 d-flex justify-content-evenly">
                    <div class="m-0 p-0 col-auto">
                        <input class="form-check-input" type="radio" name="affiliation" id="student" value="Student" <?php if (isset($_POST['affiliation']) && $_POST['affiliation'] == 'Student') {
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
                    <?php
                    if ((!isset($_POST['affiliation']) && isset($_POST['signup'])) || (isset($_POST['affiliation']) && !validate_field($_POST['affiliation']))) {
                    ?>
                        <p class="fs-7 text-primary m-0 ps-2 col-12">No affiliation selected.</p>
                    <?php
                    }
                    ?>
                </div>
                <div class="mb-2 p-0 col-12">
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
                <div class="mb-2 p-0 col-12">
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
                <div class="mb-2 p-0 col-12">
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
                <div class="form-group m-0 p-0 mb-2 row col-12 d-flex justify-content-evenly">
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
                <div class="mb-2 p-0 col-12">
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
                <div class="mb-2 p-0 col-12 form-check">
                    <p class="fs-7 text-dark m-0 d-flex justify-content-center">
                        <input class="form-check-input me-2 <?php if (!isset($_POST['terms']) && isset($_POST['signup'])) {
                                                                echo "border-danger outline-danger";
                                                            } ?>" type="checkbox" value="Agreed" id="terms" name="terms" <?php if (isset($_POST['terms']) && $_POST['terms'] == 'Agreed') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                        <label class="form-check-label" for="terms">
                            I agree with the
                            <a href="" class="text-primary text-decoration-none fw-semibold">Terms and Conditions</a>.
                        </label>
                    </p>
                </div>
                <div class="mb-2 p-0 col-12">
                    <input type="submit" class="btn btn-primary w-100 fw-semibold" name="signup" value="Sign up">
                </div>
            </form>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>