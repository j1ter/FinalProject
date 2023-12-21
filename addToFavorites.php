<?php
session_start();
require_once 'common/checkAuth.php';
require_once 'common/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user) {
    $propertyId = $_POST['propertyId'] ?? '';

    if (!empty($propertyId)) {
        // Добавление в избранное
        addToFavorite($user['id'], $propertyId);
        // Перенаправление обратно на страницу oneProperty.php
        header("Location: oneProperty.php?property_id=$propertyId");
        exit;
    }
}

// В случае ошибки или если пользователь не аутентифицирован
header("Location: oneProperty.php?property_id=$propertyId");
exit;
?>