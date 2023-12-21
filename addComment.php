<?php

session_start();
require_once 'common/checkAuth.php';
require_once 'common/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'] ?? '';
    $property_id = $_POST['property_id'] ?? '';

    $errors = [];

    if (empty($content)) {
        $errors['content'] = 'Content is empty';
    }

    if ($errors) {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header('Location: createForm.php');
    } else {
        $result = addComment($property_id, $user['id'], $content);

        if ($result) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'You add comment successfully!';
            header("Location: oneProperty.php?property_id=$property_id");
        } else {
            $_SESSION['status'] = 'errors';
            $_SESSION['errors'] = $errors;
            header('Location: createForm.php');
        }

    }




}

?>