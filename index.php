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
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <link rel="preload" href="./assets/styles/fonts/Satoshi-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="./assets/styles/fonts/Satoshi-Light.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="./assets/styles/fonts/Satoshi-Medium.woff2" as="font" type="font/woff2" crossorigin>
    <link href="./assets/styles/global/global.css" rel="stylesheet"/>
    <link href="./assets/styles/global/components.css" rel="stylesheet"/>
    <link href="./assets/styles/pages/home.css" rel="stylesheet"/>
    <script type="module" src="./assets/js/pages/home.js" defer></script>
</head>
<body>
    <?php require './includes/components/header.php'?>
    <?php require './includes/components/action-menu.php'?>
    <section class="hero">
        <div class="hero__media-container">
            <video preload="metadata" playsinline autoplay loop muted class="hero__media" poster="./assets/images/hero-image.webp">
                <source src="./assets/images/hero-video.mp4" type="video/mp4"/>
            </video>
            <div class="hero__media-content">
                <div class="hero__headline-wrapper">
                    <h3 class="hero__headline-primary"><?php echo $heroHeadlinePrimary; ?></h3>
                    <h4 class="hero__headline-secondary"><?php echo $heroHeadlineSecondary; ?> </h4>
                </div>
                <div class="hero__text-block-right hero__cta">
                    <h5 class="hero__cta-text"><?php echo $heroCtaText; ?></h5>
                    <a href="./shop.php?type=all" class="button button--filled"><?php echo $heroCtaButtonText; ?></a>
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
                        <img src="assets/images/shapes/rectangle.webp" alt="Rectangle" class="shapes__item-image" loading="lazy" width="640" height="960"/>
                        <div class="shapes__item-link">
                            <div class="icon-container shapes__item-icon">
                                <?php echo getIcon('bag');?>
                            </div>
                            <span class="shapes__item-text">Rectangle</span>
                            <div class="shapes__item-arrow">
                                <?php echo getIcon('arrow-right'); ?>
                            </div>
                        </div>
                    </a>    
                    <a href="./shop.php?type=all&shape=Square" class="shapes__item" data-shape="Square">
                        <img src="assets/images/shapes/enirco.webp" alt="Square" class="shapes__item-image enirco" loading="lazy" width="640" height="692"/>
                        <div class="shapes__item-link">
                            <div class="icon-container shapes__item-icon">
                                <?php echo getIcon('bag');?>
                            </div> 
                            <span class="shapes__item-text">Square</span>
                            <div class="shapes__item-arrow">
                                <?php echo getIcon('arrow-right'); ?>
                            </div>
                        </div>
                    </a>    
                    <a href="./shop.php?type=all&shape=Round" class="shapes__item" data-shape="Round">
                        <img src="assets/images/shapes/round.webp" alt="Round" class="shapes__item-image" loading="lazy" width="640" height="692"/>
                        <div class="shapes__item-link">
                            <div class="icon-container shapes__item-icon">
                                <?php echo getIcon('bag');?>
                            </div> 
                            <span class="shapes__item-text">Round</span>
                            <div class="shapes__item-arrow">
                                <?php echo getIcon('arrow-right'); ?>
                            </div>
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
</body>
</html>