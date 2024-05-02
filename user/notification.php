<!DOCTYPE html>

<html lang="en">
<?php
session_start();
// Change title for each page.
$title = "Notification | Crimson Avenue";
$page_name = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
include_once('../classes/order.class.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto min-vh-100 ">
        <main class="col-md-9 pt-3 mx-sm-auto col-lg-10 p-md-4">
            <div class="container-fluid mb-3 p-3 bg-white shadow rounded">
                <div class="row h-auto mb-4 d-flex justify-content-center">
                    <div class="row m-0 p-0 d-flex align-items-center">
                        <div class="col-6 m-0 p-0">
                            <p class="m-3 p-0 fs-3 fw-bold text-primary lh-1">Notification</p>
                        </div>

                    </div>
                    <hr class="text-secondary">
                    <!-- datatable start -->
                    <div class="table-responsive overflow-hidden">
                        <table id="messagebox" class="table table-sm">
                            <thead>
                                <tr class="align-middle">
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                               

                               








                            </tbody>
                        </table>
                    </div>
                    <!-- datatable end -->
                </div>
            </div>
    </div>
    </main>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
</body>

</html>