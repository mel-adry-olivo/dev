<?php

require '../../includes/db-functions.php';
require '../../includes/ui-components.php';
require '../../includes/icons.php';

$conn = require '../../includes/db-conn.php';

$id = $_GET['id'];
$product = getProductById($conn, $id);
$productAttributes = getProductAttributesByID($conn, $id);

if(isset($_GET['type']) && $_GET['type'] === 'favorite') {
    $productHTML = createFavoriteCard($product);

    echo $productHTML;
    exit();
}


$productDetail = array_merge($product, $productAttributes);

header('Content-Type: application/json');
echo json_encode($productDetail);
exit();