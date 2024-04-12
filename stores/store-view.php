<?php 
require_once('../tools/functions.php');
require_once('../classes/store.class.php');

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
        
        <?php if (isset($record['middlename'])) {
                                                echo ucwords(strtolower($record['firstname'] . ' ' . $record['middlename'] . ' ' . $record['lastname']));
                                            } else {
                                                echo ucwords(strtolower($record['firstname'] . ' ' . $record['lastname']));
                                            } ?>

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