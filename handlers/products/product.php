<?php

require '../../includes/db-utils.php';

$conn = require '../../includes/db-conn.php';

$id = $_GET['id'];
$product = getProductById($conn, $id);
$productAttributes = getProductAttributesByID($conn, $id);

$productDetail = array_merge($product, $productAttributes);

header('Content-Type: application/json');
echo json_encode($productDetail);
exit();