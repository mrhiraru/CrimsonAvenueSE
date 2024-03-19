<?php
session_start();

require_once('../tools/functions.php');
require_once('../classes/college.class.php');
require_once('../classes/account.class.php');
require_once('../classes/store.class.php');

$store = new Store();

$limit = 10;

$page_count = $store->count_stores();
$pages = ceil($page_count[0]['store_id'] / $limit);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($_GET['page']) || $_GET['page'] < 1) {
    header('location: ./stores.php?page=1');
} else if ($_GET['page'] > $pages) {
    header('location: ./stores.php?page=' . $pages);
}


$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$storeArray = $store->show_stores($start < 1 ? 1 : $start, $limit);

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
    <div class="container-fluid col-md-9 my-4 mx-sm-auto min-vh-100 ">
        <main>
            <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                <div class="row m-0 p-0 d-flex align-items-center">
                    <div class="col-6 m-0 p-0">
                        <p class="m-0 p-0 fs-3 fw-bold text-primary lh-1">Stores</p>
                    </div>
                    <?php
                    if (isset($_SESSION['affiliation']) && $_SESSION['affiliation'] != 'Non-student') {
                    ?>
                        <div class="col-6 m-0 p-0 text-end">
                            <a href="./my-stores.php" class="text-primary fw-semibold fs-6">My Stores</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <hr>
                <div class="row m-0 p-0 grid">
                    <?php
                    $counter = 1;
                    foreach ($storeArray as $item) {
                    ?>
                        <div class="col-12 col-lg-6 m-0 p-1 d-flex justify-content-center align-items-center">
                            <a class="card store-card p-3 text-decoration-none overflow-hidden" href="./stores.php">
                                <div class="row m-0 mb-2 p-0 d-flex align-items-center">
                                    <div class="col-auto m-0 mb-1 p-0">
                                        <img src="../images/main/no-profile.jpg" width="60" height="60" alt="" class="border border-secondary border-opacity-25 rounded ">
                                    </div>
                                    <div class="col-6 m-0 p-0 ps-3 flex-fill">
                                        <p class="fs-5 text-nowrap fw-semibold text-dark m-0 p-0 lh-sm  text-truncate"><?= ucwords(strtolower($item['store_name'])) ?></p>
                                        <p class="fs-7 text-nowrap fw-semibold text-primary m-0 mt-1 p-0 lh-sm  text-truncate"><?php if (isset($item['middlename'])) {
                                                                                                                                    echo ucwords(strtolower($item['firstname'] . ' ' . $item['middlename'] . ' ' . $item['lastname']));
                                                                                                                                } else {
                                                                                                                                    echo ucwords(strtolower($item['firstname'] . ' ' . $item['lastname']));
                                                                                                                                } ?></p>
                                    </div>
                                </div>
                                <div class="row m-0 p-0 overflow-hidden">
                                    <p class="fs-6 text-dark lh-sm m-0 p-0 store-bio overflow-hidden"><?= (isset($item['store_bio'])) ? ucfirst(strtolower($item['store_bio'])) : 'No bio' ?></p>
                                </div>
                            </a>
                        </div>
                    <?php
                        $counter++;
                    }
                    ?>
                </div>
                <div class="m-2 p-0 d-flex justify-content-center align-items-center">
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
            </div>
        </main>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
</body>

</html>