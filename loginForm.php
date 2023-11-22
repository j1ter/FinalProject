<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body {
            padding: 20px;
            font-family: 'Arial', sans-serif;
        }

        .centerForm {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .success {
            color: green;
            margin-bottom: 20px;
        }

        .mainError {
            color: red;
            margin-bottom: 20px;
        }

        button {
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
        }

        input[type="checkbox"] {
            margin-right: 5px;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }
    </style>
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