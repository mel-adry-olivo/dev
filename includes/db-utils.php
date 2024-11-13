<?php 

function getUserByEmail($email) {
    global $conn;
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function getAllCategories() {
    global $conn;
    $sql = "
        SELECT  
            categories.name AS category_name, 
            attributes.name AS attribute_name
        FROM categories
        JOIN attributes ON categories.category_id = attributes.category_id
        ORDER BY categories.category_id
    ";
    $result = $conn->query($sql);
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categoryName = $row['category_name'];
        $attributeName = $row['attribute_name'];
        $categories[$categoryName][] = $attributeName;
    }
    return $categories;
}

function getAllProducts() {
    global $conn;
    $sql = "
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
    ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getProductsByType($type) {
    global $conn;
    $formattedType = ucfirst($type);
    $sql = "
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        WHERE products.type = '$formattedType'
    ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}