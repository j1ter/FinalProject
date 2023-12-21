<?php
session_start();


require_once 'common/checkAuth.php';
require_once 'common/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $category_id = $_POST['category_id'] ?? '';
    $price = $_POST['price'] ?? '';
    $city = $_POST['city'] ?? '';
    $asize = $_POST['asize'] ?? '';
    $location = $_POST['location'] ?? '';

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
        header('Location: createForm.php');
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
    if ($errors) {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header('Location: editPropertyForm.php');
    } else {
        $result = editProperty($id, $title, $content, $category_id, $price, $city, $asize, $location);
        if ($result) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'You are updated property successfully!';
            header('Location: index.php');
        } else {
            $_SESSION['status'] = 'errors';
            $_SESSION['errors'] = $errors;
            header('Location: editPropertyForm.php');
        }
    }



}

?>