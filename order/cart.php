<?php
session_start();

require_once "../classes/cart.class.php";

$cart = new Cart();

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
                            <form action="" method="post" class="m-0 p-0 row">
                                <table id="products" class="table table-lg m-0 ">
                                    <thead>
                                        <tr class="">
                                            <th><input class="form-check-input" type="checkbox" onchange="checkAll(this, this.value)" value="<?= $counter ?>"></th>
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
                                        $total = 0;
                                        foreach ($cartArray as $item) {
                                            if ($item['store_id'] === $store['store_id']) {
                                        ?>
                                                <tr class="align-middle">
                                                    <td class="">
                                                        <input class="form-check-input" type="checkbox" name="<?= $counter ?>" value="<?= $item['cart_item_id'] ?>" id="<?= $item['cart_item_id'] . $item['product_id'] ?>">
                                                    </td>
                                                    <td class=""><img src="<?php if (isset($item['image_file'])) {
                                                                                echo "../images/data/" . $item['image_file'];
                                                                            } else {
                                                                                echo "../images/main/no-profile.jpg";
                                                                            } ?>" alt="" class="profile-list-size border border-secondary-subtle rounded-1"></td>
                                                    <td class=""><?= $item['product_name'] ?></td>
                                                    <td class=""><?= $item['variation_name'] ?></td>
                                                    <td class=""><?= $item['measurement_name'] ?></td>
                                                    <td class=""><?= $item['quantity'] ?></td>
                                                    <td class=""><?= '₱' . number_format($item['selling_price'], 2, '.', ',') ?></td>
                                                    <td class=""><?= '₱' . number_format($item['selling_price'] * $item['quantity'], 2, '.', ',') ?></td>
                                                    <td class="text-end fs-7"><button type="button" class="bg-white border-0 remove-btn-hover">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                        <?php
                                                $total += ($item['selling_price'] * $item['quantity']);
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="col-8 m-0 p-0 d-flex align-items-center mt-2">
                                    <p class="m-0 p-0 fs-6 text-dark lh-1 fw-semibold align-center">
                                        Total Price:
                                        <span class="text-primary fw-bold fs-5"><?= '₱' . number_format($total, 2, '.', ',') ?></span>
                                    </p>
                                </div>
                                <div class="col-4 m-0 p-0 align-middle mt-2">
                                    <input type="submit" class="btn btn-primary fw-semibold float-end" name="checkout" value="Checkout">
                                </div>
                            </form>
                        </div>
                    <?php
                        $counter++;
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
        function checkAll(checkallbox, counter) {
            var checkboxes = document.getElementsByName(counter);

            checkboxes.forEach(function(checkbox) {
                if (checkallbox.checked == false) {
                    checkbox.checked = false;
                } else {
                    checkbox.checked = true;
                }
            });
        }
    </script>
</body>

</html>