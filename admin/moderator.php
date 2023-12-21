<?php
session_start();

require_once '../common/checkAuth.php';
require_once '../common/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propertyId = $_POST['property_id'] ?? '';
    $action = $_POST['action'] ?? '';

    if (!empty($propertyId) && !empty($action)) {

        if ($action === 'approve') {
            updatePropertyStatus($propertyId, 'approve');
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Property approved successfully';
        } elseif ($action === 'reject') {
            updatePropertyStatus($propertyId, 'reject');
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Property rejected successfully';
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Invalid property or action';
    }

    header('Location: checkProperty.php?property_id=' . $property_id);
    exit();
}
?>