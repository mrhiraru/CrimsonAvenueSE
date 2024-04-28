
<!DOCTYPE html>

<html lang="en">
<?php
session_start();
// Change title for each page.
$title = "Notification | Crimson Avenue";
$page_name = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
include_once('../classes/order.class.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto min-vh-100 ">
    <main class="col-md-9 pt-3 mx-sm-auto col-lg-10 p-md-4">
        <div class="container-fluid mb-3 p-3 bg-white shadow rounded">
            <div class="row h-auto mb-4 d-flex justify-content-center">
                <div class="row m-0 p-0 d-flex align-items-center">
                <div class="col-6 m-0 p-0">
                        <p class="m-3 p-0 fs-3 fw-bold text-primary lh-1">Notification</p>
                    </div>
                        
                </div>
                <hr class="text-secondary">
                <!-- datatable start -->
                <div class="table-responsive overflow-hidden">
                    <table id="messagebox" class="table table-sm">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col"></th>
                                <th scope="col">Notification</th>
                                <th scope="col"></th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            require_once('../classes/order.class.php');

                            $order = new Order();
                            $user_id = $_SESSION['account_id'];

                            if ($order->checkOrderStatusUpdateByAccount($user_id)) {
                                $orders = $order->getOrdersByAccount($user_id);

                                foreach ($orders as $order) {
                                    $product_name = $order['product_name'];
                                    $store_name = $order['store_name'];
                                    $order_status = $order['order_status'];

                                    switch ($order_status) {
                                        case 'Processing':
                                            $notification_message = "Your order for <strong>$product_name</strong> from <strong>$store_name</strong> is currently processing.";
                                            break;
                                        case 'Ready':
                                            $notification_message = "Your order for <strong>$product_name</strong> from <strong>$store_name</strong> is ready to pick up.";
                                            break;
                                        case 'Completed':
                                            $notification_message = "Thank you for ordering with us from <strong>$store_name</strong>.";
                                            break;
                                        default:
                                            $notification_message = "Your Order is still pending. Please wait for the seller to accept.";
                                    }
                                    
                            ?>
                            <tr class="align-middle">
                                <td></td>
                                <td><?= $notification_message ?></td>
                                <td></td>
                                <td><?= date("F j, Y h:i:s A") ?></td>


                            </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <!-- datatable end -->
            </div>
        </div>
    </div>
    </main>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
</body>

</html>