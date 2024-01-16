<?php 
    require_once("./classes/account.class.php");

    if(isset($_POST['next'])) {
        $account = new Account();

        $account->email = htmlentities($_POST['email']);
        $account->password = htmlentities($_POST['password']);
        $account->affiliation = htmlentities($_POST['affiliation']);

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
    <main class="row m-0 vh-100 bg-tertiary d-flex align-items-center justify-content-center">
        <div class="col-10 custom-size px-3 py-3 px-md-5 bg-light shadow-lg rounded d-flex flex-column justify-content-center align-items-center">
            <img src="../images/main/ca-icon-noword.png" alt="" class=" img-thumbnail border border-0 bg-light mb-4">
            <form action="" method="post" class="row d-flex p-2 p-md-0">
                <?php
                if (!isset($_POST['next']) && !isset($_POST['nextnext'])) {
                ?>
                    <div class="mb-2 p-0 col-12">
                        <input type="email" name="email" placeholder="Email" class="form-control">
                        <p class="fs-7 text-primary m-0 ps-2">Email you've entered is invalid.</p>
                    </div>
                    <div class="mb-2 p-0 col-12">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                        <p class="fs-7 text-primary m-0 ps-2">Password you've entered is invalid.</p>
                    </div>
                    <div class="mb-2 p-0 col-12">
                        <input type="confirm-password" name="confirm-password" placeholder="Confirm password" class="form-control">
                        <p class="fs-7 text-primary m-0 ps-2">Password you've entered is invalid.</p>
                    </div>
                    <div class="form-group m-0 mb-2 p-0 row col-12 d-flex justify-content-evenly">
                        <div class="m-0 p-0 col-auto">
                            <input class="form-check-input" type="radio" name="affiliation" id="student" value="Student">
                            <label class="form-check-label" for="student">
                                Student
                            </label>
                        </div>
                        <div class="m-0 p-0 col-auto">
                            <input class="form-check-input" type="radio" name="affiliation" id="faculty" value="Faculty">
                            <label class="form-check-label" for="faculty">
                                Faculty
                            </label>
                        </div>
                        <div class="m-0 p-0 col-auto">
                            <input class="form-check-input" type="radio" name="affiliation" id="non-student" value="Non-student">
                            <label class="form-check-label" for="non-student">
                                Non-student
                            </label>
                        </div>
                        <p class="fs-7 text-primary m-0 ps-2 col-12">No affiliation selected.</p>
                    </div>
                    <div class="mb-2 p-0 col-12">
                        <input type="submit" class="btn btn-primary w-100 fw-semibold" name="next" value="Next">
                    </div>
                <?php
                } else if (isset($_POST['next'])) {
                ?>
                    <div class="mb-2 p-0 col-12">
                        <input type="text" name="first-name" placeholder="First Name" class="form-control">
                        <p class="fs-7 text-primary m-0 ps-2">First name you've entered is invalid.</p>
                    </div>
                    <div class="mb-2 p-0 col-12">
                        <input type="text" name="middle-name" placeholder="Middle Name(Optional)" class="form-control">
                        <p class="fs-7 text-primary m-0 ps-2">Middle name you've entered is invalid.</p>
                    </div>
                    <div class="mb-2 p-0 col-12">
                        <input type="text" name="last-name" placeholder="Last Name" class="form-control">
                        <p class="fs-7 text-primary m-0 ps-2">Last name you've entered is invalid.</p>
                    </div>
                    <div class="form-group m-0 p-0 mb-2 row col-12 d-flex justify-content-evenly">
                        <div class="m-0 p-0 col-auto">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="m-0 p-0 col-auto">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                        <div class="m-0 p-0 col-auto">
                            <input class="form-check-input" type="radio" name="gender" id="other" value="Other">
                            <label class="form-check-label" for="other">
                                Other
                            </label>
                        </div>
                        <p class="fs-7 text-primary m-0 ps-2 col-12">No gender selected.</p>
                    </div>
                    <div class="mb-2 p-0 col-12">
                        <input type="submit" class="btn btn-primary w-100 fw-semibold" name="nextnext" value="Next">
                    </div>
                <?php
                } else if (isset($_POST['nextnext'])) {
                ?>
                    <div class="mb-2 p-0 col-12">
                        <select name="college" id="college" class="form-select">
                            <option value="">Select College</option>
                        </select>
                        <p class="fs-7 text-primary m-0 ps-2">No college selected.</p>
                    </div>
                    <div class="mb-2 p-0 col-12">
                        <select name="department" id="department" class="form-select">
                            <option value="">Select Department</option>
                        </select>
                        <p class="fs-7 text-primary m-0 ps-2">No department selected.</p>
                    </div>
                    <div class="mb-2 p-0 col-12">
                        <input type="tel" pattern="09\d{9}" maxlength="11" name="contact" id="contact" placeholder="Contact Number" class="form-control" onfocus="if(this.value==='') this.value='09';" oninput="validateinput(this)">
                        <p class="fs-7 text-primary m-0 ps-2">Contact number you've entered is invalid.</p>
                    </div>
                    <div class="mb-2 p-0 col-12 form-check">
                        <p class="fs-7 text-dark m-0 d-flex justify-content-center">
                            <input class="form-check-input me-2" type="checkbox" value="Agreed" id="terms">
                            <label class="form-check-label" for="terms">
                                I agree with the
                                <a href="" class="text-primary text-decoration-none fw-semibold">Terms and Conditions</a>.
                            </label>
                        </p>
                    </div>
                    <div class="mb-2 p-0 col-12">
                        <input type="submit" class="btn btn-primary w-100 fw-semibold" name="signup" value="Sign up">
                    </div>
                <?php
                }
                ?>
            </form>
            <p class="fs-7 text-dark m-0">Already have an account? <a href="./login.php" class="text-primary text-decoration-none fw-semibold">Login Here</a>.</p>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>