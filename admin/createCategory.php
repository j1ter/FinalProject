<?php
session_start();
require_once '../common/checkAuth.php';
require_once '../common/connect.php';
require_once '../common/adminStyles.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'] ?? '';

    if(!empty($category_name)) {
        // Вызываем функцию добавления категории
        addCategory($category_name);

        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Category added successfully';
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Category name cannot be empty';
    }

    header('Location: addCategoryForm.php');
    exit();
} else {
    header('Location: addCategoryForm.php');
    exit();
}
?>