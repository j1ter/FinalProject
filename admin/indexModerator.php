<?php

session_start();

require_once '../common/checkAuth.php';
require_once '../common/connect.php';

$category = getCategory();

$cat_id = $_GET['cat_id'] ?? '';

if ($cat_id)
    $propertys = getProperty($cat_id);
else
    $propertys = getProperty();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Home page</title>
    <?php require_once '../common/inhead.php'; ?>
</head>

<body>
    <?php require_once '../common/navModerator.php' ?>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Welcome Moderator!</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>

    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories
                    </div>
                    <ul class="list-group category_block">


                        <?php foreach ($category as $cat): ?>
                            <li class="list-group-item"><a href="index.php?cat_id=<?= $cat['id'] ?>">
                                    <?= $cat['name'] ?>
                                </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8">


                <div class="row">
                    <?php if (empty($propertys)): ?>
                        <div class="col-lg-12">
                            <h3>No property found:(</h3>
                        </div>
                    <?php endif; ?>

                    <?php foreach ($propertys as $prop): ?>
                        <div class="col-lg-4 mb-4"> <!-- Adjust the grid size based on your preference -->
                            <div class="card">
                                <a href="#!"><img class="card-img-top"
                                        src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">
                                        <?= $prop['price'] ?>$
                                    </div>
                                    <h2 class="card-title h4">
                                        <?= $prop['title'] ?>
                                    </h2>
                                    <p class="card-text">
                                        <?= $prop['location'] ?>
                                    </p>
                                    <a class="btn btn-success" href="oneProperty.php?property_id=<?= $prop['id'] ?>">More
                                        details →</a>

                                    <!-- Если пользователь является владельцем объекта, отображаем кнопки редактирования и удаления -->
                                    <a class="btn btn-success"
                                        href="../editPropertyForm.php?property_id=<?= $prop['id'] ?>">Edit</a>
                                    <?php if ($prop['user_id'] == $user['id']): ?>

                                        <a class="btn btn-primary"
                                            href="editPropertyForm.php?property_id=<?= $prop['id'] ?>">Edit →</a>

                                        <form onsubmit="return confirm('Really want to delete?')" action="../deleteForm.php"
                                            method="post">
                                            <input type="hidden" name="property_id" value="<?= $prop['id'] ?>">
                                            <button class="btn btn-danger" type="submit">
                                                Delete
                                            </button>
                                        </form>

                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>


        </div>
    </div>



    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
</body>

</html>