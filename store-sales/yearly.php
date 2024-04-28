<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/order.class.php";

$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_GET['store_id']) || !isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Yearly Sales | Crimson Avenue";
$sales_page = "active";
$yearly_page = "active";
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
                <main class="col-md-9 col-lg-10 p-4 row m-0">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row h-auto d-flex justify-content-center m-0 p-0">
                            <div class="search-keyword col-12 col-lg-4 mb-2 ms-auto p-0">
                                <div class="input-group">
                                    <input type="text" name="keyword" id="keyword" placeholder="" class="form-control">
                                    <span class="input-group-text text-white bg-primary border-primary btn-settings-size fw-semibold" id="basic-addon1"><span class="mx-auto">Search</span></span>
                                </div>
                            </div>
                            <table id="mysales" class="table table-lg mt-1">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col"></th>
                                        <th scope="col" class="">Year</th>
                                        <th scope="col" class="">Total Sales</th>
                                        <th scope="col" class="">Revenue</th>
                                        <th scope="col" class="">Commission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    $order = new Order();
                                    $orderArray = $order->store_sales_month($record['store_id']);
                                    foreach ($orderArray as $item) {
                                    ?>
                                        <tr class="align-middle">
                                            <td> <?= $counter ?></td>
                                            <td><?= date('Y', strtotime($item['sales_date'])) ?></td>
                                            <td class=""><?= '₱' . number_format($item['revenue'] + $item['commission'], 2, '.', ',') ?> </td>
                                            <td class=""><?= '₱' . number_format($item['revenue'], 2, '.', ',') ?> </td>
                                            <td class=""><?= '₱' . number_format($item['commission'], 2, '.', ',') ?> </td>
                                        </tr>
                                    <?php
                                        $counter++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
    <script src="../js/order.datatable.js"></script>

</body>

</html>