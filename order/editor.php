<?php
 if (isset($record['stock_selling_price']) && $record['sale_status'] == "On-hand") {

    if (isset($record['discount_amount']) && isset($record['discount_type'])) {
        if ($record['discount_type'] == "Percentage") {

            $original_price = $record['stock_selling_price'] * $_POST['quantity'];
            $discounted_price = $original_price - ($original_price * ($record['discount_amount'] / 100));

            $original_com = $record['stock_commission'] * $_POST['quantity'];
            $discounted_com = $original_com - ($original_com * ($record['discount_amount'] / 100));

            $product_total += $discounted_price;
            $commission_total += $discounted_com;
        } else if ($record['discount_type'] == "Fixed") {

            $original_price = $record['stock_selling_price'] * $_POST['quantity'];
            $discounted_price = $original_price - $record['discount_amount'];

            $original_com = $record['stock_commission'] * $_POST['quantity'];
            $discounted_com = $original_price - $record['discount_amount'];


            $product_total += $discounted_price;
            $commission_total += $discounted_com;
        }
    } else {
        $product_total += $record['stock_selling_price'] * $_POST['quantity'];
        $commission_total += $record['stock_commission'] * $_POST['quantity'];
    }
} else if (isset($record['prices_selling_price']) && $record['sale_status'] == "Pre-order") {
    if (isset($record['discount_amount']) && isset($record['discount_type'])) {
        if ($record['discount_type'] == "Percentage") {

            $original_price = $record['prices_selling_price'] * $_POST['quantity'];
            $discounted_price = $original_price - ($original_price * ($record['discount_amount'] / 100));

            $original_com = $record['prices_commission'] * $_POST['quantity'];
            $discounted_com = $original_com - ($original_com * ($record['discount_amount'] / 100));

            $product_total += $discounted_price;
            $commission_total += $discounted_com;
        } else if ($record['discount_type'] == "Fixed") {

            $original_price = $record['prices_selling_price'] * $_POST['quantity'];
            $discounted_price = $original_price - $record['discount_amount'];

            $original_com = $record['prices_commission'] * $_POST['quantity'];
            $discounted_com = $original_price - $record['discount_amount'];


            $product_total += $discounted_price;
            $commission_total += $discounted_com;
        }
    } else {
        $product_total += $record['prices_selling_price'] * $_POST['quantity'];
        $commission_total += $record['prices_commission'] * $_POST['quantity'];
    }
} else {
    if (isset($record['discount_amount']) && isset($record['discount_type'])) {
        if ($record['discount_type'] == "Percentage") {

            $original_price = $record['product_selling_price'] * $_POST['quantity'];
            $discounted_price = $original_price - ($original_price * ($record['discount_amount'] / 100));

            $original_com = $record['product_commission'] * $_POST['quantity'];
            $discounted_com = $original_com - ($original_com * ($record['discount_amount'] / 100));

            $product_total += $discounted_price;
            $commission_total += $discounted_com;
        } else if ($record['discount_type'] == "Fixed") {

            $original_price = $record['product_selling_price'] * $_POST['quantity'];
            $discounted_price = $original_price - $record['discount_amount'];

            $original_com = $record['product_commission'] * $_POST['quantity'];
            $discounted_com = $original_price - $record['discount_amount'];


            $product_total += $discounted_price;
            $commission_total += $discounted_com;
        }
    } else {
        $product_total += $record['product_selling_price'] * $_POST['quantity'];
        $commission_total += $record['product_commission'] * $_POST['quantity'];
    }
}
