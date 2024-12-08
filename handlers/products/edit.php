<?php

session_start();

require '../../includes/db-utils.php';
$conn = require '../../includes/db-conn.php';

$uploadDir = "../../assets/images/products/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$productId = $_GET['id'] ?? null;
$product = getProductById($conn, $productId);

$brand = getOrCreateBrand($conn, $_POST['product-brand'], $_POST['product-brand-input']);
$name = $_POST['product-name'] ?? $product['name'];
$price = $_POST['product-price'] ?? $product['price'];
$type = $_POST['product-type'] ?? $product['type']; 
$stockQuantity = $_POST['product-stock-quantity'] ?? $product['stock_quantity'];
$lensWidth = $_POST['product-lens-width'] ?? $product['lens_width'];
$bridgeWidth = $_POST['product-bridge-width'] ?? $product['bridge_width'];
$templeLength = $_POST['product-temple-length'] ?? $product['temple_length'];

$genderId = $_POST['product-gender'] ?? $product['gender_id'];
$frameTypeId = $_POST['product-frame-type'] ?? $product['frame_type_id'];
$shapeId = getOrCreateAttribute($conn, 1, $_POST['product-shape'], $_POST['product-shape-input']);
$colorId = getOrCreateAttribute($conn, 2, $_POST['product-color'], $_POST['product-color-input']);
$materialId = getOrCreateAttribute($conn, 3, $_POST['product-material'], $_POST['product-material-input']);

$image1Path = $product['image_main'];
$image2Path = $product['image_alternate'];

if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] === UPLOAD_ERR_OK) {
    $image1Path = uploadImage($_FILES['product-image'], $uploadDir, $name, $brand['name'], '0');
}

if (isset($_FILES['product-image2']) && $_FILES['product-image2']['error'] === UPLOAD_ERR_OK) {
    $image2Path = uploadImage($_FILES['product-image2'], $uploadDir, $name, $brand['name'], '1');
}


$productData = createProductArray($brand['brand_id'], $name, $price, $type,$stockQuantity, $lensWidth, $bridgeWidth, $templeLength, $image1Path, $image2Path);
updateProduct($conn, $productId, $productData);

$inputAttributes = [
    "Shape" => [$_POST['product-shape-pa'],$shapeId],
    "Color" => [$_POST['product-color-pa'],$colorId],
    "Material" => [$_POST['product-material-pa'],$materialId],
    "Frame Type" => [$_POST['product-frame-type-pa'], $frameTypeId], 
    "Gender" => [$_POST['product-gender-pa'],$genderId]
];


foreach ($inputAttributes as $key => $attribute) {
    $productAttributeId = $attribute[0]; 
    $attributeId = $attribute[1];
    updateProductAttribute($conn, $productAttributeId, $attributeId);
}


header('Location: ../../manage.php');    
exit();

function uploadImage($file, $uploadDir, $name, $brand, $suffix = '') {
    $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $brand = strtolower($brand);
    $name = str_replace(' ', '-', strtolower($name));
    $uniqueName =  $brand . '-' . $name . '-' . $suffix . '.' . $fileType ;
    $filePath = $uploadDir . $uniqueName;
    $dbPath = './assets/images/products/' . $uniqueName;
    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        echo "Failed to upload the file: " . $file['name'];
        return null;
    }
    return $dbPath;
}

function getOrCreateBrand($conn, $brandId, $brandInput) {
    if ($brandId !== 'new' && empty($brandInput)) {
        return getProductBrandById($conn, $brandId);
    }

    return addProductBrand($conn, $brandInput);
}

function getOrCreateAttribute($conn, $categoryId, $inputId, $attributeInput) {
    if ($inputId !== 'new' && empty($attributeInput)) {
        return $inputId;
    }

    return addProductAttribute($conn, $categoryId, $attributeInput);
}

function createProductArray($brandId, $name, $price, $type,$stockQuantity, $lensWidth, $bridgeWidth, $templeLength, $image1Path, $image2Path) {
    return array(
        "brand_id" => $brandId, 
        "name" => $name, 
        "price" => $price, 
        "type" => $type, 
        "stock_quantity" => $stockQuantity,
        "lens_width" => $lensWidth, 
        "bridge_width" => $bridgeWidth, 
        "temple_length" => $templeLength, 
        "image_main" => $image1Path, 
        "image_alternate" => $image2Path
    );
}

