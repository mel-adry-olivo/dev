<?php

session_start();

require '../../includes/db-functions.php';
require '../image.php';
$conn = require '../../includes/db-conn.php';
$uploadDir = "../../assets/images/products/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// product input
$brand = getOrCreateBrand($conn, $_POST['product-brand'], $_POST['product-brand-input']);
$name = $_POST['product-name'] ?? '';
$price = $_POST['product-price'] ?? 0;
$type = $_POST['product-type'] ?? ''; 
$lensWidth = $_POST['product-lens-width'] ?? 0;
$bridgeWidth = $_POST['product-bridge-width'] ?? 0;
$templeLength = $_POST['product-temple-length'] ?? 0;

// images input
$image1Path = $image1Path = uploadImage($_FILES['product-image'], $uploadDir, $name, $brand['name'], '0');
$image2Path = $image2Path = uploadImage($_FILES['product-image2'], $uploadDir, $name, $brand['name'], '1');

// product attributeIds input
$genderId = $_POST['product-gender'] ?? '';
$frameTypeId = $_POST['product-frame-type'] ?? '';
$shapeId = getOrCreateAttribute($conn, 1, $_POST['product-shape'], $_POST['product-shape-input']);
$colorId = getOrCreateAttribute($conn, 2, $_POST['product-color'], $_POST['product-color-input']);
$materialId = getOrCreateAttribute($conn, 3, $_POST['product-material'], $_POST['product-material-input']);

// bundle and add to db
$product = [
    "brand_id" => $brand['brand_id'],
    "name" => $name,
    "price" => $price,
    "type" => $type,
    "lens_width" => $lensWidth,
    "bridge_width" => $bridgeWidth,
    "temple_length" => $templeLength,
    "image_main" => $image1Path,
    "image_alternate" => $image2Path,
];

$productId = addProduct($conn, $product);

// bundled to iterate product attributes
$inputAttributes = [
    $frameTypeId,
    $shapeId,
    $colorId,
    $materialId, 
    $genderId
];

foreach($inputAttributes as $attributeId) {
    addProductAttribute($conn, $productId, $attributeId);
}

header('Location: ../../manage.php');
exit();

