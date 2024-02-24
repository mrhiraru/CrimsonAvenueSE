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
        <li><a class="dropdown-item" href="#">Update Details</a></li>
        <li><a class="dropdown-item" href="#">Delete Product</a></li>
    </ul>
</div>
<div class="col-12 m-0 p-0">
    <hr class="mb-0">
</div>
<div class="col-12 col-lg-auto m-0 p-3 d-flex flex-column align-items-center">
    <img src="<?php if (isset($pro_record['profile_image'])) {
                    echo "../images/data/" . $pro_record['profile_image'];
                } else {
                    echo "../images/main/no-profile.jpg";
                } ?>" alt="" class="profile-size border border-secondary-subtle rounded-2">
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
                <span class="pe-3 text-secondary fw-normal">
                    Estimated Order Time:
                </span>
                <br class="d-block d-md-none">
                <?= $pro_record['estimated_order_time'] ?>
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