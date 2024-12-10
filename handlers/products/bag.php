<?php

session_start();

require '../../includes/db-functions.php';

$conn = require '../../includes/db-conn.php';
$userId = $_SESSION['user_id'] ?? null;
$productID = $_POST['product_id'];


if(isset($_POST['add'])) {
    if(isProductInBag($conn, $productID, $userId)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        $_SESSION['in_bag'] = true;
        exit();
    }
    addProductToBag($conn, $productID, $userId);
}

if(isset($_POST['remove'])) {
    removeProductFromBag($conn, $productID, $userId);
}

if(isset($_POST['reserve']))  {
    reserveBagProducts($conn, $userId);
    header('Location: ../../reservations.php');
    exit();
}


header('Location: ../../summary.php');
exit();