<?php
session_start();

if (isset($_SESSION['user_role']) && $_SESSION['verification_status'] == "Verified") {
    header('location: ../index.php');
} else if (!isset($_SESSION['user_role'])) {
    header('location: ./login.php');
}

require_once("./classes/account.class.php");
require_once("../tools/functions.php");
require_once("../tools/mailer.php");

// Generate 6 digit code
$verification_code = generate_code();

if (!isset($_SESSION['code'])) {
    $_SESSION['code'] = $verification_code;
    send_code($_SESSION['email'], $_SESSION['name'], $_SESSION['code']);
} else if (isset($_POST['resend'])) {
    $_SESSION['code'] = $verification_code;
    send_code($_SESSION['email'], $_SESSION['name'], $_SESSION['code']);
} else if (isset($_POST['verify'])) {
    $account = new Account();

    $account->verification_status = 'Verified';
    $account->account_id = $_SESSION['account_id'];
    $code = htmlentities($_POST['code']);

    if ($code == $_SESSION['code'] && validate_field($code)) {
        if ($account->verify()) {
            $_SESSION['verification_status'] = 'Verified';
            $success = 'success';
        } else {
            echo 'An error occured while updating in the database.';
        }
    } else {
        $error = 'Invalid verification code.';
        $success = 'failed';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Verify | Crimson Avenue";
require_once('../includes/head.php');
?>

<body class="bg-tertiary">
    <div class="row position-absolute start-0 top-0 w-100 m-0 p-2">
        <div class="col-8 p-0">
            <a class="navbar-brand h-1 fs-3 fw-bolder me-auto d-flex align-items-center text-white" href="../index.php">
                <img src="../images/main/ca-nospace.png" alt="" width="40" height="40" class="d-inline-block me-2">
                <span class="d-lg-inline d-md-inline d-none">Crimson Avenue </span>
            </a>
        </div>
        <div class="col-4 p-0 text-end d-flex align-items-center justify-content-end ">
            <a href="../logout.php" class="text-decoration-none text-white fs-6 fw-bold me-2">Log Out</a>
        </div>
    </div>
    <?php
    if (isset($_POST['verify']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="../index.php" class="text-decoration-none text-dark">
                                    <p class="m-0">Account is successfully verified!</br><span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['resend'])) {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center p-0">
                                <button type="button" class="btn text-decoration-none text-dark border-0 bg-white w-100 h-100 p-0" data-bs-dismiss="modal">
                                    <p class="m-0">Code has been sent!</br><span class="text-primary fw-bold p-0">Click to Continue</span>.</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <main class="row m-0 min-vh-100 d-flex align-items-center justify-content-center">
        <div class="col-10 custom-size my-5 px-3 py-3 px-md-5 bg-white shadow-lg rounded d-flex flex-column justify-content-center align-items-center">
            <img src="../images/main/ca-icon-noword.png" alt="" class=" img-thumbnail border border-0 bg-white mb-4">
            <form action="" method="post" class="row d-flex p-2 p-md-0">
                <div class="mb-2 p-0 col-12">
                    <label for="code" class="form-label text-center text-dark fs-7">
                        We've sent you 6-digit code to
                        <span class="text-primary fw-semibold "><?= $_SESSION['email'] ?></span>,
                        Enter the code below to verify your account.
                    </label>
                    <input type="text" maxlength="6" pattern="\d{6}" name="code" placeholder="Verification Code" class="form-control text-center" oninput="validateinput(this)" value="<?php if (isset($_POST['contact'])) {
                                                                                                                                                                                            echo $_POST['contact'];
                                                                                                                                                                                        } ?>">
                    <?php
                    if (isset($_POST['code']) && !validate_field($_POST['code']) && isset($_POST['verify'])) {
                    ?>
                        <p class="fs-7 text-primary m-0 ps-2">Verification code is required.</p>
                    <?php
                    } else if (isset($_POST['code']) && ($_POST['code'] != $_SESSION['code']) && isset($error)) {
                    ?>
                        <p class="fs-7 text-primary m-0 ps-2"><?= $error ?></p>
                    <?php
                    }
                    ?>
                </div>
                <div class="mb-2 p-0 col-12">
                    <input type="submit" class="btn btn-primary w-100 fw-semibold" name="verify" value="Verify">
                </div>
                <div class="p-0 col-12 text-center">
                    <?php // add 15 sec timer if resend is clicked 
                    ?>
                    <p class="fs-7 text-dark m-0">
                        Didn't received verification code?
                        <input type="submit" class="text-primary text-decoration-none fw-semibold border-0 bg-white" id="input_resend" onclick="var rb = document.getElementById('input_resend');rb.setAttribute('hidden', 'true');var ss = document.getElementById('input_sending');ss.style.cursor = 'default';ss.removeAttribute('hidden');" name="resend" value="Resend Code">
                        <span id="input_sending" class="text-primary fw-semibold" hidden>Sending!</span>
                    </p>
                </div>
            </form>
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