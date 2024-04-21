<?php
if (!isset($pro_record['store_id']) || !isset($pro_record['product_id'])) {
    header('location: ./index.php?store_id=' . $record['store_id']);
}
?>

<div class="col-12 m-0 p-0 px-2 btn-group">
    <p class="m-0 p-0 fs-4 fw-bold text-primary lh-1 flex-fill">
        Product Details
    </p>
    <button type="button" class="m-0 p-0 text-secondary border-0 bg-white fw-semibold fs-4 lh-1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-ellipsis"></i>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="<?= './product-edit.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id'] ?>">Update Details</a></li>
        <li><a class="dropdown-item" href="#">Delete Product</a></li>
    </ul>
</div>
<div class="col-12 m-0 p-0">
    <hr class="mb-0">
</div>
<div class="col-12 col-lg-auto m-0 p-3 d-flex flex-column align-items-center">
    <div id="carouselExampleCaptions" class="carousel slide product-carousel-width" data-bs-ride="carousel">
        <div class="carousel-inner rounded">
            <?php
            $activecounter = false;
            $imagesArray = $image->show($pro_record['product_id']);
            if (empty($imagesArray)) {
            ?>
                <div class="carousel-item carousel-custom active" data-bs-interval="5000">
                    <img src="../images/main/no-profile.jpg" alt="" class="profile-size border border-secondary-subtle rounded-2">
                </div>
                <?php
            } else {
                foreach ($imagesArray as $img) {
                ?>
                    <div class="carousel-item carousel-custom <?= ($activecounter == false) ? 'active' : '' ?> " data-bs-interval="5000">
                        <img src="<?php if (isset($img['image_file'])) {
                                        echo "../images/data/" . $img['image_file'];
                                    } else {
                                        echo "../images/main/no-profile.jpg";
                                    } ?>" alt="" class="profile-size border border-secondary-subtle rounded-2">
                    </div>
            <?php
                    $activecounter = true;
                }
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<div class="col-auto d-none d-lg-block p-0 m-0 border-start"></div>
<div class="col-12 col-lg-auto m-0 p-2 d-flex justify-content-start align-items-start flex-fill row">
    <table class="table-sm m-0">
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Product Name:
                </span>
                <br class="d-block d-md-none">
                <?= $pro_record['product_name'] ?>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Category:
                </span>
                <br class="d-block d-md-none">
                <?= $pro_record['category_name'] ?>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Exclusivity:
                </span>
                <br class="d-block d-md-none">
                <?= $pro_record['exclusivity'] ?>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Limit Per Order:
                </span>
                <br class="d-block d-md-none">
                <?= $pro_record['order_quantity_limit'] ?>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Estimated Order Time:
                </span>
                <br class="d-block d-md-none">
                <?= $pro_record['estimated_order_time'] . " Days" ?>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Date Added:
                </span>
                <br class="d-block d-md-none">
                <?= date('F d Y', strtotime($pro_record['is_created'])) ?>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Sale Status:
                </span>
                <br class="d-block d-md-none">
                <?= $pro_record['sale_status'] ?>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Purchase Price:
                </span>
                <br class="d-block d-md-none">
                ₱
                <?= $pro_record['purchase_price'] ?>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Selling Price:
                </span>
                <br class="d-block d-md-none">
                ₱
                <?= $pro_record['final_price'] ?>
                <span class="text-secondary fw-normal fs-7">
                    (Commission Added)
                </span>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Restriction Status:
                </span>
                <br class="d-block d-md-none">
                <?= $pro_record['restriction_status'] ?>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Styles/Variations:
                </span>
                <br class="d-block d-md-none">
                <?= $pro_record['var_count'] ?>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold text-dark">
                <span class="text-secondary fw-normal">
                    Sizes/Measurements:
                </span>
                <br class="d-block d-md-none">
                <?= $pro_record['mea_count'] ?>
            </td>
        </tr>
    </table>
</div>