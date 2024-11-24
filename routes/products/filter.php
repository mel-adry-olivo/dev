<?php

require '../../includes/config.php';
require '../../includes/db-utils.php';

$data = file_get_contents('php://input');
$decodedData = json_decode($data, true);
$type = $_GET['type'];

if(empty($decodedData)) {
    if($type === 'all') {
        header('Content-Type: application/json');
        echo json_encode(getAllProducts());
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode(getProductsbyType($type));
        exit();
    }
}



$filteredProducts = getFilteredProducts($type, $decodedData);

header('Content-Type: application/json');
echo json_encode($filteredProducts);
exit();