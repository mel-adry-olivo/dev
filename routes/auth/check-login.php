<?php

session_start();

$response = [];

if(isset($_SESSION['user_id'])) {
    $response = [
        'logged' => true,
        'user' => $_SESSION['user_id']
    ];
} else {
    $response = [
        'logged' => false
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
