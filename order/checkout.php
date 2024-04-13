<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/product.class.php";

$product = new Product();
$record = $product->checkout($_POST['product_id'], $_POST['variation'], $_POST['measurement']);

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
                            <p class="m-0 p-0 fs-3 fw-bold text-primary lh-1">Order Summary</p>
                        </div>
                    </div>
                </div>
                <hr>
                <table id="ordersummary" class="table table-lg mt-1">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col"></th>
                            <th scope="col" class="">Product Name</th>
                            <th scope="col" class="text-center">Variation</th>
                            <th scope="col" class="text-center">Measurement</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-center">Price</th>
                            <th scope="col" class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $counter = 1;
                        // $store = new Store();
                        // $storeArray = $store->show_mystores($_SESSION['account_id']);
                        // foreach ($storeArray as $item) {
                        ?>
                        <tr class="align-middle">
                            <td> <img src="<?php if (isset($record['image_file'])) {
                                                echo "../images/data/" . $record['image_file'];
                                            } else {
                                                echo "../images/main/no-profile.jpg";
                                            } ?>" alt="" class="profile-list-size border border-secondary-subtle rounded-1"> </td>
                            <td class=""><?= $record['product_name'] ?></td>
                            <td class="text-center"><?= $record['variation_name'] ?></td>
                            <td class="text-center"><?= $record['measurement_name'] ?></td>
                            <td class="text-center"><?= $_POST['quantity'] ?></td>
                            <td class="text-center"><?php if (isset($record['stock_selling_price'])) {
                                                        echo $record['stock_selling_price'];
                                                    } else if (isset($record['prices_selling_price'])) {
                                                        echo $record['prices_selling_price'];
                                                    } else {
                                                        echo $record['product_selling_price'];
                                                    } ?></td>
                            <td class="text-center"><?php if (isset($record['stock_selling_price'])) {
                                                        echo sprintf("%.2f", $record['stock_selling_price'] * $_POST['quantity']);
                                                    } else if (isset($record['prices_selling_price'])) {
                                                        echo sprintf("%.2f", $record['prices_selling_price'] * $_POST['quantity']);
                                                    } else {
                                                        echo sprintf("%.2f", $record['product_selling_price'] * $_POST['quantity']);
                                                    } ?></td>
                        </tr>
                        <?php
                        //     $counter++;
                        // }
                        ?>
                    </tbody>
                </table>
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
</body>

</html>