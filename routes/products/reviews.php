<?php

session_start();

require '../../includes/config.php';
require '../../includes/db-utils.php';

$productId = $_POST['product_id']; 
$action = $_GET['action'];

$userId = $_SESSION['user_id'] ?? null;

if($action === 'create') {
    $review = [
        'product_id' => $productId,
        'user_id' => $userId,
        'rating' => $_POST['rating'],
        'review_text' => $_POST['text'],  
    ];

    createProductReview($review);
}

header('Location: ' . $_SERVER['HTTP_REFERER' ?? './../index.php']);
exit();