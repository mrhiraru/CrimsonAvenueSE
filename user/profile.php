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
            <div class="container-fluid bg-white shadow rounded m-0 p-3">
                <div class="row d-flex justify-content-center m-0 p-0">
                    <div class="col-12 m-0 p-0 px-2 btn-group">
                        <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                            Profile
                        </p>
                        <p type="button" class="m-0 p-0 text-secondary border-0 bg-white fw-semibold fs-4 lh-1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis"></i>
                        </p>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item border-0 bg-white" onclick="window.location.href = 'edit_profile.php'">Settings</button>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 m-0 p-0">
                        <hr class="mb-0">
                    </div>
                    <div class="col-12 col-lg-auto m-0 p-3 d-flex flex-column align-items-center">
                        <img src="<?php if (isset($_SESSION['profile_image'])) {
                                        echo "../images/data/" . $_SESSION['profile_image'];
                                    } else {
                                        echo "../images/main/no-profile.jpg";
                                    } ?>" alt="" class="profile-size border border-secondary-subtle rounded-2">
                    </div>
                    <div class="col-auto d-none d-lg-block p-0 m-0 border-start"></div>
                    <div class="col-12 col-lg-auto m-0 p-2 d-flex justify-content-start align-items-start flex-fill row">
                        <table class="table-sm m-0">
                            <tr>
                                <td class="fw-semibold text-dark">
                                    <span class="text-secondary fw-normal">
                                        Name:
                                    </span>
                                    <br class="d-block d-md-none">
                                    <?= $_SESSION['full_name'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark">
                                    <span class="text-secondary fw-normal">
                                        Gender:
                                    </span>
                                    <br class="d-block d-md-none">
                                    <?= $_SESSION['gender'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark">
                                    <span class="text-secondary fw-normal">
                                        Affiliation:
                                    </span>
                                    <br class="d-block d-md-none">
                                    <?= $_SESSION['affiliation'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark">
                                    <span class="text-secondary fw-normal">
                                        College:
                                    </span>
                                    <br class="d-block d-md-none">
                                    <?php if (!isset($_SESSION['college_name'])) {
                                        echo 'No College';
                                    } else {
                                        echo $_SESSION['college_name'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark">
                                    <span class="text-secondary fw-normal">
                                        Department:
                                    </span>
                                    <br class="d-block d-md-none">
                                    <?php if (!isset($_SESSION['department_name'])) {
                                        echo 'No Department';
                                    } else {
                                        echo $_SESSION['department_name'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark">
                                    <span class="text-secondary fw-normal">
                                        Email:
                                    </span>
                                    <br class="d-block d-md-none">
                                    <?= $_SESSION['email'] ?> -
                                    <span class="text-primary fw-semibold"><?= $_SESSION['verification_status'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark">
                                    <span class="text-secondary fw-normal">
                                        Contact:
                                    </span>
                                    <br class="d-block d-md-none">
                                    <?= $_SESSION['contact'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark">
                                    <span class="pe-3 text-secondary fw-normal">
                                        Address:
                                    </span>
                                    <br class="d-block d-md-none">
                                    <?php if (isset($_SESSION['address'])) {
                                        echo $_SESSION['address'];
                                    } else {
                                        echo "No Address";
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark">
                                    <span class="text-secondary fw-normal">
                                        User Role:
                                    </span>
                                    <br class="d-block d-md-none">
                                    <?php if ($_SESSION['user_role'] == 0) {
                                        echo "Administrator";
                                    } else if ($_SESSION['user_role'] == 1) {
                                        echo "Moderator";
                                    } else if ($_SESSION['user_role'] == 2) {
                                        echo "User";
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <section>
            <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                <div class="row d-flex justify-content-between m-0 p-0">
                    <div class="col-12 m-0 p-0">
                        <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1">My Orders</p>
                    </div>
                    <div class="col-12 m-0 p-0">
                        <hr class="mb-0">
                    </div>
                    <table id="myorders" class="table table-lg mt-1">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col" class="fs-7">Order Number</th>
                                <th scope="col" class="fs-7">Store Name</th>
                                <th scope="col" class="fs-7">Total Price</th>
                                <th scope="col" class="fs-7">Payment Method</th>
                                <th scope="col" class="fs-7">Fulfillment</th>
                                <th scope="col" class="fs-7">Status</th>
                                <th scope="col" class="fs-7 text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $order = new Order();
                            $orderArray = $order->show($_SESSION['account_id']);
                            foreach ($orderArray as $item) {
                            ?>
                                <tr class="align-middle">
                                    <td><?= $item['order_id'] ?></td>
                                    <td class=""><?= $item['store_name'] ?></td>
                                    <td class=""><?= '₱' . number_format(($item['product_total'] + $item['commission_total'] + $item['delivery_charge']), 2, '.', ',') ?></td>
                                    <td class=""><?= $item['payment_method'] ?></td>
                                    <td class=""><?= $item['fulfillment_method'] ?></td>
                                    <td class=""><?= $item['order_status'] ?></td>
                                    <td class="text-center text-nowrap">
                                        <div class="m-0 p-0 text-end">
                                            <a href="./order-view.php?order_id=<?= $item['order_id'] ?>" type="button" class="text-primary border-0 fw-semibold text-decoration-none fs-7">View Order</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $counter++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
    <script src="../js/order.datatable.js"></script>
</body>

</html>