<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/order.class.php";
require_once "../classes/description.class.php";
require_once "../classes/variation.class.php";
require_once "../classes/measurement.class.php";
require_once "../classes/image.class.php";
require_once "../classes/notification.class.php";
require_once "../classes/product.class.php";


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

if (isset($_POST['order_status'])) {

    $order->order_status = htmlentities($_POST['order_status']);
    $order->order_id = $ord_record['order_id'];

    if (validate_field($order->order_status)) {
        if ($order->update_status()) {

            // notification start
            if ($order->order_status == "Completed") {
                $orderArray = $order->show_items($_GET['order_id']);
                foreach ($orderArray as $item) {

                    $product = new Product();
                    $order_item = $product->show_inv_fetch($item['product_id'], $item['variation_id'], $item['measurement_id']);

                    $notif = new Notification();

                    if (($order_item['Total_Stock'] - $order_item['Total_Sold']) - $item['quantity'] == 0) {

                        //ganito mag add (start) 
                        // pero before to gawa ka muna conditions depende ano gusto mo 
                        // like sa taas, usually ilagay tong notification after ng crud. mag tanong ka lng kundi mo gets
                        $notif->message = "No stock remaining for " . ucwords(strtolower($order_item['product_name'])) . " in " .  ucwords(strtolower($order_item['variation_name'])) . " variation and " .   ucwords(strtolower($order_item['measurement_name'])) . " measurement.";
                        $notif->store_id = $_GET['store_id'];

                        if ($notif->add()) {
                            $notif_success = "success";
                        }
                        //ganito mag add (end)

                    } else if (($order_item['Total_Stock'] - $order_item['Total_Sold']) - $item['quantity'] <= 10) {

                        $notif->message = ($order_item['Total_Stock'] - $order_item['Total_Sold']) - $item['quantity'] . " stocks remaining for " . ucwords(strtolower($order_item['product_name'])) . " in " .  ucwords(strtolower($order_item['variation_name'])) . " variation and " .   ucwords(strtolower($order_item['measurement_name'])) . " measurement.";
                        $notif->store_id = $_GET['store_id'];

                        if ($notif->add()) {
                            $notif_success = "success";
                        }
                    }
                }
            }
            // notification end

            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Order View | Crimson Avenue";
//$fulfill_page = "active";
//$order_page = "active";
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
                                                Contact:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $ord_record['contact'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Address:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $ord_record['address'] ?>
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
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mb-4 p-3 h-100">
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
                                            <td class=""><?= $item['variation_name'] ?></td>
                                            <td class=""><?= $item['measurement_name'] ?></td>
                                            <td class="text-center"><?= $item['quantity'] . 'x' ?></td>
                                            <td class=""><?= '₱' . number_format($item['oi_selling_price'] + $item['oi_commission'], 2, '.', ',') ?></td>
                                        </tr>
                                    <?php
                                        $counter++;
                                    }
                                    ?>
                                    <tr class="align-middle">
                                        <td></td>
                                        <td></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class="text-end text-secondary"> Product Subtotal:</td>
                                        <td class="fw-semibold"><?= '₱' . number_format($ord_record['product_total'] + $ord_record['commission_total'], 2, '.', ',') ?></td>
                                    </tr>
                                    <?php
                                    $delivery_charge = 0;
                                    if ($ord_record['fulfillment_method'] == "Delivery") {
                                    ?>
                                        <tr class="align-middle">
                                            <td></td>
                                            <td></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class="text-end text-secondary">Delivery Charge:</td>
                                            <td class="fw-semibold"><?= '₱' . number_format($ord_record['delivery_charge'], 2, '.', ',') ?></td>
                                        </tr>
                                    <?php
                                        $delivery_charge += $ord_record['delivery_charge'];
                                    }
                                    ?>
                                    <tr class="align-middle">
                                        <td></td>
                                        <td></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class=""></td>
                                        <td class="text-end text-secondary"> Total Payment:</td>
                                        <td class="fw-semibold"><?= '₱' . number_format($ord_record['product_total'] + $ord_record['commission_total'] + $delivery_charge, 2, '.', ',') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row h-auto d-flex justify-content-center m-0 p-0">
                            <form action="" method="post" class="row d-flex justify-content-evenly" id="orderStatusForm">
                                <?php
                                if ($ord_record['order_status'] == "Ready") {
                                ?>
                                    <div class="col-12 col-md-6 col-lg-6 m-0 p-1 d-flex">
                                        <input type="radio" class="btn-check" name="order_status" id="Completed" value="Completed" <?= $ord_record['order_status'] == "Completed" ? "checked" : "" ?> onchange="autoSubmitStatus()">
                                        <label class="btn btn-outline-secondary flex-fill fw-semibold " for="Completed"><?= $ord_record['fulfillment_method'] == 'Pickup' ? 'Picked up' : 'Delivered' ?></label>
                                    </div>
                                <?php
                                } else  if ($ord_record['order_status'] == "Completed") {
                                ?>
                                    <div class="col-12 col-md-6 col-lg-6 m-0 p-1 d-flex">
                                        <input type="radio" class="btn-check" name="order_status" id="Completed" value="Completed" <?= $ord_record['order_status'] == "Completed" ? "checked" : "" ?> onchange="autoSubmitStatus()">
                                        <label class="btn btn-outline-secondary flex-fill fw-semibold " for="Completed"><?= $ord_record['fulfillment_method'] == 'Pickup' ? 'Completed' : 'Completed' ?></label>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 col-md-4 col-lg-4 m-0 p-1 d-flex">
                                        <input type="radio" class="btn-check" name="order_status" id="Pending" value="Pending" <?= $ord_record['order_status'] == "Pending" ? "checked" : "" ?> onchange="autoSubmitStatus()">
                                        <label class="btn btn-outline-secondary flex-fill fw-semibold " for="Pending">Pending</label>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 m-0 p-1 d-flex">
                                        <input type="radio" class="btn-check" name="order_status" id="Processing" value="Processing" <?= $ord_record['order_status'] == "Processing" ? "checked" : "" ?> onchange="autoSubmitStatus()">
                                        <label class="btn btn-outline-secondary flex-fill fw-semibold " for="Processing">Processing</label>

                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 m-0 p-1 d-flex">
                                        <input type="radio" class="btn-check" name="order_status" id="Ready" value="Ready" <?= $ord_record['order_status'] == "Ready" ? "checked" : "" ?> onchange="autoSubmitStatus()">
                                        <label class="btn btn-outline-secondary flex-fill fw-semibold " for="Ready">Ready <?= $ord_record['fulfillment_method'] == 'Pickup' ? 'for Pickup' : 'for Delivery' ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <?php
    if (isset($_POST['order_status']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a class="text-decoration-none text-dark" href="./order-view.php?<?= 'store_id=' . $record['store_id'] . '&order_id=' . $ord_record['order_id'] ?>">
                                    <p class="m-0">Order status is successfully updated!</br><span class="text-primary fw-bold">Click to continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <?php
    require_once('../includes/js.php');
    ?>
    <script src="../js/order.datatable.js"></script>
    <script>
        function autoSubmitStatus() {
            var formObject = document.forms['orderStatusForm'];
            formObject.submit();
        }
    </script>
</body>

</html>