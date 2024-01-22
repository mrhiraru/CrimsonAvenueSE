<?php 
require_once("./classes/account.class.php");
require_once("./tools/functions.php");

$verification_code = generate_code();

?>


<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Verify | Crimson Avenue";
require_once('../includes/head.php');
?>

<body>
    <main class="row m-0 vh-100 bg-tertiary d-flex align-items-center justify-content-center">
        <div class="col-10 custom-size px-3 py-3 px-md-5 bg-light shadow-lg rounded d-flex flex-column justify-content-center align-items-center">
            <img src="../images/main/ca-icon-noword.png" alt="" class=" img-thumbnail border border-0 bg-light mb-4">
            <form action="" method="post" class="row d-flex">
                <div class="mb-2 p-0 col-12">
                    <label for="code" class="form-label text-center text-dark fs-7">
                        We've sent you 6-digit code to
                        <span class="text-primary fw-semibold ">example@email.com</span>
                        Enter the code below to verify your account.
                    </label>
                    <input type="text" maxlength="6" pattern="\d{6}" name="code" placeholder="Verification Code" class="form-control text-center" oninput="validateinput(this)" value="<?php if (isset($_POST['contact'])) {
                                                                                                                                                                                            echo $_POST['contact'];
                                                                                                                                                                                        } ?>">
                    <?php
                    if (isset($_POST['code']) && !validate_field($_POST['code'])) {
                    ?>
                        <p class="fs-7 text-primary m-0 ps-2">Verification code is required.</p>
                    <?php
                    }
                    ?>
                </div>
                <div class="mb-2 p-0 col-12">
                    <input type="submit" class="btn btn-primary w-100 fw-semibold" name="verify" value="Verify">
                </div>
            </form>
            <p class="fs-7 text-dark m-0">Didn't received verification code? <a href="" class="text-primary text-decoration-none fw-semibold">Resend Code</a>.</p>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>