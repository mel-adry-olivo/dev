<?php 

$currentPage = basename($_SERVER['PHP_SELF'],".php");

// fonts
$satoshi = '<link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet"/>';
$source_serif = '<link href="https://fonts.cdnfonts.com/css/source-serif-pro" rel="stylesheet"/>';

// css
$root = '<link href="./assets/styles/global/root.css" rel="stylesheet"/>';
$global = '<link href="./assets/styles/global/global.css" rel="stylesheet"/>';
$header = '<link href="./assets/styles/components/header.css" rel="stylesheet"/>';
$footer = '<link href="./assets/styles/components/footer.css" rel="stylesheet"/>';
$productCard = '<link href="./assets/styles/components/product-card.css" rel="stylesheet"/>';
$productCarousel = '<link href="./assets/styles/components/product-carousel.css" rel="stylesheet"/>';
$actionOverlay = '<link href="./assets/styles/components/action-menu.css" rel="stylesheet"/>';

$home = '<link href="./assets/styles/home.css" rel="stylesheet"/>';
$shop = '<link href="./assets/styles/shop.css" rel="stylesheet"/>';
$productPage = '<link href="./assets/styles/product.css" rel="stylesheet"/>';

echo $satoshi, $source_serif, $root, $global, $header, $footer, $productCard, $productCarousel, $actionOverlay;

if($currentPage == 'index') {
    echo $home;
} else if ($currentPage == 'shop') {
    echo $shop;
} else if ($currentPage == 'product') {
    echo $productPage;
}