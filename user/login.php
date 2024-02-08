<?php
session_start();

if (isset($_SESSION['user_role'])) {
    header('location: ../index.php');
}

require_once("../classes/account.class.php");
require_once("../tools/functions.php");

if (isset($_POST['login'])) {
    $account = new Account();

    $account->email = htmlentities($_POST['email']);
    $account->password = htmlentities($_POST['password']);
    if ($account->sign_in_account()) {
        $_SESSION['user_role'] = $account->user_role;
        $_SESSION['account_id'] = $account->account_id;
        $_SESSION['verification_status'] = $account->verification_status;
        $_SESSION['email'] = $account->email;
        $_SESSION['name'] = ucwords(strtolower($account->firstname . ' ' . $account->lastname));
        if ($_SESSION['user_role'] == 2) {
            header('location: ../index.php');
        } else if ($_SESSION['user_role'] == 1) {
            header('location: ../index.php');
        } else if ($_SESSION['user_role'] == 0) {
            header('location: ../index.php');
        }
    } else {
        $error = 'Login failed: Invalid email or password.';
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Login | Crimson Avenue";
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
        <div class="col-10 custom-size my-5 px-3 py-3 px-md-5 bg-light shadow-lg rounded d-flex flex-column justify-content-center align-items-center">
            <img src="../images/main/ca-icon-noword.png" alt="" class=" img-thumbnail border border-0 bg-light mb-4">
            <form action="" method="post" class="row d-flex">
                <div class="mb-2 col-12">
                    <input type="text" name="email" placeholder="Email" class="form-control" value="<?php if (isset($_POST['email'])) {
                                                                                                        echo $_POST['email'];
                                                                                                    } ?>">
                </div>
                <div class="mb-2 col-12">
                    <input type="password" name="password" placeholder="Password" class="form-control" value="<?php if (isset($_POST['password'])) {
                                                                                                                    echo $_POST['password'];
                                                                                                                } ?>">
                </div>

                <?php
                if (isset($_POST['login']) && isset($error)) {
                ?>
                    <div class="mb-2 col-12">
                        <p class="fs-7 text-primary m-0 ps-2 text-start">
                            <?= $error ?>
                        </p>
                    </div>
                <?php
                }
                ?>
                <div class="mb-2 col-12 text-end ">
                    <a href="" class="text-primary fs-7 pe-2 text-decoration-none fw-semibold">Forgot Password?</a>
                </div>
                <div class="mb-2 col-12">
                    <input type="submit" class="btn btn-primary w-100 fw-semibold" name="login" value="Login">
                </div>
            </form>
            <p class="fs-7 text-dark m-0">Don't have an account? <a href="./signup.php" class="text-primary text-decoration-none fw-semibold">Sign up Here</a>.</p>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>