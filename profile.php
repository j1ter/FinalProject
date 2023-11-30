<?php

session_start();

require_once 'common/checkAuth.php';
require_once 'common/inhead.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <div class="container_profile">

        <div class="col-md-6 offset-md-3">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <h5 class="card-title">Profile</h5>
                </div>
                <div class="card-body custom-card-body">
                    <!-- Display user information -->
                    <?php if (!empty($user['avatar'])): ?>
                        <div class="text-center mb-3">
                            <img src="<?php echo $user['avatar']; ?>" alt="Avatar" class="img-fluid rounded-circle"
                                width="100">
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <strong>Email:</strong>
                        <?php echo $user['email']; ?>
                    </div>
                    <div class="mb-3">
                        <strong>Name:</strong>
                        <?php echo $user['name']; ?>
                    </div>
                    <div class="mb-3">
                        <strong>Phone:</strong>
                        <?php echo $user['phone'] ?: 'Not provided'; ?>
                    </div>

                    <!-- Logout button -->
                    <a href="logout.php" class="btn btn-danger custom-btn-logout">Logout</a>

                    <!-- Change Password button -->
                    <a href="change_passwordForm.php" class="btn btn-primary custom-btn-change-password">Change
                        Password</a>
                </div>
            </div>
        </div>

    </div>

</body>

</html>