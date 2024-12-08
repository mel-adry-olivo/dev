<?php

session_start();
require '../../includes/config.php';
require '../../includes/db-utils.php';


if (isset($_POST['add'])) {

    $name = $_POST['product-name'] ?? '';
    $price = $_POST['product-price'] ?? 0;
    $type = $_POST['product-type'] ?? ''; 
    $gender = $_POST['product-gender'] ?? '';
    $lensWidth = $_POST['product-lens-width'] ?? 0;
    $bridgeWidth = $_POST['product-bridge-width'] ?? 0;
    $templeLength = $_POST['product-temple-length'] ?? 0;
    $frameType = $_POST['product-frame-type'] ?? '';

    $colorId = $_POST['product-color'] ?? '';

    $materialId = $_POST['product-material'] ?? '';

    $shapeId = $_POST['product-shape'] ?? '';

    $brandId = $_POST['product-brand'] ?? '';
    

    if ($color === 'new') {
        $color = $_POST['product-color-input'] ?? '';
        // add to database
    }
    if ($material === 'new') {
        $material = $_POST['product-material-input'] ?? '';
        // add to database
    }
    if ($shape === 'new') {
        $shape = $_POST['product-shape-input'] ?? '';
        // add to database
    }
    if ($brandId === 'new') {
        $brandId = $_POST['product-brand-input'] ?? '';
        // add to database
    }

    // handle image upload then save product details and attributes to database

    $uploadDir = "../../assets/images/products/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $image1Path = null;
    $image2Path = null;

    if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] === UPLOAD_ERR_OK) {
        $image1Path = uploadImage($_FILES['product-image'], $uploadDir, $name, $brandId);
    }

    if (isset($_FILES['product-image2']) && $_FILES['product-image2']['error'] === UPLOAD_ERR_OK) {
        $image2Path = uploadImage($_FILES['product-image2'], $uploadDir, $name, $brandId);
    }
}

function uploadImage($file, $uploadDir, $name, $brand) {
    $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $brand = strtolower($brand);
    $name = str_replace(' ', '-', strtolower($name));
    $uniqueName =  $brand . '-' . $name . '.' . $fileType;
    $filePath = $uploadDir . $uniqueName;

    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        echo "Failed to upload the file.";
        return null;
    }

    return $filePath;
}