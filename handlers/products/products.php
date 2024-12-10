<?php

require '../../includes/icons.php';
require '../../includes/ui-components.php';
require '../../includes/db-functions.php';

$conn = require '../../includes/db-conn.php';
$type = $_GET['type'];

if($type === 'all') {
    $allProducts = getAllProducts($conn);
    $allProductsHTML = '';
    foreach($allProducts as $product) {
        $allProductsHTML .= createProductCard($conn, $product);
    }
    echo $allProductsHTML;
    exit();
}

$productsByType = getProductsbyType($conn, $type);
$productsByTypeHTML = '';

foreach($productsByType as $product) {
    $productsByTypeHTML .= createProductCard($conn, $product);
}

echo $productsByTypeHTML;
exit();