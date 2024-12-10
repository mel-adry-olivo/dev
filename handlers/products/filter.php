<?php

require '../../includes/icons.php';
require '../../includes/db-functions.php';
require '../../includes/ui-components.php';

$conn = require '../../includes/db-conn.php';
$data = file_get_contents('php://input');
$decodedData = json_decode($data, true);
$type = $_GET['type'];

if(empty($decodedData)) {
    if($type === 'all') {

        $allProducts = getAllProducts($conn);
        $allProductsHTML = '';
        foreach($allProducts as $product) {
            $allProductsHTML .= createProductCard($conn, $product);
        }
        echo $allProductsHTML;
        exit();

    } else {

        $productsByType = getProductsbyType($conn, $type);
        $productsByTypeHTML = '';

        foreach($productsByType as $product) {
            $productsByTypeHTML .= createProductCard($conn, $product);
        }

        echo $productsByTypeHTML;
        exit();
    }
}

$filteredProducts = getFilteredProducts($conn, $type, $decodedData);
$filteredProductsHTML = '';

foreach($filteredProducts as $product) {
    $filteredProductsHTML .= createProductCard($conn, $product);
}


echo $filteredProductsHTML;
exit();