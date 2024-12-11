<?php

session_start();

require '../../includes/db-functions.php';
require '../image.php';
$conn = require '../../includes/db-conn.php';
$uploadDir = "../../assets/images/products/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// get current product data
$productId = $_GET['id'] ?? null;
$product = getProductById($conn, $productId);

// product input if changed, else current
$brand = getOrCreateBrand($conn, $_POST['product-brand'], $_POST['product-brand-input']);
$name = $_POST['product-name'] ?? $product['name'];
$price = $_POST['product-price'] ?? $product['price'];
$type = $_POST['product-type'] ?? $product['type']; 
$lensWidth = $_POST['product-lens-width'] ?? $product['lens_width'];
$bridgeWidth = $_POST['product-bridge-width'] ?? $product['bridge_width'];
$templeLength = $_POST['product-temple-length'] ?? $product['temple_length'];

// images set as current
$image1Path = $product['image_main'];
$image2Path = $product['image_alternate'];

// product attributes input
$genderId = $_POST['product-gender'] ?? $product['gender_id'];
$frameTypeId = $_POST['product-frame-type'] ?? $product['frame_type_id'];
$shapeId = getOrCreateAttribute($conn, 1, $_POST['product-shape'], $_POST['product-shape-input']);
$colorId = getOrCreateAttribute($conn, 2, $_POST['product-color'], $_POST['product-color-input']);
$materialId = getOrCreateAttribute($conn, 3, $_POST['product-material'], $_POST['product-material-input']);


// if new images are uploaded
if ($_FILES['product-image']['size'] > 0) {
    $image1Path = uploadImage($_FILES['product-image'], $uploadDir, $name, $brand['name'], '0');
}
if ($_FILES['product-image2']['size'] > 0) {
    $image2Path = uploadImage($_FILES['product-image2'], $uploadDir, $name, $brand['name'], '1');
}

// bundle and update
$productData = [
    "brand_id" => $brand['brand_id'], 
    "name" => $name, 
    "price" => $price, 
    "type" => $type, 
    "lens_width" => $lensWidth, 
    "bridge_width" => $bridgeWidth, 
    "temple_length" => $templeLength, 
    "image_main" => $image1Path, 
    "image_alternate" => $image2Path
];

updateProduct($conn, $productId, $productData);

// bundled to category as [key] and array of [product_attribute_id, attribute_id] as value
$inputAttributes = [
    "Shape" => [$_POST['product-shape-pa'], $shapeId],
    "Color" => [$_POST['product-color-pa'], $colorId],
    "Material" => [$_POST['product-material-pa'], $materialId],
    "Frame Type" => [$_POST['product-frame-type-pa'], $frameTypeId], 
    "Gender" => [$_POST['product-gender-pa'], $genderId]
];


foreach ($inputAttributes as $key => $attribute) {
    $productAttributeId = $attribute[0]; 
    $attributeId = $attribute[1];
    updateProductAttribute($conn, $productAttributeId, $attributeId);
}

header('Location: ../../manage.php');    
exit();


