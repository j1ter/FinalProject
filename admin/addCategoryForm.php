<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Category</title>
    <?php require_once '../common/inhead.php'; ?>
</head>

<body>
    <?php require_once '../common/adminStyles.php'; ?>
    <h2 style="text-align: center; margin-top: 20px;">Add New Category</h2>
    <?php
    if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
        echo '<div class="' . $_SESSION['status'] . '">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['status']);
        unset($_SESSION['message']);
    }
    ?>
    <div class="custom-centerForm" style="margin-top: 200px;">
        <form class="custom-form" action="createCategory.php" method="post">
            <div class="custom-form-group">
                <label for="category_name">Category Name:</label>
                <input type="text" id="category_name" name="category_name" required>
                <br>
                <input type="submit" value="Add Category">
            </div>
        </form>
    </div>
</body>

</html>