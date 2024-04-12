<?php
require_once "../classes/stock.class.php";

$stock = new Stock();

$product_id = htmlentities($_GET['product_id']);
$variation_id = htmlentities($_GET['variation_id']);
$measurement_id = htmlentities($_GET['measurement_id']);
$price = sprintf("%.2f", htmlentities($_GET['price']));

$stock_record = $stock->show_stock($product_id, $variation_id, $measurement_id);
$price_record = $stock->price_fetch($variation_id, $measurement_id, $product_id);

if (isset($stock_record['selling_price'])) {
    echo "₱ " . $stock_record['selling_price'];
} else if (isset($price_record['selling_price'])) {
    echo "₱ " . $price_record['selling_price'];
} else {
    echo "₱ " . $price;
}
