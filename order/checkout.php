<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/product.class.php";
require_once "../classes/cart.class.php";

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($_SESSION['user_role'])) {
    header('location: ../user/login.php');
}


if (isset($_POST['counter']) && isset($_POST['checkout' . $_POST['counter']])) {

    $cart = new Cart();
    $cartArray = $cart->fetch_checkout(htmlentities($_POST['allchecked' . $_POST['counter']]));
} else if (isset($_POST['add']) || isset($_POST['buy'])) {

    $product = new Product();
    $record = $product->checkout($_POST['product_id'], $_POST['variation'], $_POST['measurement']);
}

if (isset($_POST['confirm'])) {
}

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Checkout | Crimson Avenue";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto min-vh-100 ">
        <form action="" method="post">
            <main>
                <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                    <div class="row d-flex justify-content-between m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-12 m-0 p-0">
                                <p class="m-0 p-0 fs-3 fw-bold text-primary lh-1">Checkout</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table id="ordersummary" class="table table-lg mt-1">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col" class="text-secondary fs-8 fw-semibold">Product Name</th>
                                <th scope="col" class="text-secondary fs-8 fw-semibold">Variation</th>
                                <th scope="col" class="text-secondary fs-8 fw-semibold">Measurement</th>
                                <th scope="col" class="text-secondary fs-8 fw-semibold">Quantity</th>
                                <th scope="col" class="text-secondary fs-8 fw-semibold">Price</th>
                                <th scope="col" class="text-secondary fs-8 fw-semibold">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $delivery_charge = 0;
                            $product_total = 0;
                            $commission_total = 0;
                            if (isset($_POST['counter']) && isset($_POST['checkout' . $_POST['counter']])) {
                                $counter = 1;
                                foreach ($cartArray as $item) {
                            ?>
                                    <tr class="align-middle">
                                        <td class="fs-7 fw-semibold "><?= $counter ?></td>
                                        <td> <img src="<?php if (isset($item['image_file'])) {
                                                            echo "../images/data/" . $item['image_file'];
                                                        } else {
                                                            echo "../images/main/no-profile.jpg";
                                                        } ?>" alt="" class="profile-list-size border border-secondary-subtle rounded-1"> </td>
                                        <td class=""><?= $item['product_name'] ?></td>
                                        <td class=""><?= $item['variation_name'] ?></td>
                                        <td class=""><?= $item['measurement_name'] ?></td>
                                        <td class=""><?= $item['quantity'] ?></td>
                                        <td class=""><?php if (isset($item['stock_selling_price']) && $item['sale_status'] == "On-hand") {
                                                            echo '₱' . number_format($item['stock_selling_price'] + $item['stock_commission'], 2, '.', ',');
                                                        } else if (isset($item['prices_selling_price']) && $item['sale_status'] == "Pre-order") {
                                                            echo '₱' . number_format($item['prices_selling_price'] + $item['prices_commission'], 2, '.', ',');
                                                        } else {
                                                            echo '₱' . number_format($item['product_selling_price'] + $item['product_commission'], 2, '.', ',');
                                                        } ?></td>
                                        <td class=""><?php
                                                        if (isset($item['stock_selling_price']) && $item['sale_status'] == "On-hand") {
                                                            echo '₱' . number_format(($item['stock_selling_price']  + $item['stock_commission']) * $item['quantity'], 2, '.', ',');
                                                        } else if (isset($item['prices_selling_price']) && $item['sale_status'] == "Pre-order") {
                                                            echo '₱' . number_format(($item['prices_selling_price'] + $item['prices_commission']) * $item['quantity'], 2, '.', ',');
                                                        } else {
                                                            echo '₱' . number_format(($item['product_selling_price'] + $item['product_commission']) * $item['quantity'], 2, '.', ',');
                                                        }
                                                        ?></td>
                                    </tr>
                                    <input type="hidden" name="product_id<?= $counter ?>" value="<?= $item['product_id'] ?>">
                                    <input type="hidden" name="variation_id<?= $counter ?>" value="<?= $item['variation_id'] ?>">
                                    <input type="hidden" name="measurement_id<?= $counter ?>" value="<?= $item['measurement_id'] ?>">
                                    <input type="hidden" name="quantity<?= $counter ?>" value="<?= $item['quantity'] ?>">
                                    <input type="hidden" name="selling_price<?= $counter ?>" value="<?php if (isset($item['stock_selling_price']) && $item['sale_status'] == "On-hand") {
                                                                                                        echo '₱' . number_format($item['stock_selling_price'] + $item['stock_commission'], 2, '.', ',');
                                                                                                    } else if (isset($item['prices_selling_price']) && $item['sale_status'] == "Pre-order") {
                                                                                                        echo '₱' . number_format($item['prices_selling_price'] + $item['prices_commission'], 2, '.', ',');
                                                                                                    } else {
                                                                                                        echo '₱' . number_format($item['product_selling_price'] + $item['product_commission'], 2, '.', ',');
                                                                                                    } ?>">
                                    <input type="hidden" name="commission<?= $counter ?>" value="<?php
                                                                                                    if (isset($item['stock_selling_price']) && $item['sale_status'] == "On-hand") {
                                                                                                        echo '₱' . number_format(($item['stock_selling_price']  + $item['stock_commission']) * $item['quantity'], 2, '.', ',');
                                                                                                    } else if (isset($item['prices_selling_price']) && $item['sale_status'] == "Pre-order") {
                                                                                                        echo '₱' . number_format(($item['prices_selling_price'] + $item['prices_commission']) * $item['quantity'], 2, '.', ',');
                                                                                                    } else {
                                                                                                        echo '₱' . number_format(($item['product_selling_price'] + $item['product_commission']) * $item['quantity'], 2, '.', ',');
                                                                                                    }
                                                                                                    ?>">
                                <?php
                                    $delivery_charge = $item['delivery_charge'];
                                    $counter++;
                                    if (isset($item['stock_selling_price']) && $item['sale_status'] == "On-hand") {
                                        $product_total += $item['stock_selling_price'] * $item['quantity'];
                                        $commission_total += $item['stock_commission'] * $item['quantity'];
                                    } else if (isset($item['prices_selling_price']) && $item['sale_status'] == "Pre-order") {
                                        $product_total += $item['prices_selling_price'] * $item['quantity'];
                                        $commission_total += $item['prices_commission'] * $item['quantity'];
                                    } else {
                                        $product_total += $item['product_selling_price']  * $item['quantity'];
                                        $commission_total += $item['product_commission'] * $item['quantity'];
                                    }
                                } ?>
                                <input type="hidden" name="counter" value="<?= $counter ?>">
                            <?php
                            } else if (isset($_POST['add']) || isset($_POST['buy'])) {
                                $counter = 1;
                            ?>
                                <tr class="align-middle">
                                    <td class="fs-7 fw-semibold "><?= $counter ?></td>
                                    <td> <img src="<?php if (isset($record['image_file'])) {
                                                        echo "../images/data/" . $record['image_file'];
                                                    } else {
                                                        echo "../images/main/no-profile.jpg";
                                                    } ?>" alt="" class="profile-list-size border border-secondary-subtle rounded-1"> </td>
                                    <td class=""><?= $record['product_name'] ?></td>
                                    <td class=""><?= $record['variation_name'] ?></td>
                                    <td class=""><?= $record['measurement_name'] ?></td>
                                    <td class=""><?= $_POST['quantity'] ?></td>
                                    <td class=""><?php if (isset($record['stock_selling_price']) && $record['sale_status'] == "On-hand") {
                                                        echo '₱' . number_format($record['stock_selling_price'] + $record['stock_commission'], 2, '.', ',');
                                                    } else if (isset($record['prices_selling_price']) && $record['sale_status'] == "Pre-order") {
                                                        echo '₱' . number_format($record['prices_selling_price'] + $record['prices_commission'], 2, '.', ',');
                                                    } else {
                                                        echo '₱' . number_format($record['product_selling_price'] + $record['product_commission'], 2, '.', ',');
                                                    } ?></td>
                                    <td class=""><?php
                                                    if (isset($record['stock_selling_price']) && $record['sale_status'] == "On-hand") {
                                                        echo '₱' . number_format(($record['stock_selling_price'] + $record['stock_commission']) * $_POST['quantity'], 2, '.', ',');
                                                    } else if (isset($record['prices_selling_price']) && $record['sale_status'] == "Pre-order") {
                                                        echo '₱' . number_format(($record['prices_selling_price'] + $record['prices_commission']) * $_POST['quantity'], 2, '.', ',');
                                                    } else {
                                                        echo '₱' . number_format(($record['product_selling_price'] + $record['product_commission']) * $_POST['quantity'], 2, '.', ',');
                                                    }
                                                    ?></td>
                                </tr>
                                <input type="hidden" name="product_id<?= $counter ?>" value="<?= $record['product_id'] ?>">
                                <input type="hidden" name="variation_id<?= $counter ?>" value="<?= $record['variation_id'] ?>">
                                <input type="hidden" name="measurement_id<?= $counter ?>" value="<?= $record['measurement_id'] ?>">
                                <input type="hidden" name="quantity<?= $counter ?>" value="<?= $record['quantity'] ?>">
                                <input type="hidden" name="selling_price<?= $counter ?>" value="<?php if (isset($record['stock_selling_price']) && $record['sale_status'] == "On-hand") {
                                                                                                    echo '₱' . number_format($record['stock_selling_price'] + $record['stock_commission'], 2, '.', ',');
                                                                                                } else if (isset($record['prices_selling_price']) && $record['sale_status'] == "Pre-order") {
                                                                                                    echo '₱' . number_format($record['prices_selling_price'] + $record['prices_commission'], 2, '.', ',');
                                                                                                } else {
                                                                                                    echo '₱' . number_format($record['product_selling_price'] + $record['product_commission'], 2, '.', ',');
                                                                                                } ?>">
                                <input type="hidden" name="commission<?= $counter ?>" value="<?php
                                                                                                if (isset($record['stock_selling_price']) && $record['sale_status'] == "On-hand") {
                                                                                                    echo '₱' . number_format(($record['stock_selling_price']  + $record['stock_commission']) * $record['quantity'], 2, '.', ',');
                                                                                                } else if (isset($record['prices_selling_price']) && $record['sale_status'] == "Pre-order") {
                                                                                                    echo '₱' . number_format(($record['prices_selling_price'] + $record['prices_commission']) * $record['quantity'], 2, '.', ',');
                                                                                                } else {
                                                                                                    echo '₱' . number_format(($record['product_selling_price'] + $item['product_commission']) * $record['quantity'], 2, '.', ',');
                                                                                                }
                                                                                                ?>">
                                <?php
                                $delivery_charge = $record['delivery_charge'];
                                if (isset($record['stock_selling_price']) && $record['sale_status'] == "On-hand") {
                                    $product_total += $record['stock_selling_price'] * $_POST['quantity'];
                                    $commission_total +=  $record['stock_commission'] * $_POST['quantity'];
                                } else if (isset($record['prices_selling_price']) && $record['sale_status'] == "Pre-order") {
                                    $product_total += $record['prices_selling_price'] * $_POST['quantity'];
                                    $commission_total +=  $record['prices_commission'] * $_POST['quantity'];
                                } else {
                                    $product_total += $record['product_selling_price'] * $_POST['quantity'];
                                    $commission_total += $record['product_commission'] * $_POST['quantity'];
                                }
                                ?>
                                <input type="hidden" name="counter" value="<?= $counter ?>">
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
            <section>
                <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                    <div class="row m-0 p-0 d-flex justify-content-end">
                        <div class="row m-0 p-0 col-12 col-lg-8 pe-lg-2 d-flex flex-column align-items-start">
                            <div class="form-group m-0 p-0 row col-12 d-flex justify-content-end align-items-start">
                                <div class="col-auto m-0 p-0 mb-2 flex-fill">
                                    <p class="m-0 p-0 fs-7 fw-semibold text-secondary lh-1">Payment Method:</p>
                                </div>
                                <div class="m-0 p-0 col-auto ms-2 mb-2 text-center">
                                    <input class="form-check-input btn-check" type="radio" name="method" id="Cash" value="Cash">
                                    <label class="btn btn-outline-primary btn-small fw-semibold fs-7 lh-sm" for="Cash">
                                        Cash Payment
                                    </label>
                                </div>
                                <div class="m-0 p-0 col-auto ms-2 mb-2 text-center">
                                    <input class="form-check-input  btn-check" type="radio" name="method" id="GCash" value="GCash">
                                    <label class="btn btn-outline-primary btn-small fw-semibold fs-7 lh-sm" for="GCash">
                                        GCash Payment
                                    </label>
                                </div>
                            </div>
                            <div class="form-group m-0 p-0 row col-12 d-flex justify-content-end align-items-start">
                                <div class="col-auto m-0 p-0 mb-2 flex-fill">
                                    <p class="m-0 p-0 fs-7 fw-semibold text-secondary lh-1">Order Fulfillment:</p>
                                </div>
                                <div class="m-0 p-0 col-auto ms-2 mb-2 text-center">
                                    <input class="form-check-input btn-check" type="radio" name="fulfillment" id="Pickup" value="Pickup">
                                    <label class="btn btn-outline-primary btn-small fw-semibold fs-7 lh-sm" for="Pickup">
                                        Pickup
                                    </label>
                                </div>
                                <div class="m-0 p-0 col-auto ms-2 mb-2 text-center">
                                    <input class="form-check-input  btn-check" type="radio" name="fulfillment" id="Delivery" value="Delivery">
                                    <label class="btn btn-outline-primary btn-small fw-semibold fs-7 lh-sm" for="Delivery">
                                        Delivery
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="m-0 p-0 col-12 col-lg-4 ps-lg-2 border-checkout">
                            <p class="mb-1 lh-1 text-secondary fs-7 d-flex align-items-start justify-content-between">
                                Product Subtotal:
                                <span class="text-dark fw-semibold fs-6"><?= '₱' . number_format($product_total + $commission_total, 2, '.', ',') ?> </span>
                            </p>
                            <?php
                            $total_payment = $product_total + $commission_total + $delivery_charge;
                            ?>
                            <p class="mb-1 lh-1 text-secondary fs-7 d-flex align-items-start justify-content-between">
                                Delivery Charge:
                                <span class="text-dark fw-semibold fs-6"><?= '₱' . number_format($delivery_charge, 2, '.', ',') ?> </span>
                            </p>
                            <p class="mb-1 lh-1 text-secondary fs-7 d-flex align-items-start justify-content-between">
                                Total Payment:
                                <span class="text-primary fw-bold fs-5"><?= '₱' . number_format($total_payment, 2, '.', ',') ?> </span>
                            </p>
                            <div class="col-12 m-0 p-0 mb-1 d-flex justify-content-evenly">
                                <input type="submit" class="btn btn-primary fw-semibold flex-grow-1" value="Place Order" name="confirm" id="Confirm">
                            </div>
                            <?php
                            if (isset($_POST['counter']) && isset($_POST['checkout' . $_POST['counter']])) {
                                $cancel_link = "./cart.php";
                            } else if (isset($_POST['add']) || isset($_POST['buy'])) {
                                $cancel_link = "../products/product-view.php?product_id=" . $_POST['product_id'];
                            }
                            ?>
                            <div class="col-12 m-0 p-0 mt-2 d-flex justify-content-evenly">
                                <a href="<?= $cancel_link ?>" class="fs-7 fw-semibold text-secondary remove-btn-hover lh-1">Cancel Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
</body>

</html>