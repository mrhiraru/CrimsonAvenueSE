<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/product.class.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Product List | Crimson Avenue";
$product_page = "active";
$products_page = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.admin.php');
    ?>
    <main>
        <div class="container-fluid">
            <div class="row">
                <?php
                require_once('../includes/sidepanel.moderator.php');
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
                            <table id="stores" class="table table-lg mt-1">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col" class="text-center">Product Name</th>
                                        <th scope="col" class="text-center">Store</th>
                                        <th scope="col" class="text-center">Category</th>
                                        <th scope="col" class="text-center">Exclusivity</th>
                                        <th scope="col" class="text-center">Restriction</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    $product = new Product();
                                    $productArray = $product->show_admin();
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
                                            <td class="text-center"><?= $item['store_name'] ?></td>
                                            <td class="text-center"><?= $item['category_name'] ?></td>
                                            <td class="text-center"><?= $item['exclusivity'] ?></td>
                                            <td class="text-center"><?= $item['restriction_status'] ?></td>
                                            <td class="text-center text-nowrap">
                                                <div class="m-0 p-0">
                                                    <a href="./product-view.php?id=<?= $item['product_id'] ?>" type="button" class="btn btn-primary btn-settings-size rounded border-0 fw-semibold text-decoration-none">Details</a>
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
    <script src="../js/stores.datatables.js"></script>
</body>

</html>