<?php 

$currentPage = basename($_SERVER['PHP_SELF'],".php");

// fonts
$satoshi = '<link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet"/>';
$source_serif = '<link href="https://fonts.cdnfonts.com/css/source-serif-pro" rel="stylesheet"/>';

// css
$root = '<link href="./assets/styles/global/root.css" rel="stylesheet"/>';
$global = '<link href="./assets/styles/global/global.css" rel="stylesheet"/>';
$header = '<link href="./assets/styles/components/header.css" rel="stylesheet"/>';
$product = '<link href="./assets/styles/components/product.css" rel="stylesheet"/>';
$actionOverlay = '<link href="./assets/styles/components/action-menu.css" rel="stylesheet"/>';

$home = '<link href="./assets/styles/home.css" rel="stylesheet"/>';
$shop = '<link href="./assets/styles/shop.css" rel="stylesheet"/>';

if($currentPage == 'index') {
    echo $satoshi, $source_serif, $root, $global, $header, $home, $product, $actionOverlay;
} else if ($currentPage == 'shop') {
    echo $satoshi, $source_serif, $root, $global, $header, $shop, $product, $actionOverlay;
}