<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/product.class.php";

$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_GET['store_id']) || !isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Store Products | Crimson Avenue";
$order_page = "active";
$orders_page = "active";
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
                <main class="col-md-9 col-lg-10 p-4 row m-0">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row h-auto d-flex justify-content-center m-0 p-0">
                            <div class="search-keyword col-12 col-lg-4 mb-2 ms-auto p-0">
                                <div class="input-group">
                                    <input type="text" name="keyword" id="keyword" placeholder="" class="form-control">
                                    <span class="input-group-text text-white bg-primary border-primary btn-settings-size fw-semibold" id="basic-addon1"><span class="mx-auto">Search</span></span>
                                </div>
                            </div>
                            <table id="products" class="table table-lg mt-1">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col" class="text-center">Product Name</th>
                                        <th scope="col" class="text-center">Category</th>
                                        <th scope="col" class="text-center">Exclusivity</th>
                                        <th scope="col" class="text-center">Availability</th>
                                        <th scope="col" class="text-center">Restriction Status</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    $product = new Product();
                                    $productArray = $product->show($record['store_id']);
                                    foreach ($productArray as $item) {
                                    ?>
                                        <tr class="align-middle">
                                            <td><?= $counter ?></td>
                                            <td> <img src="<?php if (isset($item['image_file'])) {
                                                                echo "../images/data/" . $item['image_file'];
                                                            } else {
                                                                echo "../images/main/no-profile.jpg";
                                                            } ?>" alt="" class="profile-list-size border border-secondary-subtle rounded-1"> </td>
                                            <td class="text-center"><?= $item['product_name'] ?></td>
                                            <td class="text-center"><?= $item['category_name'] ?></td>
                                            <td class="text-center"><?= $item['exclusivity'] ?></td>
                                            <td class="text-center"><?= $item['sale_status'] ?></td>
                                            <td class="text-center"><?= $item['restriction_status'] ?></td>
                                            <td class="text-center text-nowrap">
                                                <div class="m-0 p-0">
                                                    <a href="./product-view.php?store_id=<?php echo $record['store_id'] . '&product_id=' . $item['product_id'] ?>" type="button" class="btn btn-primary btn-settings-size rounded border-0 fw-semibold text-decoration-none">Details</a>
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
                </main>
            </div>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
    <script src="../js/store-products.datatable.js"></script>
</body>

</html>