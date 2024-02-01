<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 0) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../classes/college.class.php');

if (isset($_POST['add'])) {
    $college = new College();

    $college->college_name = htmlentities($_POST['col-name']);

    if (validate_field($college->college_name)) {
        if ($college->add()) {
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
$title = "Settings | Crimson Avenue";
$settings_page = "active";
$college = "active";
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
                                <form method="post" action="" class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="input-group mb-2 p-0 col-12">
                                            <input type="text" class="form-control" id="col-name" name="col-name" placeholder="College Name">
                                            <input type="submit" class="btn btn-primary btn-settings-size fw-semibold" id="basic-addon1" name="add" value="Add">
                                        </div>
                                        <?php
                                        if (isset($_POST['col-name']) && !validate_field($_POST['col-name'])) {
                                        ?>
                                            <div class="mb-2 col-auto mb-2 p-0">
                                                <p class="fs-7 text-primary mb-2 ps-2">College name is required.</p>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </form>
                                <div class="search-keyword col-12 col-lg-4 mb-2 p-0">
                                    <div class="input-group">
                                        <input type="text" name="keyword" id="keyword" placeholder="" class="form-control">
                                        <span class="input-group-text text-white bg-primary border-primary btn-settings-size fw-semibold" id="basic-addon1">Search</span>
                                    </div>
                                </div>
                                <table id="colleges" class="table table-lg mt-1">
                                    <thead>
                                        <tr class="align-middle">
                                            <th scope="col"></th>
                                            <th scope="col">College Name</th>
                                            <th scope="col" class="text-center">No of Department</th>
                                            <th scope="col" class="text-center">No of Store</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $semArray = array(
                                            array(
                                                'college_id' => 1,
                                                'name' => 'Computing Studies',
                                                'no_dept' => '2',
                                                'no_store' => '4',
                                            ), array(
                                                'college_id' => 2,
                                                'name' => 'Nursing',
                                                'no_dept' => '0',
                                                'no_store' => '4',
                                            ), array(
                                                'college_id' => 3,
                                                'name' => 'Engineering',
                                                'no_dept' => '6',
                                                'no_store' => '8',
                                            ), array(
                                                'college_id' => 4,
                                                'name' => 'Architecture',
                                                'no_dept' => '0',
                                                'no_store' => '3',
                                            ),
                                        );
                                        ?>
                                        <?php
                                        $counter = 1;
                                        foreach ($semArray as $item) {
                                        ?>
                                            <tr class="align-middle">
                                                <td><?= $counter ?></td>
                                                <td> <?= $item['name'] ?> </td>
                                                <td class="text-center"><?= $item['no_dept'] ?></td>
                                                <td class="text-center"><?= $item['no_store'] ?></td>
                                                <td class="text-center text-nowrap">
                                                    <div class="m-0 p-0">
                                                        <button type="button" data-id="<?= $item['college_id'] ?>" class="btn btn-primary btn-settings-size py-1 px-2 rounded border-0 fw-semibold" id="college-edit">Edit</button>
                                                        <input type="button" class="btn btn-cancel btn-settings-size py-1 px-2 rounded border-0 fw-semibold" name="delete" value="Delete"></input>
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
                    </div>
                </main>
            </div>
        </div>
    </main>
    <!-- semester modal  -->
    <?php
    if (isset($_POST['add']) && $success == 'success') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="./settings.php" class="text-decoration-none text-dark">
                                    <p class="m-0">College has been successfully added! <span class="text-primary fw-bold">Click to Continue</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <?php
    require_once('../includes/js.php');
    ?>
    <script src="../js/colleges.datatable.js"></script>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
        myModal.show()
    </script>
</body>

</html>