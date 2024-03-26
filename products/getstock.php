<?php
require_once "../classes/stock.class.php";

$stock = new Stock();

$product_id = htmlentities($_GET['product_id']);
$variation_id = htmlentities($_GET['variation_id']);
$measurement_id = htmlentities($_GET['measurement_id']);

$stock_record = $stock->show_stock($product_id, $variation_id, $measurement_id);


if (isset($stock_record['total_stock_quantity']) && isset($stock_record['total_stock_sold'])) {
    echo $stock_record['total_stock_quantity'] - $stock_record['total_stock_sold'];

} else {
    echo 0;
}
?>