<?php
session_start();

require_once("./classes/account.class.php");
require_once("./tools/functions.php");

if (isset($_POST['login'])) {
    $account = new Account();

    $account->email = htmlentities($_POST['email']);
    $account->password = htmlentities($_POST['password']);
    if ($account->sign_in_account()) {
        $_SESSION['user_role'] = $account->user_role;
        $_SESSION['account_id'] = $account->account_id;
        $_SESSION['name'] = ucwords($account->firstname . ' ' . $account->middlename[0] . ' ' . $account->lastname);
        if ($_SESSION['user_role'] == 2) {
            header('location: ../index.php');
        } else if ($_SESSION['user_role'] == 1) {
            // header to moderator index
        } else if ($_SESSIOn['user_role'] == 0) {
            // header to admin index
        }
    }else{
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
?>

<body>
    <main class="row m-0 vh-100 bg-tertiary d-flex align-items-center justify-content-center">
        <div class="col-10 custom-size px-3 py-3 px-md-5 bg-light shadow-lg rounded d-flex flex-column justify-content-center align-items-center">
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
                <div class="mb-2 col-12 text-end">
                    <a href="" class="text-primary fs-7 text-decoration-none fw-semibold">Forgot Password?</a>
                </div>
                <div class="mb-2 col-12">
                    <input type="submit" class="btn btn-primary w-100 fw-semibold"  name="login" value="Login">
                </div>
                <?php
                if (isset($_POST['login']) && isset($error)) {
                ?>
                    <p class="fs-7 text-primary m-0 ps-2"><?= $error ?></p>
                <?php
                }
                ?>
            </form>
            <p class="fs-7 text-dark m-0">Don't have an account? <a href="./signup.php" class="text-primary text-decoration-none fw-semibold">Sign up Here</a>.</p>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>