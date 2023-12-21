<?php

session_start();

require_once 'common/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_passwrod = $_POST['confirm_password'] ?? '';

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
    if (empty($phone)) {
        $errors['phone'] = 'Phone is empty';
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
    $avatar = $_FILES['avatar'];
    $avatarDirectory = 'images/avatars/';

    // Вызываем функцию uploadImage
    $uploadAvatarName = uploadImage('avatar', $avatarDirectory);

    if ($uploadAvatarName === 'Error uploading image' || $uploadAvatarName === 'Invalid file type' || $uploadAvatarName === 'File size is too big. Choose a file less than 1MB.' || $uploadAvatarName === 'Error uploading file.') {
        // Обработка ошибок при загрузке изображения
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = ['avatar' => $uploadAvatarName];
        header('Location: registerForm.php');
        exit;
    }



    if ($errors) {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header('Location: registerForm.php');
    } else {


        $isReg = registerUser($email, $name, $phone, $password, $uploadAvatarName !== null ? $uploadAvatarName : 'noimage.jpg');

        if ($isReg) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'You have registered';
            header('Location: loginForm.php');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['errors'] = ['email' => 'This email is busy'];
            header('Location: registerForm.php');
        }


    }
}

?>