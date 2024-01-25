<?php
session_start();

require_once("./classes/account.class.php");
require_once("./tools/functions.php");

if (isset($_POST['signup'])) {
    $account = new Account();

    $account->email = htmlentities($_POST['email']);
    $account->password = htmlentities($_POST['password']);
    if (isset($_POST['affiliation'])) {
        $account->affiliation = htmlentities($_POST['affiliation']);
    } else {
        $account->affiliation = '';
    }
    $account->firstname = htmlentities($_POST['first-name']);
    if (isset($_POST['middle-name'])) {
        $account->middlename = htmlentities($_POST['middle-name']);
    } else {
        $account->middlename = '';
    }
    $account->lastname = htmlentities($_POST['last-name']);
    if (isset($_POST['gender'])) {
        $account->gender = htmlentities($_POST['gender']);
    } else {
        $account->gender = '';
    }
    if ($account->affiliation == 'Non-student') {
        $account->college = 'No College';
        $account->department = 'No Department';
    } else {
        $account->college = htmlentities($_POST['college']);
        $account->department = htmlentities($_POST['department']);
    }
    $account->contact = htmlentities($_POST['contact']);
    $account->user_role = 2; // user_role (0 = admin, 1 = mod, 2 = user)

    if (
        validate_field($account->email) &&
        validate_field($account->password) &&
        validate_field($account->affiliation) &&
        validate_field($account->firstname) &&
        // validate_field($account->middlename) &&
        validate_field($account->lastname) &&
        validate_field($account->gender) &&
        validate_field($account->college) &&
        validate_field($account->department) &&
        validate_field($account->contact) &&
        validate_password($account->password) &&
        validate_cpw($account->password, $_POST['confirm-password']) &&
        validate_email($account->email) == 'success' && !$account->is_email_exist() &&
        validate_field($_POST['terms'])
    ) {
        if ($account->add()) {
            // $_SESSION['email'] = $account->email;
            // $_SESSION['name'] = $account->firstname;
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Signup | Crimson Avenue";
require_once('../includes/head.php');
?>

<body>
    <main class="row m-0 h-100 bg-tertiary d-flex align-items-center justify-content-center">
        <div class="col-10 custom-size my-5 px-3 py-3 px-md-5 bg-light shadow-lg rounded d-flex flex-column justify-content-center align-items-center">
            <img src="../images/main/ca-icon-noword.png" alt="" class=" img-thumbnail border border-0 bg-light mb-4">
            <?php
            if (isset($_POST['signup']) && isset($success)) {
            ?>
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row d-flex">
                                    <div class="col-12 text-center">
                                        <a href="./login.php" class="text-decoration-none text-dark"><p class="m-0">Account is successfully created! </br><span class="text-primary fw-bold">Click to Login</span></p></a>
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
                    } else if ((isset($_POST['affiliation']) && $_POST['affiliation'] == 'Student') && !validate_wmsu_email($_POST['email'])) {
                    ?>
                        <p class="fs-7 text-primary m-0 ps-2">Student must use wmsu email.</p>
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
                        <input class="form-check-input" type="radio" name="affiliation" id="student" value="Student" onclick="showFields(1)" <?php if (isset($_POST['affiliation']) && $_POST['affiliation'] == 'Student') {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>>
                        <label class="form-check-label" for="student">
                            Student
                        </label>
                    </div>
                    <div class="m-0 p-0 col-auto">
                        <input class="form-check-input" type="radio" name="affiliation" id="faculty" value="Faculty" onclick="showFields(1)" <?php if (isset($_POST['affiliation']) && $_POST['affiliation'] == 'Faculty') {
                                                                                                                                                    echo 'checked';
                                                                                                                                                } ?>>
                        <label class="form-check-label" for="faculty">
                            Faculty
                        </label>
                    </div>
                    <div class="m-0 p-0 col-auto">
                        <input class="form-check-input" type="radio" name="affiliation" id="non-student" value="Non-student" onclick="showFields(2)" <?php if (isset($_POST['affiliation']) && $_POST['affiliation'] == 'Non-student') {
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
                <div class="mb-2 p-0 col-12 d-none transition-showhide" id="college_div">
                    <select name="college" id="college" class="form-select">
                        <option value="">Select College</option>
                        <option value="Computing Studies" <?php if (isset($_POST['college']) && $_POST['college'] == 'Computing Studies') {
                                                                echo 'selected';
                                                            } ?>>Computing Studies</option>
                    </select>
                    <?php
                    if (isset($_POST['college']) && !validate_field($_POST['college'])) {
                    ?>
                        <p class="fs-7 text-primary m-0 ps-2">No college selected.</p>
                    <?php
                    }
                    ?>
                </div>
                <div class="mb-2 p-0 col-12 d-none transition-showhide" id="department_div">
                    <select name="department" id="department" class="form-select">
                        <option value="">Select Department</option>
                        <option value="Computer Science" <?php if (isset($_POST['department']) && $_POST['department'] == 'Computer Science') {
                                                                echo 'selected';
                                                            } ?>>Computer Science</option>
                        <option value="Information Technology" <?php if (isset($_POST['department']) && $_POST['department'] == 'Information Technology') {
                                                                    echo 'selected';
                                                                } ?>>Information Technology</option>
                    </select>
                    <?php
                    if (isset($_POST['department']) && !validate_field($_POST['department'])) {
                    ?>
                        <p class="fs-7 text-primary m-0 ps-2">No department selected.</p>
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
                        <p class="fs-7 text-primary m-0 ps-2">Contact number is invalid.</p>
                    <?php
                    }
                    ?>
                </div>
                <div class="mb-2 p-0 col-12 form-check">
                    <p class="fs-7 text-dark m-0 d-flex justify-content-center">
                        <input class="form-check-input me-2 <?php if (!isset($_POST['terms']) && isset($_POST['signup'])) {
                                                                echo "border-danger outline-danger";
                                                            } ?>" type="checkbox" value="Agreed" id="terms" name="terms" required <?php if (isset($_POST['terms']) && $_POST['terms'] == 'Agreed') {
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
            <p class="fs-7 text-dark m-0">Already have an account? <a href="./login.php" class="text-primary text-decoration-none fw-semibold">Login Here</a>.</p>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
        myModal.show()
    </script>

</body>

</html>