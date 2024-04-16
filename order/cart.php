<?php
session_start();
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
                    <div class="row m-0 p-0 px-3">
                        <p class="m-0 p-0 fs-6 fw-bold text-dark lh-1">Store Name</p>
                        <table id="products" class="table table-lg my-1">
                            <tbody>
                                <tr class="">
                                    <td class="border-0">checkbox</td>
                                    <td class="border-0">Image</td>
                                    <td class="border-0">Name</td>
                                    <td class="border-0">Variation</td>
                                    <td class="border-0">Measurement</td>
                                    <td class="border-0">quantity</td>
                                    <td class="border-0">Price</td>
                                    <td class="border-0">Subtotal</td>
                                    <td class="border-0 text-end">Action</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="m-0 p-0 fs-6 text-dark lh-1">
                            Total Price: 24353.00
                            <span class="float-end">Checkout Button</span>
                        </p>
                    </div>
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
</body>

</html>