<?php

session_start();

require '../../includes/config.php';
require '../../includes/db-utils.php';

$data = file_get_contents('php://input'); 
$body = json_decode($data, true);

$productId = $body['productId']; 
$action = $body['action'];

$userId = $_SESSION['user_id'] ?? null;

if($action === 'add') {
    addProductFavorite($productId, $userId);
} else if($action === 'remove') {
    removeProductFavorite($productId, $userId);
}

header('Content-Type: application/json');
echo json_encode(['success' => true]);