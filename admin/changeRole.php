<?php
session_start();

require_once '../common/checkAuth.php';
require_once '../common/connect.php';
require_once '../common/adminStyles.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'] ?? 0;
    $new_role = $_POST['new_role'] ?? '';

    if(!empty($user_id) && !empty($new_role)) {
        changeUserRole($user_id, $new_role);

        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'User role changed successfully';
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'User or new role cannot ve empty';
    }
    header('Location: indexAdmin.php');
} else {
    header('location: changeUserRoleForm.php');
}

?>