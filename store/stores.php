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
    header('location: ./stores.php?page='.$pages);
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
                <div class="row m-0 p-0 row-cols-1 row-cols-md-2 row-cols-lg-3">
                    <div class="col-auto p-1 border border-1 border-black ">
                        qweqwe
                    </div>
                    <div class="col-auto p-1 border border-1 border-black ">
                        qweqwe
                    </div>
                    <div class="col-auto p-1 border border-1 border-black ">
                        qweqwe
                    </div>
                </div>
            </div>
        </main>
        <section>
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
                        <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
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
        </section>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>