<?php

session_start();

require '../../includes/config.php';
require '../../includes/db-utils.php';


if(isset($_POST['add'])) {
    $userId = $_SESSION['user_id'] ?? null;
    $productID = $_POST['product_id'];
    if(isProductInBag($productID, $userId)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        $_SESSION['in_bag'] = true;
        exit();
    }
    addProductToBag($productID, $userId);
}

if(isset($_POST['remove'])) {
    $userId = $_SESSION['user_id'] ?? null;
    $productID = $_POST['product_id'];
    removeProductFromBag($productID, $userId);
}

if(isset($_POST['reserve']))  {
    $userId = $_SESSION['user_id'] ?? null;
    reserveBagProducts($userId);
    header('Location: ../../index.php');
    exit();
}


header('Location: ../../summary.php');
exit();