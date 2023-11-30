<?php

session_start();

require_once 'common/checkAuth.php';
require_once 'common/connect.php';

$property_id = $_GET['property_id'] ?? '';

if ($property_id)
    $property = getOneProperty($property_id);






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Home page</title>
    <?php require_once 'common/inhead.php'; ?>
</head>

<body>
    <?php require_once 'common/header.php' ?>
    <!-- Header-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                        src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
                <div class="col-md-6">

                    <h1 class="display-5 fw-bolder">
                        <?= $property['title'] ?>
                    </h1>
                    <div class="fs-5 mb-5">

                        <span>
                            <?= $property['price'] ?>$
                        </span>
                    </div>
                    <div class="small mb-1">City:
                        <?= $property['city'] ?>
                    </div>
                    <div class="small mb-1">Location:
                        <?= $property['location'] ?>
                    </div>
                    <div class="small mb-1">Status:
                        <?= $property['status'] ?>
                    </div>
                    <div class="small mb-1">Area size:
                        <?= $property['asize'] ?> m²
                    </div>
                    <p class="lead">
                        <?= $property['pcontent'] ?>
                    </p>
                    <div class="d-flex">

                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Buy now
                        </button>
                    </div>
                </div>
            </div>
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