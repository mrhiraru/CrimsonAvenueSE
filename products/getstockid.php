<?php
require_once "../classes/stock.class.php";

$stock = new Stock();

$product_id = htmlentities($_GET['product_id']);
$variation_id = htmlentities($_GET['variation_id']);
$measurement_id = htmlentities($_GET['measurement_id']);

$stock_record = $stock->show_stock($product_id, $variation_id, $measurement_id);

if (isset($stock_record['stock_id'])) {
    echo $stock_record['stock_id'];
} else {
    echo '';
}
