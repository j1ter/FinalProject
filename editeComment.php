<?php
session_start();


require_once 'common/checkAuth.php';
require_once 'common/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $commentId = $_POST['commentId'] ?? '';
    $newContent = $_POST['newContent'] ?? '';
    $property_id = $_POST['property_id'] ?? '';

    $errors = [];

    if (empty($newContent)) {
        $errors['newContent'] = 'Content is empty';
    }

    if ($errors) {
        $_SESSION['status'] = 'error';
        $_SESSION['errors'] = $errors;
        header("Location: oneProperty.php?property_id=$property_id");
    } else {
        $success = editeComment($commentId, $newContent);

        if ($success) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'You add comment successfully!';



            header("Location: oneProperty.php?property_id=$property_id");


        } else {
            $_SESSION['status'] = 'errors';
            $_SESSION['errors'] = $errors;
            header("Location: oneProperty.php?property_id=$property_id");
        }
    }
}


?>