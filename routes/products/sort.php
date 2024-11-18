<?php

require '../../includes/config.php';
require '../../includes/db-utils.php';

$type = $_GET['type'];
$sortOrder = $_GET['sortOrder'];

header('Content-Type: application/json');
echo json_encode(getSortedProducts($type, $sortOrder));
exit();