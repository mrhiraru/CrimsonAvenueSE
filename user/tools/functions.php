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

function validate_email($email)
{
    // Check if the 'email' key exists in the $_POST array
    if (isset($email)) {
        $email = trim($email); // Trim whitespace
        // Check if the email is not empty
        if (empty($email)) {
            return "Email can't be empty";
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

function validate_wmsu_email($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pattern = '/@wmsu\.edu\.ph$/i';

        if (preg_match($pattern, $email)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function validate_password($password)
{
    $password = htmlentities($password);

    if (strlen(trim($password)) < 1) {
        return "Password you've entered is invalid.";
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
