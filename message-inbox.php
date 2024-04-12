<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Message | Crimson Avenue";
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
                <div class="d-flex mb-md-2 mb-lg-0 col-12 justify-content-end">
                    <button class="btn btn-primary border-0 flex-grow-1 flex-sm-grow-0" type="button" data-bs-toggle="modal" data-bs-target="#newMessage">
                        New Message
                    </button>
                    <a href="messages.php" class="text-decoration-none text-white btn btn-primary border-0 flex-grow-1 flex-sm-grow-0 ms-2">
                        Go Back to Messages
                    </a>
                </div>
                <!-- datatable start -->
                <div class="table-responsive overflow-hidden">
                    <table id="messagesbox" class="table table-sm">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $messagesArray = array(
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),
                                array(
                                    'image' => "<img class='image-size rounded-circle' src='../image/frankprofile.jpg' alt=''>",
                                    'name' => 'Franklin Oliveros',
                                    'date' => '27/11/2023',
                                    'subject' => 'Need Help',
                                    'message' => 'Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.',
                                    'status' => '2'
                                ),

                            );
                            ?>
                            <?php
                            $counter = 1;
                            foreach ($messagesArray as $item) {
                            ?>
                                <tr class="align-middle">
                                    <td>
                                        <div type="button" data-bs-toggle="modal" data-bs-target="#viewMess">
                                            <div class="container">
                                                <div class="row d-flex flex-row">
                                                    <div class="col-auto p-0">
                                                        <?= $item['image'] ?>
                                                    </div>
                                                    <div class="col-10 pe-4">
                                                        <div class="row  d-flex flex-row p-0">
                                                            <div class="col-12 col-md-auto">
                                                                <?= $item['name'] ?>
                                                            </div>
                                                            <div class="col-12 col-md-auto">
                                                                <span>Subject: </span><?= $item['subject'] ?>
                                                            </div>
                                                            <div class="col-auto flex-grow-1 text-start text-lg-end">
                                                                <?= $item['date'] ?>
                                                            </div>
                                                        </div>
                                                        <div class="row  d-flex flex-row p-0">
                                                            <div class="col-auto col-lg-12 overflow-hidden text-nowrap text-center">
                                                                <?= $item['message'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                <!-- datatable end -->
            </div>
        </div>
    </main>
    <!-- all custom error message displyed non (d-none) -->
    <div class="modal fade" id="viewMess" tabindex="-1" aria-labelledby="viewMessLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="viewMessLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td class="w-25 py-2 align-top">Name:</td>
                            <td class="w-75 py-2 fw-semibold align-top">Franklin Oliveros</td>
                        </tr>
                        <tr>
                            <td class="w-25 py-2 align-top">Subject:</td>
                            <td class="w-75 py-2 fw-semibold align-top">Need Help</td>
                        </tr>
                        <tr>
                            <td class="w-25 py-2 align-top">Message:</td>
                            <td class="w-75 py-2 fw-semibold align-top">Could you please provide guidance on the process for purchasing the product? Additionally, I would appreciate any information regarding available payment methods, shipping options, and if there are any ongoing promotions or discounts that I can take advantage of. Thank you for your assistance and prompt attention to this matter.</td>
                        </tr>
                    </table>
                    <div class="mt-2 col-12 text-end">
                        <button type="button" class="btn btn-primary brand-bg-color" id="createNewStoreButton" data-bs-toggle="modal" data-bs-target="#newMessage">Reply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Create new Store Modal -->
    <!-- Start view message Modal -->
    <!-- all custom error message displyed non (d-none) -->
    <div class="modal fade" id="newMessage" tabindex="-1" aria-labelledby="newMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="newMessageLabel">New Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" class="row d-flex">
                        <div class="mb-2 col-12">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                        </div>

                        <div class="mb-2 col-12">
                            <label for="subject" class="form-label">Subject:</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                            <p id="store-name-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                        </div>

                        <div class="mb-2">
                            <label for="message" class="form-label">Message:</label>
                            <textarea type="textarea" class="form-control" id="message" name="message" required></textarea>
                            <p id="description-error" class="modal-error text-danger my-1 d-none">Your custom error message here</p>
                        </div>

                        <div class="mt-2 col-12 text-end">
                            <!-- change back to submit  -->
                            <button type="button" class="btn btn-primary brand-bg-color" id="createNewStoreButton" data-bs-toggle="modal" data-bs-target="#userSuccessModal">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End View MEssage Modal -->
    <!-- Store Created Modal -->
    <div class=" modal fade" id="userSuccessModal" tabindex="-1" aria-labelledby="userSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="" class="row d-flex">
                        <div class=" col-12 text-center">
                            <button type="button" class="btn border-0 " data-bs-dismiss="modal" aria-label="Close"><span class="text-primary fw-semibold ">Message has been sent!</span> Click to Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <section>
            <!-- Code Here Extra Section -->
        </section>
        <!-- Extra Section Add more Section if needed ./. -->
    </div>
    <?php
    require_once('./includes/footer.php');
    require_once('./includes/js.php');
    ?>
</body>

</html>