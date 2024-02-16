<?php
session_start();

require_once('../tools/functions.php');
require_once('../classes/college.class.php');
require_once('../classes/account.class.php');
require_once('../classes/store.class.php');

$store = new Store();
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$storeArray = $store->show_stores($start, $limit);

$page_count = $store->count_stores();
$pages = ceil($page_count[0]['store_id'] / $limit);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($_GET['page']) || $_GET['page'] < 1) {
    header('location: ./stores.php?page=1');
} else if ($_GET['page'] > $pages) {
    header('location: ./stores.php?page=' . $pages);
}



?>


<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Stores | Crimson Avenue";
$store_page = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto">
        <main>
            <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                <div class="row m-0 p-0 row-cols-1">
                    <?php
                    $counter = 1;
                    foreach ($storeArray as $item) {
                    ?>
                        <div class="col-auto p-1 w-100">
                            <a class="card row col-12 m-0 p-3 store-card bg-white rounded text-decoration-none overflow-hidden" href="./stores.php">
                                <div class="col-12 col-md-auto m-0 p-0 store-img-cont d-flex justify-content-center align-items-center justify-content-lg-start">
                                    <img src="../images/main/no-profile.jpg" alt="" class="border border-black border-opacity-10 rounded store-img">
                                </div>
                                <div class="col-12 col-md-6 m-0 p-0 ps-3">
                                    <div class="col-12 p-0">
                                        <p class="fs-4 text-nowrap fw-bold text-primary m-0 mb-2 text-truncate"><?= ucwords(strtolower($item['store_name'])) ?></p>
                                    </div>
                                    <div class="col-12 p-0 overflow-hidden ">
                                        <p class="fs-6 text-dark lh-sm m-0 store-bio overflow-hidden "><?= ucfirst(strtolower($item['store_bio'])) ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                        $counter++;
                    }
                    ?>
                </div>
                <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= (isset($_GET['page']) && $_GET['page'] <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $_GET['page'] - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    for ($i = 1; $i <= $pages; $i++) {
                    ?>
                        <li class="page-item <?= (isset($_GET['page']) && $_GET['page'] == $i) ? 'active' : ''  ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item <?= (isset($_GET['page']) && $_GET['page'] >= $pages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $_GET['page'] + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            </div>
        </main>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>