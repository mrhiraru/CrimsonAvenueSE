<?php
require_once "../classes/stock.class.php";
require_once "../classes/product.class.php";


$stock = new Stock();
$product_id = htmlentities($_GET['product_id']);
$variation_id = htmlentities($_GET['variation_id']);
$measurement_id = htmlentities($_GET['measurement_id']);
$price = sprintf("%.2f", htmlentities($_GET['price']));


$product = new Product();
$record = $product->fetch($product_id);
$stock_record = $stock->show_stock($product_id, $variation_id, $measurement_id);
$price_record = $stock->price_fetch($variation_id, $measurement_id, $product_id);

if ($record['sale_status'] == "On-hand" && isset($stock_record['selling_price'])) {
    if (isset($record['discount_amount']) && isset($record['discount_type'])) {
        if ($record['discount_type'] == "Percentage") {
            $original_price = ($stock_record['selling_price'] + $stock_record['commission']);
            $discounted_price = $original_price - ($original_price * ($record['discount_amount'] / 100));

            echo "₱ " . number_format($discounted_price, 2, '.', ',');
        } else if ($record['discount_type'] == "Fixed") {
            $original_price = ($stock_record['selling_price'] + $stock_record['commission']);
            $discounted_price = $original_price - $record['discount_amount'];

            echo "₱ " . number_format($discounted_price, 2, '.', ',');
        }
    } else {
        echo "₱ " . number_format($stock_record['selling_price'] + $stock_record['commission'], 2, '.', ',');
    }
} else if ($record['sale_status'] == "Pre-order" && isset($price_record['selling_price'])) {
    echo "₱ " . number_format($price_record['selling_price'] + $price_record['commission'], 2, '.', ',');
} else {
    echo "₱ " . number_format($price, 2, '.', ',');
}


if (isset($item['discount_amount']) && isset($item['discount_type'])) {
    if ($item['discount_type'] == "Percentage") {
        $original_price = ($item['selling_price'] + $item['commission']);
        $discounted_price = $original_price - ($original_price * ($item['discount_amount'] / 100));
?>
        <p class="fs-5 text-nowrap fw-bold text-white m-0 mt-1 lh-1  text-truncate bg-primary p-1 rounded-1 "><?= '₱' . number_format($discounted_price, 2, '.', ',') ?><span class="fs-7"><?= ' ' . $item['discount_amount'] . '% Discount' ?></span></p>
    <?php
    } else if ($item['discount_type'] == "Fixed") {
        $original_price = ($item['selling_price'] + $item['commission']);
        $discounted_price = $original_price - $item['discount_amount'];
    ?>
        <p class="fs-5 text-nowrap fw-bold text-white m-0 mt-1 lh-1  text-truncate bg-primary p-1 rounded-1 "><?= '₱' . number_format($discounted_price, 2, '.', ',') ?><span class="fs-7"><?= ' ₱' . $item['discount_amount'] . ' Discount' ?></span></p>
    <?php
    }
} else {
    ?>
    <p class="fs-5 text-nowrap fw-bold text-primary m-0 mt-1 lh-1  text-truncate"><?= '₱' . number_format($item['selling_price'] + $item['commission'], 2, '.', ',') ?></p>
<?php
}
