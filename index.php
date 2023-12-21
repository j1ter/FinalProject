<?php

session_start();

require_once 'common/checkAuth.php';
require_once 'common/connect.php';

$category = getCategory();

$cat_id = $_GET['cat_id'] ?? '';

if ($cat_id)
    $propertys = getProperty($cat_id);
else
    $propertys = getProperty();

$approveProperties = getProperty('approve');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>House Empire</title>
    <?php require_once 'common/inhead.php'; ?>
</head>

<body>
    <?php require_once 'common/header.php' ?>


    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home section" id="home">
            <div class="home__container container grid">
                <div class="home__data">
                    <h1 class="home__title">
                        Discover <br />
                        Most Suitable <br />
                        Property
                    </h1>
                    <p class="home__description">
                        Find a varietly of properties that suit you very easily, forget
                        all difficulties in finding a residence for you
                    </p>

                    <!-- <form action="" class="home__search">
                        <i class="bx bxs-map"></i>
                        <input type="search" placeholder="Search by location..." class="home__search-input" />
                        <button class="button">Search</button>
                    </form> -->

                    <div class="home__value">
                        <div>
                            <h1 class="home__value-number">9K <span>+</span></h1>
                            <span class="home__value-description">
                                Premium <br />
                                Product
                            </span>
                        </div>

                        <div>
                            <h1 class="home__value-number">2K <span>+</span></h1>
                            <span class="home__value-description">
                                Happy <br />
                                Customer
                            </span>
                        </div>

                        <div>
                            <h1 class="home__value-number">28K <span>+</span></h1>
                            <span class="home__value-description">
                                Awaards <br />
                                Winning
                            </span>
                        </div>
                    </div>
                </div>

                <div class="home__images">
                    <div class="home__orbe"></div>

                    <div class="home__img"><img src="assets/img/home.jpg" /></div>
                </div>
            </div>
        </section>

        <!--==================== LOGOS ====================-->
        <section class="logos section">
            <div class="logos__container container grid">
                <div class="logos__img">
                    <img src="assets/img/logo1.png" alt="" />
                </div>
                <div class="logos__img">
                    <img src="assets/img/logo2.png" alt="" />
                </div>
                <div class="logos__img">
                    <img src="assets/img/logo3.png" alt="" />
                </div>
                <div class="logos__img">
                    <img src="assets/img/logo4.png" alt="" />
                </div>
            </div>
        </section>

        <!--==================== POPULAR ====================-->
        <section class="popular section" id="popular">
            <div class="container">
                <span class="section__subtitle">Best Choise</span>
                <h2 class="section__title">Popular Residences<span>.</span></h2>
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
                                    <img src="https://localhost/Project/images/properties/<?= $prop['pimage'] ?>" alt=""
                                        class="popular__img" />
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
        </section>
        <!--==================== VALUE ====================-->
        <section class="value section" id="value">
            <div class="value__container container grid">
                <div class="value__images">
                    <div class="value__orbe"></div>

                    <div class="value__img">
                        <img src="assets/img/value.jpg" alt="" />
                    </div>
                </div>

                <div class="value__content">
                    <div class="value__data">
                        <span class="section__subtitle">Our Value</span>
                        <h2 class="section__title">Value We Give To You<span>.</span></h2>
                        <p class="value__description">
                            We always ready to help by providing the best service for you.
                            We believe a good place to live can make your life better.
                        </p>
                    </div>

                    <div class="value__accordion">
                        <div class="value__accordion-item">
                            <header class="value__accordion-header">
                                <i class="bx bxs-shield-x value__accordion-icon"></i>
                                <h3 class="value__accordion-title">
                                    Best interest rates on the market
                                </h3>
                                <div class="value__accordion-arrow">
                                    <i class="bx bxs-down-arrow"></i>
                                </div>
                            </header>

                            <div class="value__accordion-content">
                                <p class="value__accordion-description">
                                    Price we provides is the best for you, we guarantee no price
                                    changes on your property due to various unexpected costs
                                    that may come.
                                </p>
                            </div>
                        </div>

                        <div class="value__accordion-item">
                            <header class="value__accordion-header">
                                <i class="bx bxs-x-square value__accordion-icon"></i>
                                <h3 class="value__accordion-title">
                                    Prevent unstable prices
                                </h3>
                                <div class="value__accordion-arrow">
                                    <i class="bx bxs-down-arrow"></i>
                                </div>
                            </header>

                            <div class="value__accordion-content">
                                <p class="value__accordion-description">
                                    Price we provides is the best for you, we guarantee no price
                                    changes on your property due to various unexpected costs
                                    that may come.
                                </p>
                            </div>
                        </div>

                        <div class="value__accordion-item">
                            <header class="value__accordion-header">
                                <i class="bx bxs-bar-chart-square value__accordion-icon"></i>
                                <h3 class="value__accordion-title">
                                    Best prices on the market
                                </h3>
                                <div class="value__accordion-arrow">
                                    <i class="bx bxs-down-arrow"></i>
                                </div>
                            </header>

                            <div class="value__accordion-content">
                                <p class="value__accordion-description">
                                    Price we provides is the best for you, we guarantee no price
                                    changes on your property due to various unexpected costs
                                    that may come.
                                </p>
                            </div>
                        </div>

                        <div class="value__accordion-item">
                            <header class="value__accordion-header">
                                <i class="bx bxs-check-square value__accordion-icon"></i>
                                <h3 class="value__accordion-title">Security of your data</h3>
                                <div class="value__accordion-arrow">
                                    <i class="bx bxs-down-arrow"></i>
                                </div>
                            </header>

                            <div class="value__accordion-content">
                                <p class="value__accordion-description">
                                    Price we provides is the best for you, we guarantee no price
                                    changes on your property due to various unexpected costs
                                    that may come.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--==================== CONTACT ====================-->
        <section class="contact section" id="contact">
            <div class="contact__container container grid">
                <div class="contact__images">
                    <div class="contact__orbe"></div>

                    <div class="contact__img">
                        <img src="assets/img/contact.png" alt="" />
                    </div>
                </div>

                <div class="contact__content">
                    <div class="contact__data">
                        <span class="section__subtitle">Contact us</span>
                        <h2 class="section__title">Easy to Contact us<span>.</span></h2>
                        <p class="contact__description">
                            Is there a problem finding your dream home? Need a guide in
                            buying first home? or need a consultation on residential issues?
                            just contact us.
                        </p>
                    </div>

                    <div class="contact__card">
                        <div class="contact__card-box">
                            <div class="contact__card-info">
                                <i class="bx bxs-phone-call"></i>
                                <div>
                                    <h3 class="contact__card-title">Call</h3>
                                    <p class="contact__card-description">022.321.165.19</p>
                                </div>
                            </div>

                            <button class="button contact__card-button">Call Now</button>
                        </div>

                        <div class="contact__card-box">
                            <div class="contact__card-info">
                                <i class="bx bxs-message-rounded-dots"></i>
                                <div>
                                    <h3 class="contact__card-title">Chat</h3>
                                    <p class="contact__card-description">022.321.165.19</p>
                                </div>
                            </div>

                            <button class="button contact__card-button">Chat Now</button>
                        </div>

                        <div class="contact__card-box">
                            <div class="contact__card-info">
                                <i class="bx bxs-video"></i>
                                <div>
                                    <h3 class="contact__card-title">Video Call</h3>
                                    <p class="contact__card-description">022.321.165.19</p>
                                </div>
                            </div>

                            <button class="button contact__card-button">
                                Video Call Now
                            </button>
                        </div>

                        <div class="contact__card-box">
                            <div class="contact__card-info">
                                <i class="bx bxs-envelope"></i>
                                <div>
                                    <h3 class="contact__card-title">Message</h3>
                                    <p class="contact__card-description">022.321.165.19</p>
                                </div>
                            </div>

                            <button class="button contact__card-button">Message Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--==================== SUBSCRIBE ====================-->
        <section class="subscribe section">
            <div class="subscribe__container container">
                <h1 class="subscribe__title">Get Started with Luxoria</h1>
                <p class="subscribe__description">
                    Subscribe and find super attractive price quotes from us, Find your
                    residence soon
                </p>
                <a href="#" class="button subscribe__button"> Get Started </a>
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
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

    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="bx bx-chevrons-up"></i>
    </a>


</body>

</html>