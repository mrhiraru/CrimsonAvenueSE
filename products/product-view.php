<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/product.class.php";
require_once "../classes/description.class.php";
require_once "../classes/variation.class.php";
require_once "../classes/measurement.class.php";
require_once "../classes/image.class.php";
require_once "../classes/cart.class.php";
require_once "../classes/stock.class.php";

$product = new Product();
$record = $product->fetch($_GET['product_id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($record['product_id']) || $record['is_deleted'] == 1) {
    header('location: ../products/products.php?page=1');
}

if (isset($_POST['add'])) {
    $cart = new Cart;

    if (!isset($_SESSION['cart_id'])) {
        header("Location: ../user/login.php");
    }

    $cart->cart_id = $_SESSION['cart_id'];
    $cart->product_id = htmlentities($_POST['product_id']);
    if (isset($_POST['variation'])) {
        $cart->variation_id = htmlentities($_POST['variation']);
    } else {
        $cart->variation_id = '';
    }
    if (isset($_POST['measurement'])) {
        $cart->measurement_id = htmlentities($_POST['measurement']);
    } else {
        $cart->measurement_id = '';
    }
    $cart->quantity = htmlentities($_POST['quantity']);

    $record_checkout = $product->add_to_cart($cart->product_id, $cart->variation_id, $cart->measurement_id);


    if (isset($record_checkout['stock_selling_price']) && $record_checkout['sale_status'] == "On-hand") {
        $cart->selling_price = $record_checkout['stock_selling_price'];
    } else if (isset($record_checkout['prices_selling_price']) && $record_checkout['sale_status'] == "Pre-order") {
        $cart->selling_price = $record_checkout['prices_selling_price'];
    } else {
        $cart->selling_price = $record_checkout['product_selling_price'];
    }

    if ($record_checkout['sale_status'] == "On-hand") {
        $cart->stock_id = htmlentities($_POST['stock_id']);
    } else {
        $cart->stock_id = null;
    }

    if (
        validate_field($cart->cart_id) &&
        validate_field($cart->product_id) &&
        validate_field($cart->variation_id) &&
        validate_field($cart->measurement_id) &&
        validate_field($cart->quantity) &&
        validate_field($cart->selling_price)
    ) {
        if ($cart->add()) {
            $stock = new Stock();
            $stock->stock_allocated = $record_checkout['stock_allocated'] + $cart->quantity;
            $stock->stock_id = $record_checkout['stock_id'];
            if ($record_checkout['sale_status'] == "On-hand") {
                if ($stock->take_stock()) {
                    $success = 'success';
                }
            } else if ($record_checkout['sale_status'] == "Pre-order") {
                $success = 'success';
            }
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
$title = "Product View | Crimson Avenue";
$page_name = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body onload="showStocks(<?= $_GET['product_id'] ?>); showPrice(<?= $_GET['product_id'] ?>, <?= $record['selling_price'] ?>)">
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto  min-vh-100 ">
        <main class="">
            <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                <div class="row d-flex justify-content-start m-0 p-0">
                    <div class="col-12 col-md-auto m-0 p-0 d-flex flex-column align-items-center">
                        <div id="carouselExampleCaptions" class="carousel slide product-view-width" data-bs-ride="carousel">
                            <div class="carousel-inner rounded">
                                <?php
                                $activecounter = false;
                                $image = new Image();
                                $imagesArray = $image->show($record['product_id']);
                                if (empty($imagesArray)) {
                                ?>
                                    <div class="carousel-item carousel-custom active" data-bs-interval="5000">
                                        <img src="../images/main/no-profile.jpg" alt="" class="product-view-img border border-secondary-subtle rounded-2">
                                    </div>
                                    <?php
                                } else {
                                    foreach ($imagesArray as $img) {
                                    ?>
                                        <div class="carousel-item carousel-custom <?= ($activecounter == false) ? 'active' : '' ?> " data-bs-interval="5000">
                                            <img src="<?php if (isset($img['image_file'])) {
                                                            echo "../images/data/" . $img['image_file'];
                                                        } else {
                                                            echo "../images/main/no-profile.jpg";
                                                        } ?>" alt="" class="product-view-img img-fluid border border-secondary-subtle rounded-2">
                                        </div>
                                <?php
                                        $activecounter = true;
                                    }
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 m-0 p-0 pt-3 pt-md-0 ps-md-3 d-flex flex-fill flex-column align-items-start">
                        <p class="col-12 fs-2 fw-bold text-dark m-0 p-0 text-wrap lh-sm"> <?= ucwords(strtolower($record['product_name'])) ?> </p>
                        <div class="row m-0 p-0 w-100">
                            <div class="col-auto m-0 p-0">
                                <p class="fs-6 text-nowrap text-secondary m-0 mt-1 p-0 lh-1 text-truncate">
                                    By
                                    <span class="text-primary fw-semibold"><?= $record['store_name'] ?></span>
                                </p>
                            </div>
                            <div class="col-auto m-0 mx-1 p-0">
                                <p class="fs-5 text-nowrap text-secondary m-0 p-0 lh-1 text-truncate">
                                    |
                                </p>
                            </div>
                            <div class="col-auto m-0 p-0">
                                <p class="fs-6 text-nowrap text-secondary m-0 mt-1 p-0 lh-1 text-truncate">
                                    For
                                    <span class="text-primary fw-semibold"><?= $record['exclusivity'] ?></span>
                                </p>
                            </div>
                            <div class="col-auto m-0 p-0 text-end flex-grow-1">
                                <a href="" class="text-secondary text-decoration-none">Report</a>
                            </div>
                        </div>
                        <div class="col-12 m-0 my-1 p-0 border-top"></div>
                        <p class="fs-1 text-nowrap fw-bold text-primary m-0 lh-1  text-truncate" id="price"> <?= '₱' . number_format($record['selling_price'] + $record['commission'], 2, '.', ',') ?> </p>
                        <div class="col-12 m-0 my-1 p-0 border-top"></div>
                        <form action="" method="post" class="col-12" id="orderForm">
                            <input type="hidden" name="product_id" value="<?= $record['product_id'] ?>">
                            <div class="col-12 m-0 mb-1 p-0 d-flex flex-row flex-wrap align-items-center text-secondary">
                                <?php
                                $variation = new Variation();
                                $varArray = $variation->show($record['product_id']);
                                if (count($varArray) >= 2) {
                                ?>
                                    <div class="col-12 m-0 p-0 me-1 mb-1 fs-7">
                                        Variation:
                                    </div>
                                    <?php
                                }
                                foreach ($varArray as $item) {
                                    if (count($varArray) <= 1) {
                                    ?>
                                        <input type="hidden" name="variation" value="<?= $item['variation_id'] ?>">
                                    <?php
                                    } else {
                                    ?>
                                        <div class="m-0 p-0 me-1 mb-1">
                                            <input type="radio" class="btn-check" name="variation" id="<?= "variation_" . $item['variation_name'] ?>" value="<?= $item['variation_id'] ?>" <?= (isset($_POST['variation']) && $_POST['variation'] == $item['variation_id']) ? 'checked' : '' ?> onchange="showStocks(<?= $_GET['product_id'] ?>); showPrice(<?= $_GET['product_id'] ?>, <?= $record['selling_price'] + $record['commission'] ?>); showStockId(<?= $_GET['product_id'] ?>)">
                                            <label class="btn btn-product-size btn-sm btn-outline-primary rounded-2 px-2 py-1 fs-7" for="<?= "variation_" . $item['variation_name'] ?>"><?= $item['variation_name'] ?></label>
                                        </div>

                                    <?php
                                    }
                                }
                                if (((isset($_POST['add']) || isset($_POST['buy'])) && !isset($_POST['variation'])) || (isset($_POST['variation']) && !validate_field($_POST['variation']))) {
                                    ?>
                                    <p class="fs-7 text-primary m-0 p-0 col-12">Please select variation.</p>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-12 m-0 mb-1 p-0 d-flex flex-row flex-wrap align-items-center text-secondary">
                                <?php
                                $measurement = new Measurement();
                                $meaArray = $measurement->show($record['product_id']);
                                if (count($meaArray) >= 2) {
                                ?>
                                    <div class="col-12 m-0 p-0 me-1 mb-1 fs-7">
                                        Measurements:
                                    </div>
                                    <?php
                                }
                                foreach ($meaArray as $item) {
                                    if (count($meaArray) <= 1) {
                                    ?>
                                        <input type="hidden" name="measurement" value="<?= $item['measurement_id'] ?>">
                                    <?php
                                    } else {
                                    ?>
                                        <div class="m-0 p-0 me-1 mb-1">
                                            <input type="radio" class="btn-check" name="measurement" id="<?= "measurement_" . $item['measurement_name'] ?>" value="<?= $item['measurement_id'] ?>" <?= (isset($_POST['measurement']) && $_POST['measurement'] == $item['measurement_id']) ? 'checked' : '' ?> onchange="showStocks(<?= $_GET['product_id'] ?>); showPrice(<?= $_GET['product_id'] ?>, <?= $record['selling_price'] + $record['commission'] ?>); showStockId(<?= $_GET['product_id'] ?>)">
                                            <label class="btn btn-product-size btn-sm btn-outline-primary rounded-2 px-2 py-1 fs-7" for="<?= "measurement_" . $item['measurement_name'] ?>"><?= $item['measurement_name'] . ' ' . $item['value_unit'] ?></label>
                                        </div>

                                    <?php
                                    }
                                }
                                if (((isset($_POST['add']) || isset($_POST['buy'])) && !isset($_POST['measurement'])) || (isset($_POST['measurement']) && !validate_field($_POST['measurement']))) {
                                    ?>
                                    <p class="fs-7 text-primary m-0 p-0 col-12">Please select measurement.</p>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-12 m-0 mb-1 p-0 d-flex flex-row flex-wrap align-items-center text-secondary">
                                <div class="col-12 m-0 p-0 me-1 mb-1 fs-7">
                                    <label for="quantity">Quantity: <?= isset($record['order_quantity_limit']) && $record['order_quantity_limit'] > 0 ? $record['order_quantity_limit'] . " Limit per Order" : "" ?></label>
                                </div>
                                <div class="m-0 p-0 me-1 mb-1">
                                    <input type="number" class="form-control btn-product-size focus-primary px-2 py-1 fs-7" name="quantity" id="quantity" oninput="validateinputqty(this, <?= $record['order_quantity_limit'] > 0 ? $record['order_quantity_limit'] : 'Infinity'  ?>)" value="1">
                                </div>
                            </div>
                            <div class="col-12 m-0 mb-1 p-0 d-flex flex-row flex-wrap align-items-center text-secondary">
                                <div class="m-0 p-0 me-1 mb-1 text-secondary fs-7">
                                    <input type="hidden" name="available_stock" id="available_stock" value="">
                                    <input type="hidden" name="stock_id" id="stock_id" value="">
                                    <input type="hidden" name="selling_price" id="selling_price" value="">
                                    <?php
                                    if (isset($record['sale_status']) && $record['sale_status'] == "Pre-order") {
                                        if (isset($record['estimated_order_time']) && $record['estimated_order_time'] > 0) {
                                    ?>
                                            Estimated order processing time: <?= $record['estimated_order_time'] ?> Days
                                        <?php
                                        }
                                    } else if (isset($record['sale_status']) && $record['sale_status'] == "On-hand") {
                                        ?>
                                        <div id="stock" class="m-0 p-0">

                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 m-0 my-1 p-0 border-top"></div>
                            <div class="col-12 m-0 mb-1 p-0 d-flex flex-row flex-wrap align-items-center text-secondary">
                                <?php
                                if ($record['restriction_status'] == "Unrestricted") {
                                ?>
                                    <div class="col-12 m-0 p-0 me-1 mt-2 d-flex justify-content-evenly">
                                        <input type="submit" class="btn btn-primary fw-semibold flex-grow-1 me-1" value="Add to Cart" name="add" id="add">
                                        <input type="submit" class="btn btn-primary fw-semibold flex-grow-1 ms-1" value="<?= $record['sale_status'] == "On-hand" ? "Buy Now" : "Pre Order" ?>" name="buy" id="buy">
                                    </div>
                                <?php
                                } else if ($record['restriction_status'] == "Restricted") {
                                ?>
                                    <div class="col-12 m-0 p-0 me-1 mt-2 d-flex justify-content-evenly">
                                        This product is currently restricted.
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <section>
            <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3 h-100">
                <div class="row d-flex justify-content-start m-0 p-0">
                    <div class="col-12 m-0 p-0">
                        <p class="m-0 p-0 fs-5 fw-semibold text-dark lh-1 flex-fill">
                            Descriptions
                        </p>
                    </div>
                    <div class="col-12 m-0 p-0">
                        <hr class="mb-0 mt-2">
                    </div>
                    <div class="col-12 m-0 p-0">
                        <table class="table-sm m-0">
                            <?php
                            $description = new Description();
                            $descArray = $description->show($_GET['product_id']);
                            if (empty($descArray)) {
                            ?>
                                <p class="text-secondary m-0 mt-1 p-0">
                                    No product descriptions.
                                </p>
                                <?php
                            } else {
                                foreach ($descArray as $item) {
                                ?>
                                    <tr>
                                        <td class="text-dark">
                                            <span class="text-secondary fw-normal">
                                                <?= $item['desc_label'] ?>:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $item['desc_value'] ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    if (isset($_POST['add']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./product-view.php?product_id=<?= $record['product_id'] ?>" class="text-decoration-none text-dark">
                                    <p class="m-0 text-dark">Product is successfully added to cart! <br><span class="text-primary fw-bold">Click to Continue</span>.</p>
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
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
    <script>
        function showStocks(product) {
            var variation_input = document.querySelector('input[name="variation"]:checked') ||
                document.querySelector('input[name="variation"][type="hidden"][value]');
            var measurement_input = document.querySelector('input[name="measurement"]:checked') ||
                document.querySelector('input[name="measurement"][type="hidden"][value]');

            if (variation_input !== null && measurement_input !== null) {
                var variation = variation_input.value;
                var measurement = measurement_input.value;

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    var available_stock = this.responseText;
                    if (available_stock === "0") {
                        document.getElementById("stock").innerHTML = "No available stocks.";
                    } else {
                        document.getElementById("stock").innerHTML = available_stock + " available stocks.";
                    }
                    document.getElementById("available_stock").value = available_stock;
                    disableButton(available_stock);
                }
                xhttp.open("GET", "getstock.php?product_id=" + product + "&variation_id=" + variation + "&measurement_id=" + measurement);
                xhttp.send();
            }
        }

        function showStockId(product) {
            var variation_input = document.querySelector('input[name="variation"]:checked') ||
                document.querySelector('input[name="variation"][type="hidden"][value]');
            var measurement_input = document.querySelector('input[name="measurement"]:checked') ||
                document.querySelector('input[name="measurement"][type="hidden"][value]');

            if (variation_input !== null && measurement_input !== null) {
                var variation = variation_input.value;
                var measurement = measurement_input.value;

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    var stock_id = this.responseText;
                    document.getElementById("stock_id").value = stock_id;
                }
                xhttp.open("GET", "getstockid.php?product_id=" + product + "&variation_id=" + variation + "&measurement_id=" + measurement);
                xhttp.send();
            }
        }

        function showPrice(product, price) {
            var variation_input = document.querySelector('input[name="variation"]:checked') ||
                document.querySelector('input[name="variation"][type="hidden"][value]');
            var measurement_input = document.querySelector('input[name="measurement"]:checked') ||
                document.querySelector('input[name="measurement"][type="hidden"][value]');

            if (variation_input !== null && measurement_input !== null) {
                var variation = variation_input.value;
                var measurement = measurement_input.value;

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    var stock_price = this.responseText;
                    document.getElementById("price").innerHTML = stock_price;
                    document.querySelector('input[name="selling_price"][type="hidden"]').value = stock_price;
                }
                xhttp.open("GET", "getprice.php?product_id=" + product + "&variation_id=" + variation + "&measurement_id=" + measurement + "&price=" + price);
                xhttp.send();
            }
        }

        function disableButton(available_stock) {
            var add_btn = document.getElementById('add');
            var buy_btn = document.getElementById('buy');

            if (available_stock === "0") {
                add_btn.disabled = true;
                buy_btn.disabled = true;
            } else {
                add_btn.disabled = false;
                buy_btn.disabled = false;
            }
        }

        function changeActionLink(event) {
            var form = document.getElementById("orderForm");

            const queryLink = window.location.href;

            const variationChecked = document.querySelector('input[name="variation"]:checked') ||
                document.querySelector('input[name="variation"][type="hidden"][value]');
            const measurementChecked = document.querySelector('input[name="measurement"]:checked') ||
                document.querySelector('input[name="measurement"][type="hidden"][value]');

            if (event.target.id === "add") {
                form.action = queryLink;
            } else if (event.target.id === "buy") {
                if (!variationChecked || !measurementChecked) {
                    form.action = queryLink;
                } else {
                    form.action = "../order/checkout.php";
                }
            }
        }

        document.getElementById("add").addEventListener("click", changeActionLink);
        document.getElementById("buy").addEventListener("click", changeActionLink);
    </script>
</body>

</html>