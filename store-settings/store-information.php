<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/image.class.php";

$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);


if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Store Information | Crimson Avenue";
$product_page = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.store.php');

    ?>
    <main>
        <div class="container-fluid">
            <div class="row">
                <?php
                require_once('../includes/sidepanel.store.php');
                ?>
            </div>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>