<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role'])) {
    header('location: ../index.php');
}

require_once "../tools/functions.php";
require_once "../classes/store.class.php";
require_once "../classes/order.class.php";
require_once "../classes/account.class.php";

$store = new Account();
$record = $store->fetch($_SESSION['account_id']);


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
    <div class="container-fluid col-md-9 my-4 mx-sm-auto min-vh-75">
        <main>
            <div class="container-fluid bg-white shadow rounded m-0 p-3">
                <div class="row d-flex justify-content-center m-0 p-0">
                    <div class="col-12 m-0 p-0 px-2 btn-group">
                      <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
                        Edit Profile
                      </p>
                    </div>
                    <div class="col-12 m-0 p-0">
                      <hr class="mb-0">
                    </div>
                    <div class="col-12 col-lg-auto m-0 p-2 d-flex justify-content-start align-items-start flex-fill row">
                    <?php
                        require_once('../classes/college.class.php');
                        require_once('../classes/department.class.php');


                        if (isset($_POST['edit_account'])) {

                            $firstname = $_POST['firstname'];
                            $middlename = $_POST['middlename'];
                            $lastname = $_POST['lastname'];
                            $gender = $_POST['gender'];
                            $college_id = $_POST['college_id'];
                            $department_id = $_POST['department_id'];
                            $contact = $_POST['contact'];
                            $address = $_POST['address'];
                            $account = new Account();
                            $data = array(
                                'firstname' => $firstname,
                                'middlename' => $middlename,
                                'lastname' => $lastname,
                                'gender' => $gender,
                                'college_id' => $college_id,
                                'department_id' => $department_id,
                                'contact' => $contact,
                                'address' => $address
                            );
                            if ($account->update($_SESSION['account_id'], $data)) {
                                echo "User data updated successfully.";
                            } else {
                                echo "Error: Failed to update user data.";
                            }
                        }
                        ?>

                        <form method="post" action="" class="col-12" enctype="multipart/form-data">
                            <table class="table-sm m-0 w-100">
                                <tr>
                                    <td class=" row fw-semibold text-dark">
                                        <div class="col-12 col-md-4">
                                            <span class="text-secondary fw-normal">
                                                First Name:
                                            </span>
                                            <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="firstname" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : $record['firstname'] ?>">
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <span class="text-secondary fw-normal">
                                                Middle Name: *
                                            </span>
                                            <input type="text" class="form-control" id="middlename" name="middlename" aria-describedby="middlename" value="<?= isset($_POST['middlename']) ? $_POST['middlename'] : $record['middlename'] ?>">
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <span class="text-secondary fw-normal">
                                                Last Name:
                                            </span>
                                            <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastname" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : $record['lastname'] ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-dark">
                                        <span class="text-secondary fw-normal">
                                            Gender:
                                        </span>
                                        <div class="d-flex justify-content-center justify-content-md-start">
                                            <div class="form-check me-3">
                                                <input type="radio" class="form-check-input" id="male" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Male') { 
                                                                                                                        echo 'checked'; 
                                                                                                                    } else if(isset($record['gender']) && $record['gender'] == 'Male'){ 
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input type="radio" class="form-check-input" id="female" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Female') { 
                                                                                                                            echo 'checked'; 
                                                                                                                        } else if(isset($record['gender']) && $record['gender'] == 'Female'){ 
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input type="radio" class="form-check-input" id="other" name="gender" value="Other" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Other') { 
                                                                                                                            echo 'checked'; 
                                                                                                                        } else if(isset($record['gender']) && $record['gender'] == 'Other'){ 
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                                <label class="form-check-label" for="other">Other</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-dark">
                                        <span class="text-secondary fw-normal">
                                            College:
                                        </span>
                                        <div class="col-12 col-md-6">
                                            <select name="college_id" id="college_id" class="form-select" required>
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
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-dark">
                                        <span class="text-secondary fw-normal">
                                            Department:
                                        </span>
                                        <div class="col-12 col-md-6">
                                            <select name="department_id" id="department_id" class="form-select" required>
                                                <option value=""></option>
                                                <?php
                                                $department = new Department();
                                                $departmentArray = $department->show();
                                                foreach ($departmentArray as $item) { ?>
                                                    <option value="<?= $item['department_id'] ?>" <?php if ((isset($_POST['department_id']) && $_POST['department_id'] == $item['department_id'])) {
                                                                                                    echo 'selected';
                                                                                                } else if ((isset($record['department_id']) && $record['department_id'] == $item['department_id'])) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= $item['department_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-dark">
                                        <span class="text-secondary fw-normal">
                                            Contact:
                                        </span>
                                        <div class="col-12 col-md-6">
                                            <input type="text" class="form-control" id="contact" placeholder="+63" name="contact" aria-describedby="contact" value="<?= isset($_POST['contact']) ? $_POST['contact'] : $_SESSION['contact'] ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-dark">
                                        <span class="pe-3 text-secondary fw-normal">
                                            Address:
                                        </span>
                                        <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" id="address" name="address" aria-describedby="address" value="<?= isset($_POST['address']) ? $_POST['address'] : $_SESSION['address'] ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-dark">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" name="edit_account" class="btn btn-danger">Submit</button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php
    require_once('../includes/footer.php');
    require_once('../includes/js.php');
    ?>
    <script src="../js/order.datatable.js"></script>
</body>

</html>