<?php

require '../../includes/config.php';
require '../../includes/db-utils.php';

$type = $_GET['type'];
if($type === 'all') {
    header('Content-Type: application/json');
    echo json_encode(getAllProducts());
    exit();
}

header('Content-Type: application/json');
echo json_encode(getProductsbyType($type));
exit();