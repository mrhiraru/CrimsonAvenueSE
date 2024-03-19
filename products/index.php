<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Products  | Crimson Avenue";
$product_page = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center min-vh-100">
            <?php
            require_once("../includes/sidepanel.product.php");
            ?>
            <main class="col-md-9 col-lg-10 p-4 row m-0">
                <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                    <div class="row m-0 p-0 d-flex align-items-center">
                        <div class="col-6 m-0 p-0">
                            <p class="m-0 p-0 fs-3 fw-bold text-primary lh-1">Products</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row m-0 p-0 grid">
                        <!-- product cards here -->
                    </div>
                    <div class="m-2 p-0 d-flex justify-content-center align-items-center">
                        <!-- pagination here // copy from stores/stores.php -->
                    </div>
                </div>
            </main>
        </div>
        <section>
            <!-- Code Here Extra Section -->
        </section>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
</body>

</html>