<?php
if (!isset($pro_record['store_id']) || !isset($pro_record['product_id'])) {
    header('location: ./index.php?store_id=' . $record['store_id']);
}

$description = new Description();
if (isset($_POST['add_desc'])) {

    $description->desc_label = htmlentities($_POST['label']);
    $description->desc_value = htmlentities($_POST['value']);
    $description->product_id = $pro_record['product_id'];

    if (validate_field($description->desc_label) && validate_field($description->desc_value)) {
        if ($description->add()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save_desc'])) {
    $description->desc_label = htmlentities($_POST['label']);
    $description->desc_value = htmlentities($_POST['value']);
    $description->desc_id = $_GET['desc_id'];

    if (validate_field($description->desc_label) && validate_field($description->desc_value)) {
        if ($description->edit()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['cancel_desc'])) {

    header('location: ./product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id']);
} else if (isset($_POST['delete_desc'])) {

    $description->desc_id = $_GET['desc_id'];
    $description->is_deleted = 1;

    if ($description->delete()) {
        $success = 'success';
    } else {
        echo 'An error occured while adding in the database.';
        $success = 'failed';
    }
}

$variation = new Variation();
if (isset($_POST['add_var'])) {

    $variation->variation_name = htmlentities($_POST['variation_name']);
    $variation->product_id = $pro_record['product_id'];

    if (validate_field($variation->variation_name)) {
        if ($variation->add()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save_var'])) {
    $variation->variation_name = htmlentities($_POST['variation_name']);
    $variation->variation_id = $_GET['variation_id'];

    if (validate_field($variation->variation_name)) {
        if ($variation->edit()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['cancel_var'])) {

    header('location: ./product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id']);
} else if (isset($_POST['delete_var'])) {

    $variation->variation_id = $_GET['variation_id'];
    $variation->is_deleted = 1;

    if ($variation->delete()) {
        $success = 'success';
    } else {
        echo 'An error occured while adding in the database.';
        $success = 'failed';
    }
}

$measurement = new Measurement();
if (isset($_POST['add_mea'])) {

    $measurement->measurement_name = htmlentities($_POST['measurement_name']);
    $measurement->value_unit = htmlentities($_POST['value_unit']);
    $measurement->product_id = $pro_record['product_id'];

    if (validate_field($measurement->measurement_name) && validate_field($measurement->value_unit)) {
        if ($measurement->add()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['save_mea'])) {
    $measurement->measurement_name = htmlentities($_POST['measurement_name']);
    $measurement->value_unit = htmlentities($_POST['value_unit']);
    $measurement->measurement_id = $_GET['measurement_id'];

    if (validate_field($measurement->measurement_name) && validate_field($measurement->value_unit)) {
        if ($measurement->edit()) {
            $success = 'success';
        } else {
            echo 'An error occured while adding in the database.';
        }
    } else {
        $success = 'failed';
    }
} else if (isset($_POST['cancel_mea'])) {

    header('location: ./product-view.php?store_id=' . $record['store_id'] . '&product_id=' . $pro_record['product_id']);
} else if (isset($_POST['delete_mea'])) {

    $measurement->measurement_id = $_GET['measurement_id'];
    $measurement->is_deleted = 1;

    if ($measurement->delete()) {
        $success = 'success';
    } else {
        echo 'An error occured while adding in the database.';
        $success = 'failed';
    }
}
