<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $oldPassword = md5($_POST['password'] ?? '');
    $newPassword = md5($_POST['new_password'] ?? '');
    $confirm_passwrod = md5($_POST['confirm_password'] ?? '');

    $errors = [];

    if (empty($email)) {
        $errors['email'] = 'Email is empty';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Invalid email format';
    }

    if (empty($oldPassword)) {
        $errors['password'] = 'Password is empty';
    } else {
        if (strlen($oldPassword) < 6) {
            $errors['password'] = 'Password length should be at least 6 symbols';
        }
    }
    if (empty($newPassword)) {
        $errors['new_password'] = 'New password is empty';
    } else {
        if (strlen($newPassword) < 6) {
            $errors['new_password'] = 'New password length should be at least 6 symbols';
        }
    }
    if (empty($confirm_passwrod)) {
        $errors['confirm_password'] = 'Confirm password is empty';
    } else {
        if (strlen($confirm_passwrod) < 6) {
            $errors['confirm_password'] = 'Confirm password length should be at least 6 symbols';
        }
    }
    if ($confirm_passwrod != $newPassword) {
        $errors['confirm_password'] = 'Password does not match';
    }
    if ($errors) {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header('Location: change_passwordForm.php');
    } else {
        require_once 'common/connect.php';

        $updatePass = changePassword($email, $oldPassword, $newPassword);

        if ($updatePass) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'You changed password';
            header('Location: change_passwordForm.php');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Failed to change password. Please check your old password.';
            header('Location: change_passwordForm.php');
        }

    }

}

?>