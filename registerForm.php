<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form page</title>
    <?php require_once 'common/inhead.php' ?>
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

        <form action="register.php" method="POST" class="custom-form">
            <div class="custom-form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
                <?php if ($hasErrors && isset($_SESSION['errors']['name'])): ?>
                    <p class="errors">
                        <?= $_SESSION['errors']['name'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="custom-form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <?php if ($hasErrors && isset($_SESSION['errors']['email'])): ?>
                    <p class="errors">
                        <?= $_SESSION['errors']['email'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="custom-form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone">
                <?php if ($hasErrors && isset($_SESSION['errors']['phone'])): ?>
                    <p class="errors">
                        <?= $_SESSION['errors']['phone'] ?>
                    </p>
                <?php endif; ?>

                <div class="custom-form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <?php if ($hasErrors && isset($_SESSION['errors']['password'])): ?>
                        <p class="errors">
                            <?= $_SESSION['errors']['password'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="custom-form-group">
                    <label for="confirm_password">Confirm password</label>
                    <input type="password" name="confirm_password" id="confirm_password">
                    <?php if ($hasErrors && isset($_SESSION['errors']['confirm_password'])): ?>
                        <p class="errors">
                            <?= $_SESSION['errors']['confirm_password'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <button type="submit" class="custom-btn">Register</button>
        </form>
    </div>

    <?php

    unset($_SESSION['status']);
    unset($_SESSION['errors']);
    unset($_SESSION['message']);

    ?>

</body>

</html>