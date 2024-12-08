<?php

require '../../includes/db-utils.php';

$conn = require '../../includes/db-conn.php';
$data = file_get_contents('php://input');
$decodedData = json_decode($data, true);
$type = $_GET['type'];

if(empty($decodedData)) {
    if($type === 'all') {
        $allProducts = 
        header('Content-Type: application/json');
        echo json_encode(getAllProducts($conn));
        exit();
    } else {
        $productsByType = getProductsbyType($conn, $type);
        header('Content-Type: application/json');
        echo json_encode($productsByType);
        exit();
    }
}



$filteredProducts = getFilteredProducts($conn, $type, $decodedData);

header('Content-Type: application/json');
echo json_encode($filteredProducts);
exit();