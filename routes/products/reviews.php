<?php

session_start();

require '../../includes/config.php';
require '../../includes/db-utils.php';

$productId = $_POST['product_id'] ?? ''; 
$action = $_POST['action'] ?? '';
$reviewId = $_POST['review_id'] ?? '';
$userId = $_SESSION['user_id'] ?? '';

var_dump($productId, $action, $reviewId, $userId);

if($action === 'create') {
    $review = [
        'product_id' => $productId,
        'user_id' => $userId,
        'rating' => $_POST['rating'],
        'review_text' => $_POST['text'],  
    ];
    createProductReview($review);
} else if ($action === 'remove') {
    removeProductReview($reviewId);
}

header('Location: ' . $_SERVER['HTTP_REFERER' ?? './../index.php']);
exit();