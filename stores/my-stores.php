<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['affiliation'] == 'Non-student') {
    header('location: ../stores/stores.php');
}

require_once "../tools/functions.php";
require_once "../classes/store.class.php";

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "My Stores | Crimson Avenue";
$my_stores = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 my-4 mx-sm-auto">
        <main>
            <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                <div class="row d-flex justify-content-between m-0 p-0">
                    <div class="col-6 m-0 p-0">
                        <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1">My Stores</p>
                    </div>

                    <div class="col-6 m-0 p-0 text-end">
                        <a href="./registration.php" class="text-primary fw-semibold fs-6">Register Store</a>
                    </div>
                    <table id="mystores" class="table table-lg mt-1">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col" class="text-center">Store Name</th>
                                <th scope="col" class="text-center">Role</th>
                                <th scope="col" class="text-center">Verification Status</th>
                                <th scope="col" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $store = new Store();
                            $storeArray = $store->show_mystores($_SESSION['account_id']);
                            foreach ($storeArray as $item) {
                            ?>
                                <tr class="align-middle">
                                    <td><?= $counter ?></td>
                                    <td> <img src="<?php if (isset($item['profile_image'])) {
                                                        echo "../images/data/" . $item['profile_image'];
                                                    } else {
                                                        echo "../images/main/no-profile.jpg";
                                                    } ?>" alt="" class="profile-list-size border border-secondary-subtle rounded-1"> </td>
                                    <td class="text-center"><?= $item['store_name'] ?></td>
                                    <td class="text-center"><?php if ($item['staff_role'] == 0) {
                                                                echo 'Administrator';
                                                            } else if ($item['staff_role'] == 1) {
                                                                echo 'Moderator';
                                                            } else if ($item['staff_role'] == 2) {
                                                                echo 'Courier';
                                                            } ?></td>
                                    <td class="text-center"><?= $item['verification_status'] ?></td>
                                    <td class="text-center text-nowrap">
                                        <div class="m-0 p-0">
                                            <a href="../store/index.php?store_id=<?= $item['store_id'] ?>" type="button" class="text-primary border-0 fw-semibold text-decoration-none">Store Panel</a>
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
    <?php
    require_once('../includes/js.php');
    ?>
    <script src="../js/mystores.datatables.js"></script>
</body>

</html>