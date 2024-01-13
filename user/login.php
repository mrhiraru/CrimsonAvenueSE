<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Login | Crimson Avenue";
require_once('../includes/head.php');
?>

<body>
    <main class="row m-0 vh-100 bg-tertiary d-flex align-items-center justify-content-center">
        <div class="col-10 custom-size px-3 py-5 p-md-5 bg-light shadow-lg rounded d-flex flex-column justify-content-center align-items-center">
            <img src="../images/main/ca-icon-noword.png" alt="" class=" img-thumbnail border border-0 bg-light mb-4">
            <form action="" method="post" class="row d-flex">
                <div class="mb-2 col-12">
                    <input type="text" name="email" placeholder="Email" class="form-control">
                </div>
                <div class="mb-2 col-12">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                </div>
                <div class="mb-2 col-12 text-end">
                    <a href="" class="text-primary fs-7 text-decoration-none fw-semibold">Forgot Password?</a>
                </div>
                <div class="mb-2 col-12">
                    <input type="submit" class="btn btn-primary w-100 fw-semibold " value="Login">
                </div>
            </form>
            <p class="fs-7 text-dark">Don't have an account? <a href="" class="text-primary text-decoration-none fw-semibold">Sign up Here</a></p>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>