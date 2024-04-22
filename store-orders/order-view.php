<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/order.class.php";
require_once "../classes/description.class.php";
require_once "../classes/variation.class.php";
require_once "../classes/measurement.class.php";
require_once "../classes/image.class.php";

$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);

$order = new Order();
$ord_record = $order->fetch_order($_GET['order_id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
} else if (!isset($ord_record['order_id']) || $ord_record['is_deleted'] == 1) {
    header('location: ./index.php?store_id=' . $record['store_id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Order View | Crimson Avenue";
$orders_page = "active";
$order_page = "active";
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
                <main class="col-md-9 col-lg-10 p-4 row m-0 h-100">
                    <div class="container-fluid bg-white shadow rounded m-0 mb-4 p-3">
                        <div class="row d-flex justify-content-center m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2 btn-group">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Order Details
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-0">
                            </div>
                            <div class="col-12 col-lg-auto m-0 p-2 d-flex justify-content-start align-items-start flex-fill row">
                                <table class="table-sm m-0">
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Customer Name:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?php if (isset($ord_record['middlename'])) {
                                                echo ucwords(strtolower($ord_record['firstname'] . ' ' . $ord_record['middlename'] . ' ' . $ord_record['lastname']));
                                            } else {
                                                echo ucwords(strtolower($ord_record['firstname'] . ' ' . $ord_record['lastname']));
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Order ID:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $ord_record['order_id'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Payment Method:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $ord_record['payment_method'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Order Fulfillment:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $ord_record['fulfillment_method'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Order Date:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= date('F d Y', strtotime($ord_record['is_created'])) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Order Status:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $ord_record['order_status'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Total Price:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= '₱' . number_format(($ord_record['product_total'] + $ord_record['commission_total'] + $ord_record['delivery_charge']), 2, '.', ',') ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row h-auto d-flex justify-content-center m-0 p-0">
                            <table id="myorders" class="table table-lg mt-1">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col" class="">Product Name</th>
                                        <th scope="col" class="">Variation</th>
                                        <th scope="col" class="">Measurement</th>
                                        <th scope="col" class="text-center">Quantity</th>
                                        <th scope="col" class="">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    $order = new Order();
                                    $orderArray = $order->show_items($ord_record['order_id']);
                                    foreach ($orderArray as $item) {
                                    ?>
                                        <tr class="align-middle">
                                            <td><?= $counter ?></td>
                                            <td> <img src="<?php if (isset($item['image_file'])) {
                                                                echo "../images/data/" . $item['image_file'];
                                                            } else {
                                                                echo "../images/main/no-profile.jpg";
                                                            } ?>" alt="" class="profile-list-size border border-secondary-subtle rounded-1"> </td>
                                            <td class=""><?= $item['product_name'] ?></td>
                                            <td class="r"><?= $item['variation_name'] ?></td>
                                            <td class=""><?= $item['measurement_name'] ?></td>
                                            <td class="text-center"><?= $item['quantity'] . 'x' ?></td>
                                            <td class=""><?= '₱' . number_format($item['oi_selling_price'] + $item['oi_commission'], 2, '.', ',') ?></td>
                                        </tr>
                                    <?php
                                        $counter++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row h-auto d-flex justify-content-center m-0 p-0">
                            <form action="">
                                
                            </form>
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