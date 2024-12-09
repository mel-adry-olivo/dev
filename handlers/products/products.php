<?php

require '../../includes/db-functions.php';

$conn = require '../../includes/db-conn.php';
$type = $_GET['type'];

if($type === 'all') {
    $allProducts = getAllProducts($conn);
    header('Content-Type: application/json');
    echo json_encode($allProducts);
    exit();
}

$productsByType = getProductsbyType($conn, $type);

header('Content-Type: application/json');
echo json_encode($productsByType);
exit();