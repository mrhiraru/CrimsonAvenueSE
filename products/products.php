<?php
session_start();

require_once('../tools/functions.php');
require_once('../classes/product.class.php');
require_once('../classes/category.class.php');

$product = new Product();

$extension = (isset($_GET['search']) ? '&search=' . $_GET['search'] : "") . (isset($_GET['category']) ? '&category=' . $_GET['category'] : "")  . (isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : "")  . (isset($_GET['exclusivity']) ? '&exclusivity=' . $_GET['exclusivity'] : "");
$limit = 25;

$page_count = $product->count_products_filter(isset($_GET['search']) ? $_GET['search'] : "", isset($_GET['category']) ? $_GET['category'] : "All", isset($_GET['sort']) ? $_GET['sort'] : "", isset($_GET['exclusivity']) ? $_GET['exclusivity'] : "All");
$pages = ceil($page_count[0]['selected_count'] / $limit);

if (isset($_GET['page']) && !is_numeric($_GET['page'])) {
    header('location: ./products.php?page=1');
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($_GET['page']) || $_GET['page'] < 0) {
    header('location: ./products.php?page=1' . $extension);
} else if ($_GET['page'] > $pages) {
    header('location: ./products.php?page=' . $pages . $extension);
}

$productArray = $product->show_products_filter($start < 1 ? 0 : $start, $limit, isset($_GET['search']) ? $_GET['search'] : "", isset($_GET['category']) ? $_GET['category'] : "All", isset($_GET['sort']) ? $_GET['sort'] : "", isset($_GET['exclusivity']) ? $_GET['exclusivity'] : "All");

?>

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
    <div class="container-fluid m-0 p-0  min-vh-100">
        <div class="row m-0 p-0 d-flex flex-row justify-content-center">
            <?php
            require_once("../includes/sidepanel.product.php");
            ?>
            <main class="col-md-9 col-lg-10 p-4 pb-0 row m-0">
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
                    <?php
                    $counter = 1;
                    if (empty($productArray)) {
                    ?>
                        <div class="row m-0 p-0 d-flex align-items-center">
                            <p class="text-center fw-semibold text-secondary"> No Product Found </p>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="row m-0 p-0 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5">
                            <?php
                            foreach ($productArray as $item) {
                            ?>
                                <div class="col m-0 p-1 d-flex justify-content-center align-items-center">
                                    <a class="card row product-card p-3 text-decoration-none overflow-hidden d-flex flex-row align-items-end" href="./product-view.php?product_id=<?= $item['product_id'] ?>">
                                        <div class="col-12 m-0 p-0">
                                            <img src="<?php if (isset($item['image_file'])) {
                                                            echo "../images/data/" . $item['image_file'];
                                                        } else {
                                                            echo "../images/main/no-profile.jpg";
                                                        } ?>" alt="" class="border border-secondary border-opacity-25 rounded img-fluid">
                                        </div>
                                        <div class="col-12 m-0 mt-1 p-0 d-flex flex-column">
                                            <p class="fs-6 text-nowrap fw-semibold text-dark m-0 p-0 lh-sm text-truncate"> <?= ucwords(strtolower($item['product_name'])) ?> </p>
                                            <p class="fs-7 text-nowrap fw-semibold text-secondary m-0 mt-1 p-0 lh-sm  text-truncate"> By <span class="text-primary"><?= $item['store_name'] ?></span> </p>
                                            <?php
                                            if (isset($item['discount_amount']) && isset($item['discount_type'])) {
                                                if ($item['discount_type'] == "Percentage") {
                                                    $original_price = ($item['selling_price'] + $item['commission']);
                                                    $discounted_price = $original_price - ($original_price * ($item['discount_amount'] / 100));
                                            ?>
                                                    <p class="fs-5 text-nowrap fw-bold text-white m-0 mt-1 lh-1  text-truncate bg-primary p-1 rounded-1 "><?= '₱' . number_format($discounted_price, 2, '.', ',') ?><span class="fs-7"><?= ' ' . $item['discount_amount'] . '% Discount' ?></span></p>
                                                <?php
                                                } else if ($item['discount_type'] == "Fixed") {
                                                    $original_price = ($item['selling_price'] + $item['commission']);
                                                    $discounted_price = $original_price - $item['discount_amount'];
                                                ?>
                                                    <p class="fs-5 text-nowrap fw-bold text-white m-0 mt-1 lh-1  text-truncate bg-primary p-1 rounded-1 "><?= '₱' . number_format($discounted_price, 2, '.', ',') ?><span class="fs-7"><?= ' ₱' . $item['discount_amount'] . ' Discount' ?></span></p>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <p class="fs-5 text-nowrap fw-bold text-primary m-0 mt-1 lh-1  text-truncate"><?= '₱' . number_format($item['selling_price'] + $item['commission'], 2, '.', ',') ?></p>
                                            <?php
                                            }
                                            ?>
                                            <p class="fs-7 text-nowrap fw-semibold text-secondary m-0 mt-1 p-0 lh-sm  text-truncate"> For <span class="text-primary"><?= $item['exclusivity'] ?></span> </p>
                                        </div>
                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="m-2 p-0 d-flex justify-content-center align-items-center">
                            <nav class="">
                                <ul class="pagination m-0 mt-2 ">
                                    <li class="page-item <?= (isset($_GET['page']) && $_GET['page'] <= 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $_GET['page'] - 1 . $extension ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php
                                    for ($i = 1; $i <= $pages; $i++) {
                                    ?>
                                        <li class="page-item <?= (isset($_GET['page']) && $_GET['page'] == $i) ? 'active' : ''  ?>"><a class="page-link" href="?page=<?= $i . $extension  ?>"><?= $i ?></a></li>
                                    <?php
                                    }
                                    ?>
                                    <li class="page-item <?= (isset($_GET['page']) && $_GET['page'] >= $pages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $_GET['page'] + 1 . $extension ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php
                    }
                    ?>
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
    require_once('../includes/sidepanel.product-js.php');
    ?>
</body>

</html>