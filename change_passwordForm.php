<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <?php require_once 'common/inhead.php'; ?>
</head>

<body>
    <?php session_start(); ?>

    <?php
    $hasErrors = false;
    if (isset($_SESSION['status']) && $_SESSION['status'] == 'error')
        $hasErrors = true;
    ?>

    <div class="custom-centerForm" style="margin-top: 150px;">
        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'success'): ?>
            <div class="success">
                <?= $_SESSION['message'] ?>
            </div>
        <?php endif; ?>

        <form action="changePass.php" method="POST" class="custom-form">
            <div class="custom-form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <?php if ($hasErrors && isset($_SESSION['errors']['email'])): ?>
                    <p>
                        <?= $_SESSION['errors']['email'] ?>
                    </p>
                <?php endif; ?>
            </div>


            <div class="custom-form-group">
                <label for="password">Old Password</label>
                <input type="password" name="password" id="password">
                <?php if ($hasErrors && isset($_SESSION['errors']['password'])): ?>
                    <p>
                        <?= $_SESSION['errors']['password'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="custom-form-group">
                <label for="new_password">New password</label>
                <input type="password" name="new_password" id="new_password">
                <?php if ($hasErrors && isset($_SESSION['errors']['new_password'])): ?>
                    <p>
                        <?= $_SESSION['errors']['new_password'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="custom-form-group">
                <label for="confirm_password">Confirm new password</label>
                <input type="password" name="confirm_password" id="confirm_password">
                <?php if ($hasErrors && isset($_SESSION['errors']['confirm_password'])): ?>
                    <p>
                        <?= $_SESSION['errors']['confirm_password'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <button type="submit" class="custom-btn">Change password</button>
        </form>
    </div>

    <?php

    unset($_SESSION['status']);
    unset($_SESSION['errors']);
    unset($_SESSION['message']);

    ?>

</body>

</html>