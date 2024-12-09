<?php 

session_start();

require './includes/ui-components.php';
require './includes/icons.php';
require './includes/db-functions.php';

$conn = require './includes/db-conn.php';



$title = "INSPEC®"; 
$heroHeadlinePrimary = "Redefining";
$heroHeadlineSecondary = "eyewear";
$heroCtaText = "Vision meets artistry.";
$heroCtaButtonText = "Shop now";
$shapesHeaderText = "Discover eyewear by shape—find frames that perfectly complement your unique look.";
$trendingHeaderText = "Explore our top-trending eyewear styles and make a statement with every look.";


$popularProducts = getPopularProducts($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/pages/home.js" defer></script>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet"/>
    <link href="https://fonts.cdnfonts.com/css/source-serif-pro" rel="stylesheet"/>
    <link href="./assets/styles/global/global.css" rel="stylesheet"/>
    <link href="./assets/styles/global/components.css" rel="stylesheet"/>
    <link href="./assets/styles/pages/home.css" rel="stylesheet"/>
</head>
<body>
    <?php require './includes/components/header.php'?>
    <?php require './includes/components/action-menu.php'?>
    <section class="hero">
        <div class="hero__media-container">
            <video preload="none" playsinline autoplay loop muted src="./assets/images/hero-video.webm" class="hero__media" poster="./assets/images/hero-image.png"></video>
            <div class="hero__media-content">
                <div class="hero__headline-wrapper">
                    <h1 class="hero__headline-primary"><?php echo $heroHeadlinePrimary; ?></h1>
                    <h2 class="hero__headline-secondary"><?php echo $heroHeadlineSecondary; ?> </h2>
                </div>
                <div class="hero__text-block-right hero__cta">
                    <h3 class="hero__cta-text"><?php echo $heroCtaText; ?></h3>
                    <a href="./shop.php?type=all" class="button button--filled hero__cta-button"><?php echo $heroCtaButtonText; ?></a>
                </div>
            </div>
        </div>
    </section>
    <main class="wrapper">
        <section class="standard">
            <header class="standard__header">
                <h4 class="standard__header-text"><?php echo $shapesHeaderText; ?></h4>
            </header> 
            <main class="standard__content">
                <div class="shapes__grid">
                    <a href="./shop.php?type=all&shape=Rectangle" class="shapes__item" data-shape="Round">
                        <img src="assets/images/shapes/rectangle.png" alt="Rectangle" class="shapes__item-image">
                        <div class="shapes__item-link">
                            <div class="icon-container shapes__item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M18 6h-2c0-2.21-1.79-4-4-4S8 3.79 8 6H6c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2m-6-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2m6 16H6V8h2v2c0 .55.45 1 1 1s1-.45 1-1V8h4v2c0 .55.45 1 1 1s1-.45 1-1V8h2z"></path></svg></div>
                            <span class="shapes__item-text">Rectangle</span>
                            <div class="shapes__item-arrow"><svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="currentColor"><path d="M522-480 333-669l51-51 240 240-240 240-51-51 189-189Z"></path></svg></div>
                        </div>
                    </a>    
                    <a href="./shop.php?type=all&shape=Square" class="shapes__item" data-shape="Square">
                        <img src="assets/images/shapes/enirco.jpg" alt="Square" class="shapes__item-image enirco">
                        <div class="shapes__item-link">
                            <div class="icon-container shapes__item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M18 6h-2c0-2.21-1.79-4-4-4S8 3.79 8 6H6c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2m-6-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2m6 16H6V8h2v2c0 .55.45 1 1 1s1-.45 1-1V8h4v2c0 .55.45 1 1 1s1-.45 1-1V8h2z"></path></svg></div>
                            <span class="shapes__item-text">Square</span>
                            <div class="shapes__item-arrow"><svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="currentColor"><path d="M522-480 333-669l51-51 240 240-240 240-51-51 189-189Z"></path></svg></div>
                        </div>
                    </a>    
                    <a href="./shop.php?type=all&shape=Round" class="shapes__item" data-shape="Round">
                        <img src="assets/images/shapes/round.png" alt="Round" class="shapes__item-image">
                        <div class="shapes__item-link">
                            <div class="icon-container shapes__item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M18 6h-2c0-2.21-1.79-4-4-4S8 3.79 8 6H6c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2m-6-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2m6 16H6V8h2v2c0 .55.45 1 1 1s1-.45 1-1V8h4v2c0 .55.45 1 1 1s1-.45 1-1V8h2z"></path></svg></div>
                            <span class="shapes__item-text">Round</span>
                            <div class="shapes__item-arrow"><svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="currentColor"><path d="M522-480 333-669l51-51 240 240-240 240-51-51 189-189Z"></path></svg></div>
                        </div>
                    </a>  
                </div>            
            </main>
        </section>  
        <section class="standard">
            <header class="standard__header">
                <h4 class="standard__header-text"><?php echo $trendingHeaderText; ?></h4>
            </header>
            <main class="standard__content">
                <div class="products__showcase">
                    <div class="products__carousel">
                        <?php foreach($popularProducts as $product) createProductCard($conn, $product); ?>
                    </div>
                    <div class="products__carousel-control-group">
                        <button class="icon-container products__carousel-control products__carousel-control--prev"><?php echo getIcon('arrow-left'); ?></button>
                        <button class="icon-container products__carousel-control products__carousel-control--next"><?php echo getIcon('arrow-right'); ?></button>
                    </div>
                </div>
            </main>
        </section>  
    </main>
    <?php require './includes/components/footer.php'?>
    <?php include './includes/components/confirm-dialog.php';?>
    <div class="snackbar"></div>
    <div class="loader-container">
        <div class="loader"></div>
    </div>
</body>
</html>