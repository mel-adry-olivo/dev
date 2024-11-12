<?php 

include './includes/test-data.php';
require './includes/functions.php';
require './includes/icons.php';
require './includes/db-connect.php';
require './includes/db-utils.php';

$title = "INSPEC®"; 
$heroHeadlinePrimary = "Redefining";
$heroHeadlineSecondary = "eyewear";
$heroCtaText = "Vision meets artistry.";
$heroCtaButtonText = "Shop now";
$shapesHeaderText = "Discover eyewear by shape—find frames that perfectly complement your unique look.";
$shapes = retrieveAllFrom('shape');
$trendingHeaderText = "Explore our top-trending eyewear styles and make a statement with every look.";

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/home.js" defer></script>
    <?php require './includes/style-loader.php'?>
</head>
<body>
    <?php require './includes/components/header.php'?>
    <?php require './includes/components/action-menu.php'?>
    <section class="hero">
            <div class="hero__media-container">
                <video playsinline autoplay loop muted src="./assets/images/hero-video.webm" class="hero__media" poster="./assets/images/hero-image.png"></video>
                <div class="hero__media-content">
                    <div class="hero__headline-wrapper">
                        <h1 class="hero__headline-primary"><?php echo $heroHeadlinePrimary; ?></h1>
                        <h2 class="hero__headline-secondary"><?php echo $heroHeadlineSecondary; ?> </h2>
                    </div>
                    <div class="hero__text-block-right hero__cta">
                        <h3 class="hero__cta-text"><?php echo $heroCtaText; ?></h3>
                        <button class="button button--filled hero__cta-button"><?php echo $heroCtaButtonText; ?></button>
                    </div>
                </div>
            </div>
        </section>
    <div class="wrapper">
        <section class="standard">
            <header class="standard__header">
                <h4 class="standard__header-text"><?php echo $shapesHeaderText; ?></h4>
            </header> 
            <main class="standard__content">
                <div class="shapes__grid">
                    <?php foreach ($shapes as $shape) { createShapeItem($shape); }?>  
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
                        <?php foreach ($products as $product) { createProductCard($product); }?>   
                        <div class="products__carousel-see-all">
                            <a href="#">See all products</a>
                        </div>
                    </div>
                    <div class="products__carousel-control-group">
                        <button class="icon-container products__carousel-control products__carousel-control--prev"><?php echo getIcon('arrow-left'); ?></button>
                        <button class="icon-container products__carousel-control products__carousel-control--next"><?php echo getIcon('arrow-right'); ?></button>
                    </div>
                </div>
            </main>
        </section>  
    </div>
</body>
</html>