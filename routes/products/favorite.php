<?php

require '../../includes/config.php';
require '../../includes/db-utils.php';

$data = file_get_contents('php://input');
$body = json_decode($data, true);

$productId = $body['productId']; 
$action = $body['action'];

if($action === 'add') {
    addProductFavorite($productId);
} else if($action === 'remove') {
    removeProductFavorite($productId);
}

header('Content-Type: application/json');
echo json_encode(['success' => true]);