<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role'])) {
    header('location: ../index.php');
}

require_once "../tools/functions.php";
require_once "../classes/store.class.php";

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
    <div class="container-fluid col-md-9 my-4 mx-sm-auto">
        <main>
            <div class="container-fluid bg-white shadow rounded m-0 p-3">
                <div class="row d-flex justify-content-between m-0 p-0">
                    <div class="col-12 m-0 p-0">
                        <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1">Profile</p>
                    </div>
                    <div class="col-12 col-lg-auto m-0 p-3 d-flex flex-column justify-content-center align-items-center">
                        <img src="<?php if (isset($_SESSION['profile_image'])) {
                                        echo "../images/data/" . $_SESSION['profile_image'];
                                    } else {
                                        echo "../images/main/no-profile.jpg";
                                    } ?>" alt="" class="profile-size border border-secondary-subtle rounded-2">
                    </div>
                    <div class="col-auto d-none d-lg-block p-0 m-0 border-start"></div>
                    <div class="col-12 col-lg-auto m-0 p-3 d-flex justify-content-start align-items-start flex-fill row">

                        <table class="table table-sm border-top m-0">
                            <tr>
                                <td class=" pe-3 text-secondary d-none d-md-block">Name</td>
                                <td class="fw-semibold text-dark ps-3"><?= $_SESSION['full_name'] ?></td>
                            </tr>
                            <tr>
                                <td class=" pe-3 text-secondary d-none d-md-block">Gender</td>
                                <td class="fw-semibold text-dark ps-3"><?= $_SESSION['gender'] ?></td>
                            </tr>
                            <tr>
                                <td class=" pe-3 text-secondary d-none d-md-block">Affiliation</td>
                                <td class="fw-semibold text-dark ps-3"><?= $_SESSION['affiliation'] ?></td>
                            </tr>
                            <tr>
                                <td class=" pe-3 text-secondary d-none d-md-block">College</td>
                                <td class="fw-semibold text-dark ps-3"><?php if (isset($_SESSION['college_name'])) {
                                                                            echo $_SESSION['college_name'];
                                                                        } else {
                                                                            echo "No College";
                                                                        } ?></td>
                            </tr>
                            <tr>
                                <td class=" pe-3 text-secondary d-none d-md-block">Department</td>
                                <td class="fw-semibold text-dark ps-3"><?php if (isset($_SESSION['department_name'])) {
                                                                            echo $_SESSION['department_name'];
                                                                        } else {
                                                                            echo "No Department";
                                                                        }  ?></td>
                            </tr>
                            <tr>
                                <td class=" pe-3 text-secondary d-none d-md-block">Email</td>
                                <td class="fw-semibold text-dark ps-3"><?= $_SESSION['email'] ?> <span class="text-primary fw-semibold float-end"><?= $_SESSION['verification_status'] ?></span></td>
                            </tr>
                            <tr>
                                <td class=" pe-3 text-secondary d-none d-md-block">Contact</td>
                                <td class="fw-semibold text-dark ps-3"><?= $_SESSION['contact'] ?></td>
                            </tr>
                            <tr>
                                <td class=" pe-3 text-secondary d-none d-md-block">Address</td>
                                <td class="fw-semibold text-dark ps-3"><?php if (isset($_SESSION['address'])) {
                                                                            echo $_SESSION['address'];
                                                                        } else {
                                                                            echo "No Address";
                                                                        } ?> </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <section id="#MyStores">
            <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                <div class="row d-flex justify-content-between m-0 p-0">
                    <div class="col-6 m-0 p-0">
                        <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1">Stores</p>
                    </div>
                    <?php
                    if (isset($_SESSION['affiliation']) && $_SESSION['affiliation'] != 'Non-student') {
                    ?>
                        <div class="col-6 m-0 p-0 text-end">
                            <a href="./registration.php" class="text-primary fw-semibold fs-6">Register Store</a>
                        </div>
                    <?php
                    }
                    ?>
                    <table id="stores" class="table table-lg mt-1">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col" class="text-center">Store Name</th>
                                <th scope="col" class="text-center">Role</th>
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
                                    <td class="text-center text-nowrap">
                                        <div class="m-0 p-0">
                                            <a href="../store/index.php?store_id=<?= $item['store_id'] ?>" type="button" class="text-primary border-0 fw-semibold text-decoration-none">Enter Store</a>
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
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>