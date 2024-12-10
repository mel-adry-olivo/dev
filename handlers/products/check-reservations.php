<?php

session_start();

require '../../includes/db-functions.php';
$conn = require '../../includes/db-conn.php';


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $reserved = isProductReserved($conn, $id, $_SESSION['user_id']);
}

echo json_encode(['reserved' => $reserved]);
exit();
