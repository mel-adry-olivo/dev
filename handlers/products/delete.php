<?php 

session_start();

require '../../includes/db-functions.php';

$conn = require '../../includes/db-conn.php';
$productId = $_GET['id'] ?? null;   
echo $productId;

$product = getProductById($conn, $productId);

if ($product) {
    if ($product['image_main'] && file_exists($product['image_main'])) {
        unlink($product['image_main']);
    }
    if ($product['image_alternate'] && file_exists($product['image_alternate'])) {
        unlink($product['image_alternate']);
    }
}

deleteFromReviews($conn, $productId);
deleteFromReservations($conn, $productId);
deleteFromBag($conn, $productId);
deleteFromFavorites($conn, $productId);
deleteProductAttributes($conn, $productId);
deleteProduct($conn, $productId);

header('Location: ../../manage.php');
exit();

