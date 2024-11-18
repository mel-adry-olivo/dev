<?php

require '../../includes/config.php';
require '../../includes/db-utils.php';

$id = $_GET['id'];

header('Content-Type: application/json');
echo json_encode(getProductById($id));
exit();