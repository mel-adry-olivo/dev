<?php

session_start();

require '../../includes/db-utils.php';
$conn = require '../../includes/db-conn.php';
$uploadDir = "../../assets/images/products/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$brand = getOrCreateBrand($conn, $_POST['product-brand'], $_POST['product-brand-input']);
$name = $_POST['product-name'] ?? '';
$price = $_POST['product-price'] ?? 0;
$type = $_POST['product-type'] ?? ''; 
$stockQuantity = $_POST['product-stock-quantity'] ?? 0;
$lensWidth = $_POST['product-lens-width'] ?? 0;
$bridgeWidth = $_POST['product-bridge-width'] ?? 0;
$templeLength = $_POST['product-temple-length'] ?? 0;

$genderId = $_POST['product-gender'] ?? '';
$frameTypeId = $_POST['product-frame-type'] ?? '';
$shapeId = getOrCreateAttribute($conn, 1, $_POST['product-shape'], $_POST['product-shape-input']);
$colorId = getOrCreateAttribute($conn, 2, $_POST['product-color'], $_POST['product-color-input']);
$materialId = getOrCreateAttribute($conn, 3, $_POST['product-material'], $_POST['product-material-input']);

$image1Path = null;
$image2Path = null;

if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] === UPLOAD_ERR_OK) {
    $image1Path = uploadImage($_FILES['product-image'], $uploadDir, $name, $brand['name'], '0');
}

if (isset($_FILES['product-image2']) && $_FILES['product-image2']['error'] === UPLOAD_ERR_OK) {
    $image2Path = uploadImage($_FILES['product-image2'], $uploadDir, $name, $brand['name'], '1');
}


$product = createProductArray($brand['brand_id'], $name, $price, $type,$stockQuantity, $lensWidth, $bridgeWidth, $templeLength, $image1Path, $image2Path);
$attributeIds = [$frameTypeId,$shapeId,$colorId,$materialId, $genderId];

$productId = addProduct($conn, $product);

foreach($attributeIds as $attributeId) {
    addProductAttribute($conn, $productId, $attributeId);
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
    if($brandId !== 'new' && empty($brandInput)) {
        $brand = getProductBrandById($conn, $brandId);
        return $brand;
    }

    // return id of new brand
    return addProductBrand($conn, $brandInput);
}

function getOrCreateAttribute($conn, $categoryId, $attributeId, $attributeInput) {
    if($attributeId !== 'new' && empty($attributeInput)) {
        return $attributeId;
    }

    return addProductAttribute($conn, $categoryId, $attributeInput);
}

function createProductArray($brandId, $name, $price, $type, $tockQuantity,$lensWidth, $bridgeWidth, $templeLength, $image1Path, $image2Path) {
    return array(
        "brand_id" => $brandId, 
        "name" => $name, 
        "price" => $price, 
        "type" => $type, 
        "reserve_count" => 0, 
        "stock_quantity" => $tockQuantity,
        "lens_width" => $lensWidth, 
        "bridge_width" => $bridgeWidth, 
        "temple_length" => $templeLength, 
        "image_main" => $image1Path, 
        "image_alternate" => $image2Path);
}
