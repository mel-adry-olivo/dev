<?php

require '../../includes/db-utils.php';

$conn = require '../../includes/db-conn.php';

$id = $_GET['id'];
$product = getProductById($conn, $id);

header('Content-Type: application/json');
echo json_encode(getProductById($conn, $id));
exit();