<?php
session_start();

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/image.class.php";
require_once "../classes/college.class.php";

$store = new Store();
$record = $store->fetch_info($_GET['store_id'], $_SESSION['account_id']);


if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ../user/verify.php');
} else if (!isset($record['store_id']) || $record['is_deleted'] == 1 || !isset($record['staff_role'])) {
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Store Information | Crimson Avenue";
$settingsindex_page = "active";
$settings_page = "active";
require_once('../includes/head.php');
include_once('../includes/preloader.php');
?>

<body>
    <?php
    require_once('../includes/header.store.php');

    ?>
    <main>
        <div class="container-fluid">
            <div class="row">
                <?php
                require_once('../includes/sidepanel.store.php');
                ?>
                <main class="col-md-9 col-lg-10 p-4 row m-0 h-100">
                    <div class="container-fluid bg-white shadow rounded m-0 mb-3 p-3">
                        <div class="row d-flex justify-content-start m-0 p-0">
                            <div class="col-12 m-0 p-0 px-1">
                                <p class="m-0 p-0 fs-5 fw-medium text-dark lh-1 flex-fill">
                                    Store Information
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="my-2">
                            </div>
                            <form method="post" action="" class="col-12">
                                <div class="row">
                                    <div class="mb-2 p-0 pe-md-2 col-12 col-md-6">
                                        <span class="m-1">Store Name:</span>
                                        <input type="text" class="form-control" id="store_name" name="store_name" required value="<?= isset($_POST['store_name']) ? $_POST['store_name'] : $record['store_name'] ?>">
                                        <?php
                                        if (isset($_POST['store_name']) && !validate_field($_POST['store_name'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Store name is required.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-2 p-0 pe-md-2 col-12 col-md-6">
                                        <span class="m-1">College:</span>
                                        <select name="college_id" id="college_id" class="form-select">
                                            <option value=""></option>
                                            <?php
                                            $college = new College();
                                            $collegeArray = $college->show();
                                            foreach ($collegeArray as $item) { ?>
                                                <option value="<?= $item['college_id'] ?>" <?php if ((isset($_POST['college_id']) && $_POST['college_id'] == $item['college_id'])) {
                                                                                                echo 'selected';
                                                                                            } else if ((isset($record['college_id']) && $record['college_id'] == $item['college_id'])) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= $item['college_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-2 p-0 pe-md-2 col-12">
                                        <label for="store_bio" class="form-label m-1">Store Bio:</label>
                                        <textarea id="store_bio" name="store_bio" rows="4" cols="50" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-2 p-0 pe-md-2 col-12 col-md-6">
                                        <span class="m-1">Store Email:</span>
                                        <input type="text" class="form-control" id="store_email" name="store_email" required value="<?= isset($_POST['store_email']) ? $_POST['store_email'] : $record['store_email'] ?>">
                                        <?php
                                        if (isset($_POST['store_email']) && !validate_field($_POST['store_email'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Store email is required.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-2 p-0 pe-md-2 col-12 col-md-6">
                                        <span class="m-1">Store Contact:</span>
                                        <input type="tel" pattern="09\d{9}" maxlength="11" name="store_contact" id="store_contact" class="form-control" onfocus="if(this.value==='') this.value='09';" oninput="validateinput(this)" value="<?= isset($_POST['store_contact']) ? $_POST['store_contact'] : $record['store_contact'] ?>">
                                        <?php
                                        if (isset($_POST['store_contact']) && !validate_field($_POST['store_contact'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Store contact number is required.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-2 p-0 pe-md-2 col-12 col-md-6">
                                        <span class="m-1">Store Location:</span>
                                        <input type="text" class="form-control" id="store_location" name="store_location" required value="<?= isset($_POST['store_location']) ? $_POST['store_location'] : $record['store_location'] ?>">
                                        <?php
                                        if (isset($_POST['store_location']) && !validate_field($_POST['store_location'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Store location is required.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-2 p-0 pe-md-2 col-12 col-md-6">
                                        <span class="m-1">Business Time:</span>
                                        <input type="text" class="form-control" id="business_time" name="business_time" required value="<?= isset($_POST['business_time']) ? $_POST['business_time'] : $record['business_time'] ?>">
                                        <?php
                                        if (isset($_POST['business_time']) && !validate_field($_POST['business_time'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Business time is required.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3 p-0 pe-md-2 col-12 text-end">
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-settings-size" name="save-info" value="Save">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="container-fluid bg-white shadow rounded m-0 mb-3 p-3">
                        <div class="row d-flex justify-content-start m-0 p-0">
                            <div class="col-12 m-0 p-0 px-1">
                                <p class="m-0 p-0 fs-5 fw-medium text-dark lh-1 flex-fill">
                                    Delivery
                                </p>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <hr class="my-2">
                            </div>
                            <form method="post" action="" class="col-12">
                                <div class="row">
                                    <div class="mb-2 p-0 pe-md-2 col-12 col-md-6 col-lg-4">
                                        <span for="delivery_charge" class="form-label m-1">Delivery Charge:</span>
                                        <input type="number" class="form-control" id="deliver_fee" name="deliver_fee" require step="any" oninput="negativetozero(this)" value="<?= isset($_POST['delivery_charge']) ? $_POST['delivery_charge'] : $record['delivery_charge'] ?>">
                                        <?php
                                        if (isset($_POST['delivery_charge']) && !validate_field($_POST['delivery_charge'])) {
                                        ?>
                                            <p class="fs-7 text-primary m-0 ps-2">Delivery fee is required.</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3 p-0 pe-md-2 col-12 col-md-6 col-lg-8 text-end">
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-settings-size" name="save-delivery" value="Save">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>