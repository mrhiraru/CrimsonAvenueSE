<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1 || !isset($_SESSION['college_assigned'])) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/store.class.php');

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Registrations | Crimson Avenue";
$stores_page = "active";
$registration_page = "active";
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
                            <table id="registrations" class="table table-lg mt-1">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col"></th>
                                        <th scope="col" class="text-center">Store Name</th>
                                        <th scope="col" class="text-center">Administrator</th>
                                        <th scope="col" class="text-center">College</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    $store = new Store();
                                    $storeArray = $store->show_registration_moderator($_SESSION['college_assigned']);
                                    foreach ($storeArray as $item) {
                                    ?>
                                        <tr class="align-middle">
                                            <td><?= $counter ?></td>
                                            <td class="text-center"><?= $item['store_name'] ?></td>
                                            <td class="text-center"><?php if (isset($item['middlename'])) {
                                                                        echo ucwords(strtolower($item['firstname'] . ' ' . $item['middlename'] . ' ' . $item['lastname']));
                                                                    } else {
                                                                        echo ucwords(strtolower($item['firstname'] . ' ' . $item['lastname']));
                                                                    } ?></td>
                                            <td class="text-center"><?php if (!isset($item['college_name'])) {
                                                                        echo 'Independent';
                                                                    } else {
                                                                        echo $item['college_name'];
                                                                    } ?></td>
                                            <td class="text-center text-nowrap">
                                                <div class="m-0 p-0">
                                                    <a href="./store-view.php?id=<?= $item['store_id'] ?>" type="button" class="btn btn-primary rounded border-0 fw-semibold text-decoration-none">View Details</a>
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
    <script src="../js/registrations.datatable.js"></script>
</body>

</html>