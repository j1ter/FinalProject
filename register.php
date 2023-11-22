<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_passwrod = $_POST['confirm_passwrod'] ?? '';

    $errors = [];

    if (empty($name)) {
        $errors['name'] = 'Name is empty';
    }
    if (empty($email)) {
        $errors['email'] = 'Email is empty';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Invalid email format';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is empty';
    } else {
        if (strlen($password) < 6) {
            $errors['password'] = 'Password length should be at least 6 symbols';
        }
    }
    if (empty($confirm_passwrod)) {
        $errors['confirm_password'] = 'Password is empty';
    } else {
        if (strlen($confirm_passwrod) < 6) {
            $errors['confirm_password'] = 'Password length should be at least 6 symbols';
        }
    }
    if ($confirm_passwrod != $password) {
        $errors['confirm_password'] = 'Password does not match';
    }
    if ($errors) {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header('Location:registerForm.php');
    } else {

    }
}

?>