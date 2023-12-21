<?php

session_start();

if (isset($_COOKIE['remember_email']) && isset($_COOKIE['remember_password'])) {
    $remember_email = $_COOKIE['remember_email'];
    $remember_password = $_COOKIE['remember_password'];
} else {
    $remember_email = '';
    $remember_password = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <?php require_once 'common/inhead.php' ?>
    <style>
        .custom-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
    </style>
</head>

<body>
    <?php
    $registrationMessage = isset($_GET['registration']) ? $_GET['registration'] : '';
    $loginMessage = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    ?>


    <?php

    $hasError = false;
    if (isset($_SESSION['status']) && $_SESSION['status'] == 'error')
        $hasError = true;

    ?>

    <div class="custom-centerForm" style="margin-top: 200px;">
        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'success'): ?>
            <div class="custom-success">
                <?= $_SESSION['message'] ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'mainError'): ?>
            <div class="custom-mainError">
                <?= $_SESSION['message'] ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="custom-form">
            <div class="custom-form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= $remember_email ?>">
                <?php if ($hasError && isset($_SESSION['errors']['email'])): ?>
                    <p class='errors'>
                        <?= $_SESSION['errors']['email'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="custom-form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="<?= $remember_password ?>">
                <?php if ($hasError && isset($_SESSION['errors']['password'])): ?>
                    <p class='errors'>
                        <?= $_SESSION['errors']['password'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="custom-form-group">
                <input type="checkbox" name="remember" value="yes">
                Remember me
                <a href="registerForm.php">Don't have account?</a>
            </div>
            <button type="submit" class="custom-btn">Login</button>
        </form>



        <?php

        unset($_SESSION['status']);
        unset($_SESSION['errors']);
        unset($_SESSION['message']);

        ?>

</body>

</html>