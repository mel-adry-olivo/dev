<?php

session_start();

require '../../includes/db-functions.php';

$conn = require '../../includes/db-conn.php';
$data = file_get_contents('php://input'); 
$body = json_decode($data, true);

$productId = $body['productId']; 
$action = $body['action'];
$userId = $_SESSION['user_id'] ?? null;

if($action === 'add') {
    addProductFavorite($conn, $productId, $userId);
} else if($action === 'remove') {
    removeProductFavorite($conn, $productId, $userId);
}

header('Content-Type: application/json');
echo json_encode(['success' => true]);
exit();