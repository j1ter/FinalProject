<?php
session_start();


require_once 'common/checkAuth.php';
require_once 'common/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $category_id = $_POST['category_id'] ?? '';
    $price = $_POST['price'] ?? '';
    $city = $_POST['city'] ?? '';
    $asize = $_POST['asize'] ?? '';
    $location = $_POST['location'] ?? '';
    $status = $_POST['status'] ?? 'pending';


    $errors = [];

    if (empty($title)) {
        $errors['title'] = 'Title is empty';
    }
    if (empty($content)) {
        $errors['content'] = 'Content is empty';
    }
    if (empty($category_id)) {
        $errors['category_id'] = "You haven't selected a category";
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header('Location: createFormModerator.php');
    }
    if (empty($price)) {
        $errors['price'] = 'Price is empty';
    }
    if (empty($city)) {
        $errors['city'] = 'City is empty';
    }
    if (empty($asize)) {
        $errors['asize'] = 'Area size is empty';
    }
    if (empty($location)) {
        $errors['location'] = 'Address is empty';
    }
    $pimage = $_FILES['pimage'];
    $pimageDirectory = '../images/properties/';
    $uploadPimageName = uploadImage('pimage', $pimageDirectory);
    var_dump($uploadPimageName);

    if ($uploadPimageName === 'Error uploading image' || $uploadPimageName === 'Invalid file type' || $uploadPimageName === 'File size is too big. Choose a file less than 1MB.' || $uploadPimageName === 'Error uploading file.') {
        // Обработка ошибок при загрузке изображения
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = ['pimage' => $uploadPimageName];
        header('Location: createForm.php');
        exit;
    }

    if ($errors) {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header('Location: createFormModerator.php');
    } else {
        $result = createProperty($title, $content, $category_id, $user['id'], $price, $city, $asize, $location, $status, $uploadPimageName !== null ? $uploadPimageName : 'noimage.jpg');
        if ($result) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'You created property successfully!';
            header('Location: indexModerator.php');
        } else {
            $_SESSION['status'] = 'errors';
            $_SESSION['errors'] = $errors;
            header('Location: createFormModerator.php');
        }
    }
}

?>