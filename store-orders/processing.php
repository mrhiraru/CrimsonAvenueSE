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
$title = "Processing Orders | Crimson Avenue";
$orders_page = "active";
$processing_page = "active";
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
                            <table id="myorders" class="table table-lg mt-1">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col"></th>
                                        <th scope="col" class="">Customer Name</th>
                                        <th scope="col" class="">Total Price</th>
                                        <th scope="col" class="text-center">Payment Method</th>
                                        <th scope="col" class="text-center">Order Fulfillment</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col">Date</th>
                                        <th scope="col" class="text-end"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    $order = new Order();
                                    $orderArray = $order->show_order_processing($record['store_id']);
                                    foreach ($orderArray as $item) {
                                    ?>
                                        <tr class="align-middle">
                                            <td><?= $counter ?></td>

                                            <td class=""><?php if (isset($item['middlename'])) {
                                                                echo ucwords(strtolower($item['firstname'] . ' ' . $item['middlename'] . ' ' . $item['lastname']));
                                                            } else {
                                                                echo ucwords(strtolower($item['firstname'] . ' ' . $item['lastname']));
                                                            } ?></td>
                                            <td class=""><?= '₱' . number_format(($item['product_total'] + $item['commission_total'] + $item['delivery_charge']), 2, '.', ',') ?></td>
                                            <td class="text-center"><?= $item['payment_method'] ?></td>
                                            <td class="text-center"><?= $item['fulfillment_method'] ?></td>
                                            <td class="text-center"><?= $item['order_status'] ?></td>
                                            <td><?= date('F d Y', strtotime($item['is_created'])) ?> </td>
                                            <td class="text-end text-nowrap">
                                                <div class="m-0 p-0">
                                                    <a href="./order-view.php?store_id=<?php echo $record['store_id'] . '&order_id=' . $item['order_id'] ?>" type="button" class="btn btn-primary btn-settings-size rounded border-0 fw-semibold text-decoration-none">Details</a>
                                                </div>
                                            </td>
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