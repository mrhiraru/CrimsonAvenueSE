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

    echo "₱ " . number_format($stock['selling_price'], 2, '.', ',');
} else if ($record['sale_status'] == "Pre-order" && isset($price_record['selling_price'])) {

    echo "₱ " . number_format($price_record['selling_price'], 2, '.', ',');
} else {
    echo "₱ " . number_format($price, 2, '.', ',');
}
