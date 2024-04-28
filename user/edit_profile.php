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


if(isset($_GET['account_id'])){
    $account = new Account();
    $record = $account->fetch($_GET['account_id']);
    $account->firstname = $record['firstname'];
    $account->lastname = $record['lastname'];
    $account->middlename = $record['middlename'];
    $account->gender = $record['gender'];
    $account->contact = $record['contact'];
    $account->address = $record['address'];

    $account->account_id = $_GET['account_id'];
}

if (isset($_POST['edit_account'])) {
    try {
      $account = new Account();
      //sanitize
      $account->account_id = $_GET['account_id'];
      $account->firstname = htmlentities($_POST['firstname']);
      $account->lastname = htmlentities($_POST['lastname']);
      $account->middlename = htmlentities($_POST['middlename']);
  
      if (empty($errors)) {
        if ($account->edit()) {
          $redirect_url = isset($_GET['account_id']) ? "./profile.php?account_id={$_GET['account_id']}" : "./profile.php";
          header("Location: $redirect_url");
          $message = 'Profile successfully edited.';
          exit;
        } else {
          $message = 'Something went wrong editiong profile.';
        }
      } else {
        throw new Exception(implode('<br>', $errors));
      }
    } catch (Exception $e) {
      $error_message = $e->getMessage();
    }
  }
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
                        <form action="#" method="post">
                            <table class="table-sm m-0 w-100">
                                <tr>
                                    <td class=" row fw-semibold text-dark">
                                        <div class="col-12 col-md-4">
                                            <span class="text-secondary fw-normal">
                                                First Name:
                                            </span>
                                            <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="firstname" value="<?php if (isset($_POST['firstname'])) {
                                                                                                                                                                echo $_POST['firstname'];
                                                                                                                                                              } else if (isset($account->firstname)) {
                                                                                                                                                                echo $account->firstname;
                                                                                                                                                              } ?>">
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <span class="text-secondary fw-normal">
                                                Middle Name: *
                                            </span>
                                            <input type="text" class="form-control" id="middlename" name="middlename" aria-describedby="middlename" value="<?php if (isset($_POST['middlename'])) {
                                                                                                                                                                   echo $_POST['middlename'];
                                                                                                                                                                 } else if (isset($account->middlename)) {
                                                                                                                                                                   echo $account->middlename;
                                                                                                                                                                 } ?>">
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <span class="text-secondary fw-normal">
                                                Last Name:
                                            </span>
                                            <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastname" value="<?php if (isset($_POST['lastname'])) {
                                                                                                                                                             echo $_POST['lastname'];
                                                                                                                                                           } else if (isset($account->lastname)) {
                                                                                                                                                             echo $account->lastname;
                                                                                                                                                           } ?>">
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
                                                                                                                                                     } else if(isset($account->gender) && $account->gender == 'Male'){ 
                                                                                                                                                        echo 'checked';
                                                                                                                                                     } ?>>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input type="radio" class="form-check-input" id="female" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Female') { 
                                                                                                                                                        echo 'checked'; 
                                                                                                                                                     } else if(isset($account->gender) && $account->gender == 'Female'){ 
                                                                                                                                                        echo 'checked';
                                                                                                                                                     } ?>>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input type="radio" class="form-check-input" id="other" name="gender" value="Other" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Other') { 
                                                                                                                                                        echo 'checked'; 
                                                                                                                                                     } else if(isset($account->gender) && $account->gender == 'Other'){ 
                                                                                                                                                        echo 'checked';
                                                                                                                                                     } ?>>
                                                <label class="form-check-label" for="other">Other</label>
                                            </div>
                                        </div>
                                        <?php
                                            if((!isset($_POST['availability']) && isset($_POST['save'])) || (isset($_POST['availability']) && !validate_field($_POST['availability']))){
                                        ?>
                                                <p class="text-danger my-1">Select availability of the product</p>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-dark">
                                        <span class="text-secondary fw-normal">
                                            College:
                                        </span>
                                        <div class="col-12 col-md-6">
                                            <select type="button" class="dropdown-toggle form-select" data-bs-toggle="dropdown" id="college" name="college">
                                                <!-- <option value="">Select Rank</option> -->
                                                <option value="College of Computer Science" <?php if(isset($_POST['college']) && $_POST['college'] == 'College of Computer Science') { echo 'selected'; } else if(isset($account->college) && $account->college == 'College of Computer Science'){ echo 'selected'; } ?>>College of Computer Science</option>
                                                <option value="Ikaw na to" <?php if(isset($_POST['college']) && $_POST['college'] == 'Ikaw na to') { echo 'selected'; } else if(isset($account->college) && $account->college == 'Ikaw na to'){ echo 'selected'; } ?>>Ikaw na to</option>
                                                <option value="maglagay Dito" <?php if(isset($_POST['college']) && $_POST['college'] == 'maglagay Dito') { echo 'selected'; } else if(isset($account->college) && $account->college == 'maglagay Dito'){ echo 'selected'; } ?>>maglagay Dito</option>
                                                <option value="Laman HEHE" <?php if(isset($_POST['college']) && $_POST['college'] == 'Laman HEHE') { echo 'selected'; } else if(isset($account->college) && $account->college == 'Laman HEHE'){ echo 'selected'; } ?>>Laman HEHE</option>
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
                                            <select type="button" class="dropdown-toggle form-select" data-bs-toggle="dropdown" id="department" name="department">
                                                <!-- <option value="">Select Rank</option> -->
                                                <option value="Information Techonology" <?php if(isset($_POST['department']) && $_POST['department'] == 'Information Techonology') { echo 'selected'; } else if(isset($account->department) && $account->department == 'Information Techonology'){ echo 'selected'; } ?>>Information Techonology</option>
                                                <option value="Computer Science" <?php if(isset($_POST['department']) && $_POST['department'] == 'Computer Science') { echo 'selected'; } else if(isset($account->department) && $account->department == 'Computer Science'){ echo 'selected'; } ?>>Computer Science</option>
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
                                            <input type="text" class="form-control" id="contact" placeholder="+63" name="contact" aria-describedby="contact" value="<?= $_SESSION['contact'] ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-dark">
                                        <span class="pe-3 text-secondary fw-normal">
                                            Address:
                                        </span>
                                        <div class="col-12 col-md-6">
                                        <input type="text" class="form-control" id="address" name="address" aria-describedby="address" value="<?= $_SESSION['address'] ?>">
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