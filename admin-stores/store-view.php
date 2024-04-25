<?php
session_start();

require_once('../tools/functions.php');
require_once('../classes/store.class.php');

$store = new Store();
$record = $store->fetch($_GET['id']);

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
} else if (!isset($_GET['id']) || $record['is_deleted'] == 1 || !isset($record['store_id'])) {
    header('location: ./index.php');
}

if (isset($_POST['verification_status'])) {

    $store->verification_status = htmlentities($_POST['verification_status']);
    $store->store_id = $_GET['id'];

    if (validate_field($store->verification_status)) {
        if ($store->update_verification()) {

            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['restriction'])) {

    $store->restriction_status = htmlentities($_POST['restriction']);
    $store->store_id = $_GET['id'];

    if (validate_field($store->restriction_status)) {
        if ($store->update_restriction()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['confirm'])) {

    $store->verification_status = 'Verified';
    $store->registration_status = htmlentities($_POST['registration_status']);
    $store->store_id = $_GET['id'];

    if (validate_field($store->registration_status)) {
        if ($store->update_registration()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Store View | Crimson Avenue";
$stores_page = "active";
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
                require_once('../includes/sidepanel.admin.php')
                ?>
                <main class="col-md-9 col-lg-10 p-4 row m-0 h-100">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3">
                        <div class="row d-flex justify-content-center m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2 btn-group">
                                <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                                    Store Details
                                </p>
                                <p type="button" class="m-0 p-0 text-secondary border-0 bg-white fw-semibold fs-4 lh-1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </p>
                                <ul class="dropdown-menu">
                                    <?php
                                    if ($record['registration_status'] == 'Not Registered') {
                                    ?>
                                        <li>
                                            <button class="dropdown-item border-0 bg-white" data-bs-toggle="modal" data-bs-target="#registrationModal">Confirm Registration</button>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <li>
                                        <button class="dropdown-item border-0 bg-white" data-bs-toggle="modal" data-bs-target="#verificationModal">Update Verfication Status</button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item border-0 bg-white" data-bs-toggle="modal" data-bs-target="#restrictionModal">Update Restriction</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="mb-0">
                            </div>
                            <div class="col-12 col-lg-auto m-0 p-3 d-flex flex-column align-items-center">
                                <img src="<?php if (isset($record['store_profile'])) {
                                                echo "../images/data/" . $record['store_profile'];
                                            } else {
                                                echo "../images/main/no-profile.jpg";
                                            } ?>" alt="" class="profile-size border border-secondary-subtle rounded-2">
                            </div>
                            <div class="col-auto d-none d-lg-block p-0 m-0 border-start"></div>
                            <div class="col-12 col-lg-8 m-0 p-2 d-flex justify-content-start align-items-start flex-fill row">
                                <table class="table-sm m-0">
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Store Name:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['store_name'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Bio:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= nl2br($record['store_bio']) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Administrator:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?php if (isset($record['middlename'])) {
                                                echo ucwords(strtolower($record['firstname'] . ' ' . $record['middlename'] . ' ' . $record['lastname']));
                                            } else {
                                                echo ucwords(strtolower($record['firstname'] . ' ' . $record['lastname']));
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                College:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?php if (!isset($record['college_name'])) {
                                                echo 'Independent (No College)';
                                            } else {
                                                echo $record['college_name'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Store Email:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['store_email'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Contact:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['store_contact'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="pe-3 text-secondary fw-normal">
                                                Location:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['store_location'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Date Established:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= date('F d Y', strtotime($record['is_created'])) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Verification Status:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['verification_status'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Registration Status:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['registration_status'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <span class="text-secondary fw-normal">
                                                Restrictions:
                                            </span>
                                            <br class="d-block d-md-none">
                                            <?= $record['restriction_status'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3">
                        <div class="row d-flex justify-content-center m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-5 fw-bold text-dark lh-1 flex-fill">
                                    Certificate
                                </p>
                                <div class="col-12 m-0 p-0">
                                    <hr class="my-2">
                                </div>
                                <div class="col-12 m-0 p-0 d-flex flex-column align-items-center">
                                    <img src="<?php if (isset($record['certificate'])) {
                                                    echo "../images/data/" . $record['certificate'];
                                                } else {
                                                    echo "../images/main/no-profile.jpg";
                                                } ?>" alt="" class="img-fluid border border-secondary-subtle rounded-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mt-4 p-3" id="orderListContainer">
                        <div class="row d-flex justify-content-center m-0 p-0">
                            <div class="col-12 m-0 p-0 px-2">
                                <p class="m-0 p-0 fs-5 fw-bold text-dark lh-1 flex-fill">
                                    Commission Status
                                </p>
                            </div>
                        </div>
                            <div class="row d-flex justify-content-center m-0 p-0">
                                <div class="col col-12 m-0 p-0 px-2">
                                    <table class="table" id="orderTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order</th>
                                                <th scope="col">Order Status</th>
                                                <th scope="col">Commission</th>                                           
                                                <th scope="col">Commision Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orderTableBody">
                                        <?php
require_once('../classes/order.class.php');
require_once('../classes/database.php');

$order = new Order();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $order->updateCommissionStatusForCompletedOrders();
        echo "Commission status updated successfully.";
    }
}

if (isset($_GET['id'])) {
    $store_id = $_GET['id'];
    $orders = $order->show_order_stat($store_id);
    $total_unpaid_commission = 0;

    if ($orders) {
        foreach ($orders as $orderItem) {
            $updated_order = $order->get_order_by_id($orderItem['order_id']);
            if ($updated_order['order_status'] == 'Completed') {
                if ($updated_order['commission_status'] == 'Unpaid') {
                    $total_unpaid_commission += $updated_order['commission_total'];
                }
?>
                <tr>
                    <th scope='row'><?php echo $updated_order['order_id']; ?></th>
                    <td><?php echo $updated_order['order_status']; ?></td>
                    <td><?php echo number_format($updated_order['commission_total'], 2); ?> ₱</td>
                    <td><?php echo $updated_order['commission_status']; ?></td>
                </tr>
<?php
            }
        }
?>
        <!-- Button row -->
        <tr>
            <td colspan="2" style="text-align: right;">Total Unpaid Commission: ₱</td>
            <td><?php echo number_format($total_unpaid_commission, 2); ?> ₱</td>
            <td colspan="3" style="text-align: ;">
                <form method='post'>
                    <button type='submit' name='update' class="btn btn-primary btn-settings-size rounded border-0 fw-semibold text-decoration-none" <?php echo ($total_unpaid_commission > 0) ? '' : 'disabled'; ?>>Paid</button>
                </form>
            </td>
        </tr>
<?php
    } else {
        echo "<tr><td colspan='4'>No completed orders found for store ID: $store_id</td></tr>";
    }
} else {
    echo "<tr><td colspan='4'>Store ID is not available</td></tr>";
}
?>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    
    <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header py-2 px-3">
                    <h1 class="modal-title fs-6 text-primary" id="exampleModalLabel">Update Verification Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <form action="./store-view.php?id=<?= $record['store_id'] ?>" method="post" class="col-12 m-0" name="verificationForm" id="verificationForm">
                                <div class="form-group m-0 p-0 d-flex row justify-content-evenly">
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="verification_status" id="verified" value="Verified" onchange="autoSubmitRole()" <?php if ($record['verification_status'] == 'Verified') {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            } ?>>
                                        <label class="form-check-label" for="verified">
                                            Verified
                                        </label>
                                    </div>
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="verification_status" id="notverified" value="Not Verified" onchange="autoSubmitRole()" <?php if ($record['verification_status'] == 'Not Verified') {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>>
                                        <label class="form-check-label" for="notverified">
                                            Not Verified
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header py-2 px-3">
                    <h1 class="modal-title fs-6 text-primary" id="exampleModalLabel">Registration</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <form action="./store-view.php?id=<?= $record['store_id'] ?>" method="post" class="col-12 m-0" name="registrationForm" id="registrationForm">
                                <div class="form-group m-0 p-0 d-flex row justify-content-evenly">
                                    <div class="col-auto m-0 p-0">
                                        <input type="hidden" name="registration_status" value="Registered">
                                        <p class="m-0 text-dark fs-7 mb-2">Press the button to confirm registration!</p>
                                        <input type="submit" name="confirm" value="Confirm" class="btn btn-primary fw-bold">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="restrictionModal" tabindex="-1" aria-labelledby="restrictionModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2 px-3">
                    <h1 class="modal-title fs-6 text-primary" id="exampleModalLabel">Update Restriction</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-12 text-center">
                            <form action="./store-view.php?id=<?= $record['store_id'] ?>" method="post" class="col-12 m-0" name="accRestriction" id="accRestriction">
                                <div class="form-group m-0 p-0 row d-flex justify-content-evenly">
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="restriction" id="unrestricted" value="Unrestricted" onchange="autoSubmitRestriction()" <?php if ($record['restriction_status'] == "Unrestricted") {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>>
                                        <label class="form-check-label" for="unrestricted">
                                            Unrestricted
                                        </label>
                                    </div>
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="restriction" id="temporary" value="Restricted" onchange="autoSubmitRestriction()" <?php if ($record['restriction_status'] == "Restricted") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                        <label class="form-check-label" for="temporary">
                                            Restrict
                                        </label>
                                    </div>
                                    <div class="col-auto m-0 p-0">
                                        <input class="form-check-input" type="radio" name="restriction" id="permanent" value="Terminated" onchange="autoSubmitRestriction()" <?php if ($record['restriction_status'] == "Terminated") {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                        <label class="form-check-label" for="permanent">
                                            Terminate
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['verification_status']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a class="text-decoration-none text-dark" href="./store-view.php?id=<?= $record['store_id'] ?>">
                                    <p class="m-0">Verification status has been updated successfully!</br><span class="text-primary fw-bold">Click to continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['restriction']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a class="text-decoration-none text-dark" href="./store-view.php?id=<?= $record['store_id'] ?>">
                                    <p class="m-0">Restriction has been updated successfully!</br><span class="text-primary fw-bold">Click to continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($_POST['confirm']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a class="text-decoration-none text-dark" href="./store-view.php?id=<?= $record['store_id'] ?>">
                                    <p class="m-0">Store registration has been confirmed successfully!</br><span class="text-primary fw-bold">Click to continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     


        





    <?php
    }
    require_once('../includes/js.php');
    ?>
    <script>
        function autoSubmitRole() {
            var formObject = document.forms['verificationForm'];
            formObject.submit();
        }

        function autoSubmitRestriction() {
            var formObject = document.forms['accRestriction'];
            formObject.submit();
        }
    </script>
</body>

</html>