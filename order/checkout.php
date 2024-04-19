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
                                                        echo '₱' . $item['stock_selling_price'];
                                                    } else if (isset($item['prices_selling_price']) && $item['sale_status'] == "Pre-order") {
                                                        echo '₱' . $item['prices_selling_price'];
                                                    } else {
                                                        echo '₱' . $item['product_selling_price'];
                                                    } ?></td>
                                    <td class=""><?php if (isset($item['stock_selling_price']) && $item['sale_status'] == "On-hand") {
                                                        echo '₱' . sprintf("%.2f", $item['stock_selling_price'] * $item['quantity']);
                                                    } else if (isset($item['prices_selling_price']) && $item['sale_status'] == "Pre-order") {
                                                        echo '₱' . sprintf("%.2f", $item['prices_selling_price'] * $item['quantity']);
                                                    } else {
                                                        echo '₱' . sprintf("%.2f", $item['product_selling_price'] * $item['quantity']);
                                                    } ?></td>
                                </tr>
                            <?php
                                $counter++;
                            }
                        } else if (isset($_POST['add']) || isset($_POST['buy'])) {
                            ?>
                            <tr class="align-middle">
                                <td class="fs-7 fw-semibold ">1</td>
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
                                                    echo '₱' . $record['stock_selling_price'];
                                                } else if (isset($record['prices_selling_price']) && $record['sale_status'] == "Pre-order") {
                                                    echo '₱' . $record['prices_selling_price'];
                                                } else {
                                                    echo '₱' . $record['product_selling_price'];
                                                } ?></td>
                                <td class=""><?php if (isset($record['stock_selling_price']) && $record['sale_status'] == "On-hand") {
                                                    echo '₱' . sprintf("%.2f", $record['stock_selling_price'] * $_POST['quantity']);
                                                } else if (isset($record['prices_selling_price']) && $record['sale_status'] == "Pre-order") {
                                                    echo '₱' . sprintf("%.2f", $record['prices_selling_price'] * $_POST['quantity']);
                                                } else {
                                                    echo '₱' . sprintf("%.2f", $record['product_selling_price'] * $_POST['quantity']);
                                                } ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <section>
            <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                <div class="row d-flex justify-content-between m-0 p-0">
                    <div class="row m-0 p-0">
                        <div class="form-group m-0 p-0 row col-12 d-flex justify-content-md-end align-items-center">
                            <div class="col-sm-12 col-md-auto m-0 p-0 mb-2 flex-fill">
                                <p class="m-0 p-0 fs-6 fw-semibold text-secondary lh-1">Payment Method:</p>
                            </div>
                            <div class="m-0 p-0 col-6 col-md-auto me-md-3 mb-2 text-center">
                                <input class="form-check-input btn-check" type="radio" name="method" id="Cash" value="Cash">
                                <label class="btn btn-outline-primary btn-small fw-semibold fs-7 lh-sm" for="Cash">
                                    Cash Payment
                                </label>
                            </div>
                            <div class="m-0 p-0 col-6 col-md-auto me-md-1 mb-2 text-center">
                                <input class="form-check-input  btn-check" type="radio" name="method" id="GCash" value="GCash">
                                <label class="btn btn-outline-primary btn-small fw-semibold fs-7 lh-sm" for="GCash">
                                    GCash Payment
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="form-group m-0 p-0 row col-12 d-flex justify-content-md-end align-items-center">
                            <div class="col-sm-12 col-md-auto m-0 p-0 mb-2 flex-fill">
                                <p class="m-0 p-0 fs-6 fw-semibold text-secondary lh-1"> Fulfillment:</p>
                            </div>
                            <div class="m-0 p-0 col-6 col-md-auto me-md-3 mb-2 text-center">
                                <input class="form-check-input btn-check" type="radio" name="fulfillment" id="Pickup" value="Pickup">
                                <label class="btn btn-outline-primary btn-small fw-semibold fs-7 lh-sm" for="Pickup">
                                    Pickup
                                </label>
                            </div>
                            <div class="m-0 p-0 col-6 col-md-auto me-md-1 mb-2 text-center">
                                <input class="form-check-input  btn-check" type="radio" name="fulfillment" id="Delivery" value="Delivery">
                                <label class="btn btn-outline-primary btn-small fw-semibold fs-7 lh-sm" for="Delivery">
                                    Delivery
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row m-0 p-0">

                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
</body>

</html>