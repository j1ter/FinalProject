<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <?php require_once 'common/inhead.php' ?>
</head>

<body>

    <?php session_start(); ?>

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
                <input type="email" name="email" id="email">
                <?php if ($hasError && isset($_SESSION['errors']['email'])): ?>
                    <p class='errors'>
                        <?= $_SESSION['errors']['email'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="custom-form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
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