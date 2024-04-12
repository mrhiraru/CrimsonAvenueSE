
    <!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Page Name | Crimson Avenue";
$page_name = "active";
require_once('./includes/head.php');
include_once('./includes/preloader.php');
?>

<body>
    <?php
    require_once('./includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto min-vh-100 ">
    <main class="col-md-9 pt-3 mx-sm-auto col-lg-10 p-md-4">
        <div class="container-fluid mb-3 p-3 bg-white shadow rounded">
            <div class="row h-auto mb-4 d-flex justify-content-center">
                <h2 class="h2 text-primary fw-bold">Messages</h2>
                <hr class="text-secondary">
                <!-- datatable start -->
                <div class="table-responsive overflow-hidden">
                    <div class="row g-2 mb-2 m-0">
                        <div class="search-keyword col-12 col-lg-auto flex-lg-grow-1 d-flex ">
                            <div class="input-group">
                                <input type="text" name="keyword" id="keyword" placeholder="Search" class="form-control">
                                <button class="btn btn-outline-secondary brand-bg-color" type="button"><i class="fa fa-search color-white " aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                    <table id="messagebox" class="table table-sm">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Messaging As</th>
                                <th scope="col">New Messages</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $messageArray = array(
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'role' => 'User',
                                    'number' => 8,
                                ),
                            );
                            ?>
                            <?php
                            $counter = 1;
                            foreach ($messageArray as $item) {
                            ?>

                                <tr class="align-middle">
                                    <td class="text-center"><?= $counter ?></td>
                                    <td><?= $item['image'] ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['role'] ?></td>
                                    <td><?= $item['number'] ?></td>
                                    <td class="text-center"><a href="./messages.php" class="rounded py-1 px-2 btn-white text-secondary text-decoration-none">View Messages</a></td>
                                </tr>

                            <?php
                                $counter++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- datatable end -->
            </div>
        </div>
    </main>
    <?php
    require_once('./includes/footer.php');
    require_once('./includes/js.php');
    ?>
</body>

</html>