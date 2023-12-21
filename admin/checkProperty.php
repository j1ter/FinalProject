<?php
session_start();

require_once '../common/checkAuth.php';
require_once '../common/connect.php';

// Получаем список неподтвержденных объявлений
$unapprovedProperties = getProperty('pending');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... Ваши мета-теги и заголовок ... -->
    <title>Check Properties</title>
    <?php require_once '../common/inhead.php'; ?>
    <style>
        /* Добавим префикс "custom-" к пространству имен стилей */
        .custom-body {
            background-color: #f8f9fa;
        }

        .custom-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .custom-h2 {
            color: #343a40;
        }

        .custom-ul {
            list-style-type: none;
            padding: 0;
        }

        .custom-li {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 15px;
            background-color: #ffffff;
        }

        .custom-form {
            display: inline-block;
        }

        .custom-button {
            margin-left: 10px;
        }
    </style>
</head>

<body class="custom-body">
    <?php require_once '../common/navModerator.php' ?>
    <!-- Header-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5 custom-container">
            <?php if(!empty($unapprovedProperties)): ?>
                <h2 class="custom-h2">Unapproved Properties</h2>
                <ul class="custom-ul">
                    <?php foreach($unapprovedProperties as $property): ?>
                        <li class="custom-li">
                            <h3>
                                <?= $property['title'] ?>
                            </h3>
                            <p><strong>Price:</strong> $
                                <?= $property['price'] ?>
                            </p>
                            <p><strong>City:</strong>
                                <?= $property['city'] ?>
                            </p>
                            <p><strong>Location:</strong>
                                <?= $property['location'] ?>
                            </p>
                            <p><strong>Area Size:</strong>
                                <?= $property['asize'] ?> m²
                            </p>
                            <p>
                                <?= $property['pcontent'] ?>
                            </p>
                            <form action="moderator.php" method="post" class="custom-form">
                                <input type="hidden" name="property_id" value="<?= $property['id'] ?>">
                                <button type="submit" name="action" value="approve"
                                    class="btn btn-success custom-button">Approve</button>
                                <button type="submit" name="action" value="reject"
                                    class="btn btn-danger custom-button">Reject</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No unapproved properties found.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
</body>

</html>