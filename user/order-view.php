<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role'])) {
    header('location: ../index.php');
}

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/order.class.php";

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Profile | Crimson Avenue";
$user_profile = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 my-4 mx-sm-auto min-vh-100 ">
        <main>
            <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                <div class="row d-flex justify-content-between m-0 p-0">
                    <div class="col-3 m-0 p-0">
                        <a href="./profile.php" class="text-primary fw-semibold fs-6 text-decoration-none "> <i class="fa-solid fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="col-9 m-0 p-0 text-end">
                        <p class="m-0 p-0 fs-6 fw-bold text-dark align-bottom "><span class="text-secondary fw-semibold">Order No:</span> <?= $_GET['order_id'] ?></p>
                    </div>
                    <div class="col-12 m-0 p-0">
                        <hr class="mb-0">
                    </div>
                    <table id="myorders" class="table table-lg mt-1">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col" class="fs-7"></th>
                                <th scope="col" class="fs-7"></th>
                                <th scope="col" class="fs-7">Product Name</th>
                                <th scope="col" class="fs-7">Variation</th>
                                <th scope="col" class="fs-7">Measurement</th>
                                <th scope="col" class="fs-7 text-center">Quantity</th>
                                <th scope="col" class="fs-7">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $order = new Order();
                            $orderArray = $order->show_items($_GET['order_id']);
                            $counter = 1;
                            foreach ($orderArray as $item) {
                            ?>
                                <tr class="align-middle">
                                    <td><?= $counter ?></td>
                                    <td class="">
                                        <img src=" <?php if (isset($item['image_file'])) {
                                                        echo "../images/data/" . $item['image_file'];
                                                    } else {
                                                        echo "../images/main/no-profile.jpg";
                                                    } ?>" alt="" class="profile-list-size border border-secondary-subtle rounded-1">
                                    </td>
                                    <td class=""><?= $item['product_name'] ?></td>
                                    <td class=""><?= $item['variation_name'] ?></td>
                                    <td class=""><?= $item['measurement_name'] ?></td>
                                    <td class="text-center"><?= $item['quantity'] . "x" ?></td>
                                    <td class=""><?= '₱' . number_format($item['oi_selling_price'] + $item['oi_commission'], 2, '.', ','); ?></td>

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
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
    <script src="../js/order.datatable.js"></script>
</body>

</html>