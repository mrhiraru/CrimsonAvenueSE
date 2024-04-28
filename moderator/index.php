<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
} else if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
    header('location: ../index.php');
}

require_once('../tools/functions.php');
require_once('../tools/functions.php');
require_once('../classes/semester.class.php');
require_once('../classes/college.class.php');
require_once('../classes/account.class.php');
require_once('../classes/store.class.php');
require_once('../classes/product.class.php');
require_once('../classes/category.class.php');
require_once('../classes/admin-settings.class.php');
require_once('../classes/department.class.php');
require_once('../classes/order.class.php');
require_once('../classes/moderator.class.php');

$sem = new Semester();
$current_sem = $sem->fetch();
if (isset($current_sem['semester_id'])) {
    $current_date = date('Y-m-d');
    $current_sem_date = date('Y-m-d', strtotime($current_sem['end_date']));

    $current = new DateTime($current_date);
    $current_enddate = new DateTime($current_sem_date);

    if ($current > $current_enddate) {
        if ($sem->semester_ended($current_sem['semester_id'])) {
            $sem_check = "Ended";
        }
    }
} else {
    $sem_check = "No Sem";
}

?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Admin Dashboard | Crimson Avenue";
$admin_page = "active";
$dashboard_page = "active";
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
                require_once('../includes/sidepanel.admin.php');
                ?>
                <main class="col-md-9 col-lg-10 p-4 row m-0">
                    <div class="container-fluid bg-white shadow rounded m-0 p-3 h-100">
                        <div class="row h-auto d-flex justify-content-center m-0 p-0">
                            <?php
                            $data = $sem->fetch_db();
                            ?>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                <a href="../admin-settings/index.php" class=" text-decoration-none">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Semester:</p>
                                                <?php
                                                if (!empty($data)) {
                                                    echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">' . $data['semester_number'] . '</p>';
                                                } else {
                                                    echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">No data available</p>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                <div class="card shadow border-0 mb-3">
                                    <div class="card-body d-flex flex-column">
                                        <div class="row m-0 h-100">
                                            <p class="col-12 m-0 fw-semibold fs-4 text-primary">School Year:</p>
                                            <?php

                                            if (!empty($data)) {
                                                echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">' . date('F d Y', strtotime($data['start_date'])) . ' - ' . date('F d Y', strtotime($data['end_date'])) . '</p>';
                                            } else {
                                                echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">No data available</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                <a href="../admin-settings/college.php" class=" text-decoration-none">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">College:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">
                                                    college name assigned

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>



                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                <a href="../admin-users/index.php" class=" text-decoration-none">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total Number of User:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">
                                                    <?php
                                                    $acc = new Account();
                                                    $countResult = $acc->count();


                                                    if (!empty($countResult) && count($countResult) === 1) {

                                                        $totalCount = $countResult[0][0];
                                                        echo $totalCount;
                                                    } else {
                                                        echo "Error: Unable to fetch total count of User.";
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                <a href="../admin-stores/index.php" class=" text-decoration-none">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total Number of Stores:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">
                                                    <?php
                                                    $stores = new Store();
                                                    $countResult = $stores->count();

                                                    if (!empty($countResult) && count($countResult) === 1) {

                                                        $totalCount = $countResult[0][0];
                                                        echo $totalCount;
                                                    } else {
                                                        echo "Error: Unable to fetch total count of Store.";
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                <a href="../admin-products/index.php" class=" text-decoration-none">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total number of products:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">
                                                    <?php
                                                    $prod = new Product();
                                                    $countResult = $prod->count();


                                                    if (!empty($countResult) && count($countResult) === 1) {

                                                        $totalCount = $countResult[0][0];
                                                        echo $totalCount;
                                                    } else {
                                                        echo "Error: Unable to fetch total count of Product.";
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                <a href="../admin-settings/category.php" class=" text-decoration-none">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total number of Categories:</p>
                                                <p class="col-12 m-0 fw-bold fs-5  text-secondary text-end">
                                                    <?php
                                                    $cat = new Category();
                                                    $countResult = $cat->count();


                                                    if (!empty($countResult) && count($countResult) === 1) {

                                                        $totalCount = $countResult[0][0];
                                                        echo $totalCount;
                                                    } else {
                                                        echo "Error: Unable to fetch total count of Category.";
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                <a href="../admin-settings/department.php" class=" text-decoration-none">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4  text-primary">Total Number of Department:</p>
                                                <p class="col-12 m-0 fw-bold fs-5  text-secondary text-end">
                                                    <?php
                                                    $dep = new Department();
                                                    $countResult = $dep->count();


                                                    if (!empty($countResult) && count($countResult) === 1) {

                                                        $totalCount = $countResult[0][0];
                                                        echo $totalCount;
                                                    } else {
                                                        echo "Error: Unable to fetch total count of Department.";
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                <a href="../admin-settings/index.php" class=" text-decoration-none">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 pb-0  text-primary">CrimsonAvenue Commision:</p>
                                                <?php
                                                $co = new AdminSettings();
                                                $data = $co->show();

                                                if (!empty($data)) {
                                                    foreach ($data as $row) {
                                                        echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">' . $row['commission'] . '%' . '</p>';
                                                    }
                                                } else {
                                                    echo '<p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">No data available</p>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                        <div class="row m-0 h-100">
                                            <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total Sales:</p>
                                            <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">
                                                <?php
                                                $sales = new Order();
                                                $totalSales = $sales->calculateTotalSales();

                                                if ($totalSales !== false) {
                                                    echo '₱' . number_format($totalSales, 2);
                                                } else {
                                                    echo "Error: Unable to fetch total sales.";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total Commission:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">
                                                    <?php
                                                    $commission = new Order();
                                                    $totalCommission = $commission->calculateTotalCommission();

                                                    if ($totalCommission !== false) {
                                                        echo '₱' . number_format($totalCommission, 2);
                                                    } else {
                                                        echo "Error: Unable to fetch total commission.";
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-lg-4 col-md-6 mb-md-4 mb-lg-0 pt-1 pt-md-0">
                                    <div class="card shadow border-0 mb-3">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-0 h-100">
                                                <p class="col-12 m-0 fw-semibold fs-4 text-primary">Total Unpaid Commission:</p>
                                                <p class="col-12 m-0 fw-bold fs-5 text-secondary text-end">
                                                    <?php
                                                    $commissionsi = new Order();
                                                    $totalunpaidCommission = $commissionsi->calculateTotalUnpaid();

                                                    if ($totalunpaidCommission !== false) {
                                                        echo '₱' . number_format($totalunpaidCommission, 2);
                                                    } else {
                                                        echo "Error: Unable to fetch total commission.";
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            

                        <section class="tablesforlife p-4 mt-5">
                            <div class="container-fluid p-0">
                                <div class="row">
                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $start_date = $_POST['start_date'];
                                        $end_date = $_POST['end_date'];
                                        if ($end_date < $start_date) {
                                            $error_message = "Invalid End Date";
                                        } else {
                                            $dataFetcher = new Store();
                                            $data = $dataFetcher->store_rank_filtered($start_date, $end_date);
                                            if (empty($data)) {
                                                $no_sales_message = "No sales made within the specified date range.";
                                            }
                                        }
                                    }
                                    ?>  
                                    <form action="" method="post" class="d-flex flex-row justify-content-between mb-4 mt-4">
                                        <p class="h2 fw-semibold fs-2 ms-3 text-primary col-4">Top Selling Store</p>
                                        <p>From</p>
                                        <div class="col-2">
                                            <input type="date" class="form-control" id="start-date" name="start_date" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>" required>
                                        </div>
                                        <p>To</p>
                                        <div class="col-2">
                                            <input type="date" class="form-control" id="end-date" name="end_date" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>" required>
                                            <?php if (isset($error_message)) : ?>
                                                <p style="color: red;" class="fs-6"><?php echo $error_message; ?></p>
                                            <?php endif; ?>
                                            <?php if (isset($no_sales_message)) : ?>
                                                <p style="color: red;" class="fs-6"><?php echo $no_sales_message; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="btn btn-primary" name="filter">Filter</button>

                                        </div>

                                    </form>
                                </div>
                                <?php
                                if (isset($_POST['filter'])) {
                                    $start_date = $_POST['start_date'];
                                    $end_date = $_POST['end_date'];
                                    $dataFetcher = new Store();
                                    $data = $dataFetcher->store_rank_filtered($start_date, $end_date);
                                } else {
                                    $dataFetcher = new Store();
                                    $data = $dataFetcher->store_rank();
                                }
                                ?>
                                <div class="table-container" style="max-height: 400px; overflow-y: auto;">

                                    <table class="table border">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Store</th>
                                                <th scope="col">College</th>
                                                <th scope="col">Products</th>
                                                <th scope="col">Solds</th>
                                                <th scope="col">Sales</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            <?php foreach ($data as $index => $row) : ?>
                                                <tr <?php if ($index >= 10) echo 'class="d-none"'; ?>>
                                                    <th scope="row"><?php echo $index + 1; ?></th>
                                                    <td><?php echo $row['store_name']; ?></td>
                                                    <td><?php echo $row['college_name']; ?></td>
                                                    <td><?php echo $row['products']; ?></td>
                                                    <td><?php echo $row['solds']; ?></td>
                                                    <td>₱ <?php echo $row['sales']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </main>
            </div>
        </div>
    </main>




    <?php
    if (isset($sem_check) && $sem_check == 'Ended') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="../admin-settings/index.php" class="text-decoration-none text-dark">
                                    <p class="m-0"> Current Semester Ended! <br><span class="text-primary fw-bold">Click to Set new Semester</span>.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if (isset($sem_check) && $sem_check == 'No Sem') {
    ?>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <a href="../admin-settings/index.php" class="text-decoration-none text-dark">
                                    <p class="m-0"><span class="text-primary fw-bold">Click to Set new Semester</span>.</p>
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
    </main>
    <?php
    require_once('../includes/js.php');
    ?>
</body>

</html>
