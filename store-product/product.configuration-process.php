<?php
if (!isset($pro_record['store_id']) || !isset($pro_record['product_id'])) {
    header('location: ./index.php?store_id=' . $record['store_id']);
}
?>

<?php

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
