<?php 
require_once('../tools/functions.php');
require_once('../classes/store.class.php');
session_start();

$store = new Store();
$record = $store->fetch($_GET['store_id']);

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Store | Crimson Avenue";
$page_name = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto min-vh-100 ">
        <main>
            <div class="container shadow">
                <div class="row ">
                    <div class="col-lg-6 p-5 rounded ">
                        <div class="row bg-maroon py-3 ps-2 ">
                            <div class="col-lg-6  ">
                                <img src="../images/main/profilepic.png" class= " rounded-circle ms-5" width="200px" alt="Cinque Terre">
                            </div>
                            <div class="col-lg-6">
                                <p class="h3 fw-bolder ">CCS IHAWAN</p>
                                <p class="h5">Department</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <p class="h1"></p>
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