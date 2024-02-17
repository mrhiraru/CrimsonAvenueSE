<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "User Profile | Crimson Avenue";
$user_profile = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto">
        <main>
            <div class="container-fluid bg-white shadow rounded m-0 p-3">
                <div class="row d-flex justify-content-between m-0 p-0">
                    <div class="col-12 col-lg-auto m-0 p-3 d-flex flex-column justify-content-center align-items-center">
                        <img src="<?php if (isset($record['profile_image'])) {
                                        echo "../images/data/" . $record['profile_image'];
                                    } else {
                                        echo "../images/main/no-profile.jpg";
                                    } ?>" alt="" class="profile-size border border-secondary-subtle rounded-2">
                    </div>
                    <div class="col-auto d-none d-lg-block p-0 m-0 border-start"></div>
                    <div class="col-12 col-lg-auto m-0 p-3 d-flex justify-content-start align-items-start flex-fill row">

                        <table class="table table-sm border-top m-0">
                            <tr>
                                <td class=" pe-3 text-secondary d-none d-md-block">Name</td>
                                <td class="fw-semibold text-dark ps-3"><?= $_SESSION['name'] ?></td>
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
        <section>
            <!-- Code Here Extra Section -->
        </section>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>