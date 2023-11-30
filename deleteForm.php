<?php
session_start();

require_once 'common/checkAuth.php';
require_once 'common/connect.php';

$id = $_POST['id'] ?? '';

$result = deleteProperty($id);

if ($result) {
    header('Location: index.php');
} else {
    echo "Error delete!";
}

?>