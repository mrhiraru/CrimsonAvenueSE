<?php

function validate_field($field)
{
    $field = htmlentities($field);
    if (strlen(trim($field)) < 1) {
        return false;
    } else {
        return true;
    }
}

function validate_number($field)
{
    $field = htmlentities($field);
    if ($field < 1) {
        return false;
    } else {
        return true;
    }
}

function validate_email($email)
{
    // Check if the 'email' key exists in the $_POST array
    if (isset($email)) {
        $email = trim($email); // Trim whitespace
        // Check if the email is not empty
        if (empty($email)) {
            return "Email is required";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check if the email has a valid format
            return "Email you've entered is invalid format.";
        } else {
            return 'success';
        }
    } else {
        return 'Email is required'; // 'email' key doesn't exist in $_POST
    }
}

function validate_affiliation($affiliation, $college)
{
    if (isset($affiliation) && $affiliation == 'Non-student') {
        return true;
    } else if (isset($affiliation) && $affiliation != 'Non-student') {
        $college = htmlentities($college);
        if (strlen(trim($college)) < 1) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

function validate_preorder($sale_status, $preorder_price)
{
    if (isset($sale_status) && $sale_status == 'On-hand') {
        return true;
    } else if (isset($sale_status) && $sale_status == 'Pre-order') {
        $preorder_price = htmlentities($preorder_price);
        if (strlen(trim($preorder_price)) < 1) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

function validate_wmsu_email($email, $affiliation)
{
    // Check if the affiliation is 'Student'
    if ($affiliation == 'Student' || $affiliation == 'Faculty') {
        // Validate the email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $pattern = '/@wmsu\.edu\.ph$/i';

            // Check if the email matches the pattern
            if (preg_match($pattern, $email)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false; // Invalid email format
        }
    } else {
        // For 'Non-student', no need to check the pattern, return true
        return true;
    }
}

function validate_password($password)
{
    $password = htmlentities($password);

    if (strlen(trim($password)) < 1) {
        return "Password is required.";
    } elseif (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    } else {
        return "success"; // Indicates successful validation
    }
}

function validate_cpw($password, $cpassword)
{
    $pw = htmlentities($password);
    $cpw = htmlentities($cpassword);
    if (strcmp($pw, $cpw) == 0) {
        return true;
    } else {
        return false;
    }
}

function generate_code()
{
    $code = random_int(100000, 999999);
    return $code;
}

function check_date($sdate, $edate)
{
    $start = htmlentities($sdate);
    $end = htmlentities($edate);

    if ($start < $end) {
        return true;
    } else {
        return false;
    }
}

function validate_stock_quantity($sold, $quantity)
{
    $sold = htmlentities($sold);
    if ($sold > $quantity) {
        return false;
    } else {
        return true;
    }
}
