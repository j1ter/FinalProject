<?php
session_start();

require_once 'common/checkAuth.php';
require_once 'common/connect.php';

$id = $_POST['property_id'] ?? '';

$result = deleteProperty($id);

if ($result) {
    header('Location: profile.php');
} else {
    echo "Error delete!";
}

?>