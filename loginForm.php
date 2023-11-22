<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>

<body>

    <?php session_start(); ?>

    <?php

    $hasError = false;
    if (isset($_SESSION['status']) && $_SESSION['status'] == 'error')
        $hasError = true;

    ?>

    <div class="centerForm">
        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'success'): ?>
            <div class="success">
                <?= $_SESSION['message'] ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'mainError'): ?>
            <div class="mainError">
                <?= $_SESSION['message'] ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <?php if ($hasError && isset($_SESSION['errors']['email'])): ?>
                    <p>
                        <?= $_SESSION['errors']['email'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <?php if ($hasError && isset($_SESSION['errors']['password'])): ?>
                    <p>
                        <?= $_SESSION['errors']['password'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember" value="yes">
                Remember me
            </div>
            <button type="submit">Login</button>
        </form>



        <?php

        unset($_SESSION['status']);
        unset($_SESSION['errors']);
        unset($_SESSION['message']);

        ?>

</body>

</html>