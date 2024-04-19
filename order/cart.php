<?php
session_start();

require_once "../classes/cart.class.php";
require_once "../classes/stock.class.php";

$cart = new Cart();
if (isset($_GET['delete']) && $_GET['delete'] == "True") {
    $cart->cart_item_id = htmlentities($_GET['cart_item_id']);
    $cart->is_deleted = 1;

    if ($cart->delete()) {
        $stock = new Stock();
        $stock->stock_allocated = htmlentities($_GET['quantity']);
        $stock->stock_id = htmlentities($_GET['stock_id']);

        if (htmlentities($_GET['sale_status']) == "On-hand") {
            if ($stock->return_stock()) {
                header("Location: ./cart.php");
            }
        } else if (htmlentities($_GET['sale_status']) == "Pre-order") {
            header("Location: ./cart.php");
        }
    } else {
        echo 'An error occured while adding in the database.';
        $success = 'failed';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Cart | Crimson Avenue";
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
                            <p class="m-0 p-0 fs-3 fw-bold text-primary lh-1">Cart</p>
                        </div>
                    </div>
                    <hr class="my-3">
                    <?php
                    $cartArray = $cart->show($_SESSION['cart_id']);
                    if (empty($cartArray)) {
                    ?>
                        <div class="row m-0 p-0 d-flex align-items-center">
                            <p class="text-center fw-semibold text-secondary"> No products have been added to the cart. </p>
                        </div>
                        <?php
                    } else {
                        $storeArray = [];
                        foreach ($cartArray as $item) {
                            $store = array(
                                'store_id' => $item['store_id'],
                                'store_name' => $item['store_name']
                            );

                            if (!in_array($store, $storeArray)) {

                                array_push($storeArray, $store);
                            }
                        }
                        $counter = 0;
                        foreach ($storeArray as $store) {
                        ?>
                            <div class="row m-0 p-0 p-3 border rounded mb-3">
                                <form action="./checkout.php" method="post" class="m-0 p-0 row">
                                    <table id="products" class="table table-lg m-0 ">
                                        <thead>
                                            <tr class="">
                                                <th><input class="form-check-input" type="checkbox" onchange="checkAll(this, this.value)" value="<?= $counter ?>" id="checkall<?= $counter ?>"></th>
                                                <th><label class="form-check-label" for="<?= $store['store_name'] ?>">
                                                        <p class="m-0 p-0 fs-6 fw-bold text-dark lh-1">
                                                            <?= $store['store_name'] ?>
                                                        </p>
                                                    </label></th>
                                                <th class="text-secondary fs-8 fw-semibold">Product Name</th>
                                                <th class="text-secondary fs-8 fw-semibold">Variation</th>
                                                <th class="text-secondary fs-8 fw-semibold">Measurement</th>
                                                <th class="text-secondary fs-8 fw-semibold">Quantity</th>
                                                <th class="text-secondary fs-8 fw-semibold">Price</th>
                                                <th class="text-secondary fs-8 fw-semibold">Subtotal</th>
                                                <th class="text-secondary fs-8 fw-semibold"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($cartArray as $item) {
                                                if ($item['store_id'] === $store['store_id']) {
                                            ?>
                                                    <tr class="align-middle">
                                                        <td class="">
                                                            <input class="form-check-input" type="checkbox" name="<?= $counter ?>" value="<?= $item['cart_item_id'] ?>" data-subtotal="<?= $item['selling_price'] * $item['quantity'] ?>" data-counter="<?= $counter ?>" onchange="updateTotal(this, <?= $counter ?>)">
                                                        </td>
                                                        <td class=""><img src=" <?php if (isset($item['image_file'])) {
                                                                                    echo "../images/data/" . $item['image_file'];
                                                                                } else {
                                                                                    echo "../images/main/no-profile.jpg";
                                                                                } ?>" alt="" class="profile-list-size border border-secondary-subtle rounded-1">
                                                        </td>
                                                        <td class=""><?= $item['product_name'] ?></td>
                                                        <td class=""><?= $item['variation_name'] ?></td>
                                                        <td class=""><?= $item['measurement_name'] ?></td>
                                                        <td class=""><?= $item['quantity'] ?></td>
                                                        <td class=""><?= '₱' . number_format($item['selling_price'], 2, '.', ',') ?></td>
                                                        <td class=""><?= '₱' . number_format($item['selling_price'] * $item['quantity'], 2, '.', ',') ?></td>
                                                        <td class="text-end fs-7">
                                                            <a class="text-dark remove-btn-hover fw-semibold text-decoration-none" href="./cart.php<?= '?cart_item_id=' . $item['cart_item_id'] . '&quantity=' . $item['quantity'] . '&sale_status=' . $item['sale_status'] . '&stock_id=' . $item['stock_id'] . '&delete=True' ?>  ">Delete</a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="col-8 m-0 p-0 d-flex align-items-center mt-2">
                                        <input type="hidden" name="total<?= $counter ?>" value="0">
                                        <p class="m-0 p-0 fs-6 text-dark lh-1 fw-semibold align-center" id="total_id">
                                            Total Price:
                                            <span class="text-primary fw-bold fs-5" id="total<?= $counter ?>">₱0.00</span>
                                        </p>
                                    </div>
                                    <input type="hidden" name="counter" value="<?= $counter ?>">
                                    <input type="hidden" id="allchecked<?= $counter ?>" name="allchecked<?= $counter ?>" value="">
                                    <div class="col-4 m-0 p-0 d-flex align-items-center justify-content-end mt-2">
                                        <input type="submit" class="btn btn-primary fw-semibold" name="checkout<?= $counter ?>" value="Checkout">
                                    </div>
                                </form>
                            </div>
                    <?php
                            $counter++;
                        }
                    }
                    ?>
                </div>
            </div>
        </main>
        <section>
            <!-- Code Here Extra Section -->
        </section>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
    <script>
        var totalArray = {};

        function checkAll(checkallbox, counter) {
            var checkboxes = document.getElementsByName(counter);
            var checkedvalues = document.getElementById('allchecked' + counter);

            if (!(counter in totalArray)) {
                totalArray[counter] = parseFloat(document.querySelector('input[name="total' + counter + '"][type="hidden"]').value);
            }


            checkboxes.forEach(function(checkbox) {
                if (checkallbox.checked == false && checkbox.checked == true) {
                    checkbox.checked = false;
                    totalArray[counter] -= parseFloat(checkbox.getAttribute('data-subtotal'));
                    var valuesArray = checkedvalues.value.split(',');
                    var index = valuesArray.indexOf(checkbox.value);
                    if (index !== -1) {
                        valuesArray.splice(index, 1);
                        checkedvalues.value = valuesArray.join(',');
                    }
                } else if (checkallbox.checked == true && checkbox.checked == false) {
                    checkbox.checked = true;
                    totalArray[counter] += parseFloat(checkbox.getAttribute('data-subtotal'));
                    checkedvalues.value += (checkedvalues.value === '' ? '' : ',') + checkbox.value;
                }
            });

            document.getElementById('total' + counter).innerHTML = "₱" + totalArray[counter].toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function updateTotal(checkbox, counter) {
            var checkallbox = document.getElementById('checkall' + counter);
            var checkboxes = document.getElementsByName(counter);
            var checkedvalues = document.getElementById('allchecked' + counter);

            if (!(counter in totalArray)) {
                totalArray[counter] = parseFloat(document.querySelector('input[name="total' + counter + '"][type="hidden"]').value);
            }


            if (checkedvalues.value === null || checkedvalues.value === undefined) {
                checkedvalues.value = "";
            } else {
                checkedvalues.value = checkedvalues.value.toString();
            }


            if (checkbox.checked) {
                totalArray[counter] += parseFloat(checkbox.getAttribute('data-subtotal'));
                checkedvalues.value += (checkedvalues.value === "" ? "" : ",") + checkbox.value;
            } else {
                totalArray[counter] -= parseFloat(checkbox.getAttribute('data-subtotal'));
                var valuesArray = checkedvalues.value.split(',');
                var index = valuesArray.indexOf(checkbox.value);
                if (index !== -1) {
                    valuesArray.splice(index, 1);
                }
                checkedvalues.value = valuesArray.join(',');
            }

            var checkcount = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    checkcount++;
                }
            });

            if (checkcount === checkboxes.length) {
                checkallbox.indeterminate = false;
                checkallbox.checked = true;
            } else if (checkcount === 0) {
                checkallbox.indeterminate = false;
                checkallbox.checked = false;
            } else {
                checkallbox.checked = false;
                checkallbox.indeterminate = true;
            }

            // Update the HTML with the value from totalArray
            document.getElementById('total' + counter).innerHTML = "₱" + totalArray[counter].toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // forget this just add cancel button on checkout :>
    </script>
</body>

</html>