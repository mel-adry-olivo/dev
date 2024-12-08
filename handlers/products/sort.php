<?php

require '../../includes/db-utils.php';

$conn = require '../../includes/db-conn.php';
$type = $_GET['type'];
$sortOrder = $_GET['sortOrder'];

header('Content-Type: application/json');
echo json_encode(getSortedProducts($conn, $type, $sortOrder));
exit();