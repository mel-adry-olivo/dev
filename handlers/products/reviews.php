<?php

session_start();

require '../../includes/db-functions.php';
$conn = require '../../includes/db-conn.php';

$productId = $_POST['product_id'] ?? ''; 
$action = $_POST['action'] ?? '';
$reviewId = $_POST['review_id'] ?? '';
$userId = $_SESSION['user_id'] ?? '';

if($action === 'create') {
    $review = [
        'product_id' => $productId,
        'user_id' => $userId,
        'rating' => $_POST['rating'],
        'review_text' => $_POST['text'],  
    ];
    createProductReview($conn, $review);
} else if ($action === 'remove') {
    removeProductReview($conn, $reviewId);
}

header('Location: ' . $_SERVER['HTTP_REFERER' ?? './../index.php']);
exit();