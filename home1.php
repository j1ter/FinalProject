<?php
session_start();

require_once 'common/checkAuth.php';
require_once 'common/connect.php';

$category = getCategory();

$approveProperties = getProperty('approve');

// Step 1: Add the search logic
$search = $_POST['search'] ?? '';

if ($search) {
    $approveProperties = searchProperties($search);
} else {
    $cat_id = $_GET['cat_id'] ?? '';

    if ($cat_id) {
        $approveProperties = getPropertyByCategory($cat_id);
    } else {
        $approveProperties = getProperty();
    }
}


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
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Buy or rent property</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div>
                    <form method="post" action="home1.php">
                        <input type="text" name="search" placeholder="Search properties">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-12 col-sm-3">
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i>
                            Categories
                        </div>
                        <ul class="list-group category_block">
                            <?php foreach ($category as $cat): ?>
                                <li class="list-group-item"><a href="home1.php?cat_id=<?= $cat['id'] ?>">
                                        <?= $cat['name'] ?>
                                    </a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="row">
                        <?php if (empty($approveProperties)): ?>
                            <div class="col-lg-12">
                                <h3>No property found:(</h3>
                            </div>
                        <?php endif; ?>


                        <div class="container">
                            <div class="row row-cols-4 row-cols-md-2 g-4">
                                <?php foreach ($approveProperties as $prop): ?>

                                    <article class="popular__card">
                                        <a href="oneProperty.php?property_id=<?= $prop['id'] ?>">
                                            <img src="https://localhost/Project/images/properties/<?= $prop['pimage'] ?>"
                                                alt="" class="popular__img" />
                                        </a>
                                        <div class="popular__data">
                                            <h2 class="popular__price"><span>$</span>
                                                <?= $prop['price'] ?>$
                                            </h2>
                                            <h3 class="popular__title">
                                                <?= $prop['title'] ?>
                                            </h3>
                                            <p class="popular__description">
                                                <?= $prop['location'] ?>
                                            </p>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>



        <!-- Footer-->
        <footer class="footer section">
            <div class="footer__container container grid">
                <div>
                    <a href="#" class="footer__logo">
                        Luxoria <i class="bx bxs-home-alt-2"></i>
                    </a>
                    <p class="footer__description">
                        Наше видение — сделать всех людей <br />
                        лучшее место для жизни для них.
                    </p>
                </div>

                <div class="footer__content">
                    <div>
                        <h3 class="footer__title">About</h3>

                        <ul class="footer__links">
                            <li>
                                <a href="#" class="footer__link">About Us</a>
                            </li>
                            <li>
                                <a href="#" class="footer__link">Features</a>
                            </li>
                            <li>
                                <a href="#" class="footer__link">News & Blog</a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="footer__title">Company</h3>

                        <ul class="footer__links">
                            <li>
                                <a href="#" class="footer__link">How We Work?</a>
                            </li>
                            <li>
                                <a href="#" class="footer__link">Capital</a>
                            </li>
                            <li>
                                <a href="#" class="footer__link">Security</a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="footer__title">Support</h3>

                        <ul class="footer__links">
                            <li>
                                <a href="#" class="footer__link">FAQs</a>
                            </li>
                            <li>
                                <a href="#" class="footer__link">Support center</a>
                            </li>
                            <li>
                                <a href="#" class="footer__link">Contact Us</a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="footer__title">Follow us</h3>

                        <ul class="footer__social">
                            <a href="https://t.me/bahontish" target="_blank" class="footer__social-link">
                                <i class="bx bxl-telegram"></i>
                            </a>

                            <a href="https://www.instagram.com/bahontish" target="_blank" class="footer__social-link">
                                <i class="bx bxl-instagram-alt"></i>
                            </a>

                            <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                                <i class="bx bxl-facebook-square"></i>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer__info container">
                <span class="footer__copy">
                    &#169; AD. All rigths reserved
                </span>

                <div class="footer__privacy">
                    <a href="#">Terms & Agreements</a>
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
</body>

</html>