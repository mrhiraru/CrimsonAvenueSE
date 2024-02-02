<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/moderator.class.php');
require_once('../classes/college.class.php');

$moderator = new Moderator();
if (isset($_POST['add'])) {
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Settings | Crimson Avenue";
$settings_page = "active";
$moderator_page = "active";
require_once('../includes/head.php');
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
                <main class="col-md-9 col-lg-10 p-4">
                    <div class="row m-0 p-0 h-100">
                        <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                            <div class="row h-auto d-flex justify-content-between m-0 p-0">
                                <form method="post" action="" class="col-12 col-lg-7">
                                    <div class="row">
                                        <div class="input-group mb-2 p-0 col-12">
                                            <?php
                                            if (isset($_POST['edit']) || isset($_POST['save'])) {
                                            ?>
                                                <select id="acc-id" name="acc-id" class="form-select">
                                                    <option value="">Select Moderator</option>
                                                    <?php
                                                    $moderatorArray = $moderator->show_mod();
                                                    foreach ($moderatorArray as $item) { ?>
                                                        <option value="<?= $item['account_id'] ?>"><?= $item['firstname'] . ' ' . $item['lastname'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <select id="col-id" name="col-id" class="form-select">
                                                    <option value="">Select College</option>
                                                </select>
                                                <input type="submit" class="btn btn-primary-opposite btn-settings-size fw-semibold" id="basic-addon1" name="cancel" value="Cancel">
                                                <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="save" value="Save">
                                            <?php
                                            } else {
                                            ?>
                                                <select id="acc-id" name="acc-id" class="form-select">
                                                    <option value="">Select Moderator</option>
                                                    <?php
                                                    $moderatorArray = $moderator->show_mod();
                                                    foreach ($moderatorArray as $item) { ?>
                                                        <option value="<?= $item['account_id'] ?>"><?php if(isset($item['middlename'])) { echo $item['firstname'].' '.$item['middlename'].' '.$item['lastname']; } else { echo $item['firstname'].' '.$item['lastname']; } ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <select id="col-id" name="col-id" class="form-select">
                                                    <option value="">Select College</option>
                                                    <?php 
                                                    $college = new College();
                                                    $collegeArray = $college->show();
                                                    foreach($collegeArray as $item) {
                                                        ?>
                                                            <option value="<?= $item['college_id'] ?>"><?= $item['college_name'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon2" name="add" value="Assign">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="search-keyword col-12 col-lg-4 mb-2 p-0">
                                    <div class="input-group">
                                        <input type="text" name="keyword" id="keyword" placeholder="" class="form-control">
                                        <span class="input-group-text text-white bg-primary border-primary btn-settings-size fw-semibold" id="basic-addon1">Search</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>

    <?php
    require_once('../includes/js.php');
    ?>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
        myModal.show()
    </script>
</body>

</html>