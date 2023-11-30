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

    $result = editProperty($id, $title, $content, $category_id, $price, $city, $asize, $location);
    if ($result) {
        header('Location: index.php');
    }

}

?>