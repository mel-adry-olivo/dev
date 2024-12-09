<?php

function uploadImage($file, $uploadDir, $name, $brand, $suffix = '') {
    $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $brand = strtolower($brand);
    $name = str_replace(' ', '-', strtolower($name));
    $uniqueName =  $brand . '-' . $name . '-' . $suffix . '.' . $fileType ;
    $filePath = $uploadDir . $uniqueName;
    $dbPath = './assets/images/products/' . $uniqueName;
    move_uploaded_file($file['tmp_name'], $filePath);
    return $dbPath;
}