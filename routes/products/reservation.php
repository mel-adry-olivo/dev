<?php

session_start();

require '../../includes/config.php';
require '../../includes/db-utils.php';


if(isset($_POST['remove'])) {
    $userId = $_SESSION['user_id'] ?? null;
    $productID = $_POST['product_id'];
    removeProductFromReservations($productID, $userId);
}

header('Location: ../../reservations.php');
exit();