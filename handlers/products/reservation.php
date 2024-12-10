<?php

session_start();

require '../../includes/db-functions.php';
$conn = require '../../includes/db-conn.php';

if(isset($_POST['remove'])) {
    $userId = $_SESSION['user_id'] ?? null;
    $productID = $_POST['product_id'];
    removeProductFromReservations($conn, $productID, $userId);
}

header('Location: ../../reservations.php');
exit();