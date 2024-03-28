<?php

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