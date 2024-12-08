<?php 

$currentPage = basename($_SERVER['PHP_SELF'],".php");

// fonts
$satoshi            = '<link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet"/>';
$source_serif       = '<link href="https://fonts.cdnfonts.com/css/source-serif-pro" rel="stylesheet"/>';

// css
$root               = '<link href="./assets/styles/global/root.css" rel="stylesheet"/>';
$global             = '<link href="./assets/styles/global/global.css" rel="stylesheet"/>';
$header             = '<link href="./assets/styles/components/header.css" rel="stylesheet"/>';
$footer             = '<link href="./assets/styles/components/footer.css" rel="stylesheet"/>';
$productCard        = '<link href="./assets/styles/components/product-card.css" rel="stylesheet"/>';
$productCarousel    = '<link href="./assets/styles/components/product-carousel.css" rel="stylesheet"/>';
$actionOverlay      = '<link href="./assets/styles/components/action-menu.css" rel="stylesheet"/>';
$forms              = '<link href="./assets/styles/components/forms.css" rel="stylesheet"/>';

$home               = '<link href="./assets/styles/home.css" rel="stylesheet"/>';
$shop               = '<link href="./assets/styles/shop.css" rel="stylesheet"/>';
$productPage        = '<link href="./assets/styles/product.css" rel="stylesheet"/>';
$summary            = '<link href="./assets/styles/summary.css" rel="stylesheet"/>';
$reservations       = '<link href="./assets/styles/reservations.css" rel="stylesheet"/>';
$login              = '<link href="./assets/styles/login.css" rel="stylesheet"/>';
$review             = '<link href="./assets/styles/review.css" rel="stylesheet"/>';
$manage             = '<link href="./assets/styles/manage.css" rel="stylesheet"/>';

echo 
$satoshi, $source_serif, $root, $global, $header, $footer, 
$productCard, $productCarousel, $actionOverlay, $forms;

if($currentPage == 'index') {
    echo $home;
} else if ($currentPage == 'shop') {
    echo $shop;
} else if ($currentPage == 'product') {
    echo $productPage;
} else if ($currentPage == 'summary') {
    echo $summary;
} else if ($currentPage == 'reservations') {
    echo $summary, $reservations;
} else if ($currentPage == 'login') {
    echo $login;
} else if ($currentPage == 'review') {
    echo $review;
} else if ($currentPage == 'manage') {
    echo $manage;
}