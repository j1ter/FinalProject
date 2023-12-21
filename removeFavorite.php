<?php
session_start();

require_once 'common/checkAuth.php';
require_once 'common/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user) {
    $propertyId = $_POST['propertyId'] ?? '';

    if (!empty($propertyId)) {

        removeFromFavorite($user['id'], $propertyId);


        header("Location: profile.php");
        exit;
    }
}


header("Location: profile.php");
exit;
?>