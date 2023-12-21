<?php
session_start();

require_once 'common/checkAuth.php';
require_once 'common/connect.php';

$id = $_POST['commentId'];
$property_id = $_POST['property_id'];

$result = deleteComment($id);

if ($result) {
    header("Location: oneProperty.php?property_id=$property_id");
} else {
    echo "Error delete!";
}


?>