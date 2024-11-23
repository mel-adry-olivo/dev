<?php

session_start();

require '../../includes/config.php';
require '../../includes/db-utils.php';

var_dump($_POST);

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



header('Location: ../../summary.php');
exit();