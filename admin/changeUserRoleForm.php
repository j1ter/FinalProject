<?php
session_start();
require_once '../common/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change User Role</title>
    <?php require_once '../common/inhead.php'; ?>
</head>

<body>
    <?php require_once '../common/adminStyles.php'; ?>
    <h2 style="text-align: center; margin-top: 20px;">Change User Role</h2>
    <?php
    if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
        echo '<div class="' . $_SESSION['status'] . '">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['status']);
        unset($_SESSION['message']);
    }
    ?>
    <div class="custom-centerForm" style="margin-top: 200px;">
        <form action="changeRole.php" method="post" class="custom-centerForm">
            <label for="user_id">Select User:</label>
            <select id="user_id" name="user_id" required>
                <?php
                // Получаем список пользователей
                $users = getUsers();

                // Выводим список пользователей в выпадающем списке
                foreach ($users as $user) {
                    echo "<option value=\"{$user['id']}\">{$user['name']}</option>";
                }
                ?>
            </select>
            <br>
            <label for="new_role">Select New Role:</label>
            <select id="new_role" name="new_role" required>
                <option value="user">User</option>
                <option value="moderator">Moderator</option>
                <option value="admin">Admin</option>

            </select>
            <br>
            <input type="submit" value="Change Role">
        </form>
    </div>
</body>

</html>