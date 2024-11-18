<?php

require '../../includes/config.php';
require '../../includes/db-utils.php';

$type = $_GET['type'];

header('Content-Type: application/json');
echo json_encode(getProductsbyType($type));
exit();