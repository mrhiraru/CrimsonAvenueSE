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
                        <div class="col-6 m-0 p-0 text-end">
                            <button class="navbar-toggler d-md-none p-0 fs-6 fw-semibold text-primary border-0 lh-sm" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                                Filters
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row m-0 p-0 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5">
                        <?php
                        for ($i = 0; $i < 10; $i++) {
                        ?>
                            <div class="col m-0 p-1 d-flex justify-content-center align-items-center">
                                <a class="card product-card p-3 text-decoration-none overflow-hidden" href="./stores.php">
                                    <div class="row m-0 mb-2 p-0 d-flex align-items-center">
                                        <div class="col-auto m-0 mb-1 p-0 custom-product-img">
                                            <img src="../images/main/no-profile.jpg" alt="" class="border border-secondary border-opacity-25 rounded img-fluid">
                                        </div>
                                        <div class="col-6 m-0 p-0 flex-fill">
                                            <p class="fs-6 text-nowrap fw-semibold text-dark m-0 p-0 lh-sm  text-truncate"> Product Name </p>
                                            <p class="fs-7 text-nowrap fw-semibold text-secondary m-0 mt-1 p-0 lh-sm  text-truncate"> By Seller Name </p>
                                            <p class="fs-5 text-nowrap fw-bold text-primary m-0 mt-1 p-1 lh-1  text-truncate w-fit border border-1 border-primary "> P 300 </p>
                                            <p class="fs-7 text-nowrap fw-semibold text-dark m-0 mt-1 p-0 lh-sm  text-truncate"> For All User </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
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