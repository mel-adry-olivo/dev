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
            'Brand' as category_name,
            name as attribute_name
            
        FROM brands
        UNION ALL
        SELECT  
            categories.name AS category_name, 
            attributes.name AS attribute_name
        FROM categories
        JOIN attributes ON categories.category_id = attributes.category_id
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

function getLimitedProducts($limit) {
    global $conn;
    $sql = "     
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        LIMIT $limit
    ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getProductsbyType($type) {
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

function getProductById($id) {
    global $conn;
    $sql = "     
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        WHERE products.product_id = $id
    ";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function getBagProducts($userId) {
    if(!$userId) return [];
    global $conn;
    $sql = "
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN bag ON products.product_id = bag.product_id
        JOIN brands ON products.brand_id = brands.brand_id
        WHERE user_id = $userId
        ORDER BY bag.added_on DESC
        ";

    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function isProductInBag($productId, $userId) {
    if(!$userId) return false;
    global $conn;
    $sql = "SELECT * FROM bag WHERE user_id = $userId AND product_id = $productId";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

function addProductToBag($productId, $userId) {
    if(!$userId) return [];
    global $conn;
    $userId = $_SESSION['user_id'];
    $sql = "INSERT INTO bag (user_id, product_id, quantity) VALUES ($userId, $productId, 1)";
    $conn->query($sql);
}

function removeProductFromBag($productId, $userId) {
    if(!$userId) return [];
    global $conn;
    $userId = $_SESSION['user_id'];
    $sql = "DELETE FROM bag WHERE user_id = $userId AND product_id = $productId";
    $conn->query($sql);
}

function getFavoritedProducts($userId) {

    if(!$userId) return [];

    global $conn;
    $sql = "
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN favorites ON products.product_id = favorites.product_id
        JOIN brands ON products.brand_id = brands.brand_id
        WHERE user_id = $userId 
        ORDER BY favorites.added_at DESC
        ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function isProductFavorite($productId, $userId) {

    if(!$userId) return false;

    global $conn;
    $sql = "SELECT * FROM favorites WHERE user_id = $userId AND product_id = $productId";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

function addProductFavorite($productId, $userId) {
    if(!$userId) return [];
    global $conn;
    $userId = $_SESSION['user_id'];
    $sql = "INSERT INTO favorites (user_id, product_id) VALUES ($userId, $productId)";
    $conn->query($sql);
}

function removeProductFavorite($productId, $userId) {
    if(!$userId) return [];
    global $conn;
    $userId = $_SESSION['user_id'];
    $sql = "DELETE FROM favorites WHERE user_id = $userId AND product_id = $productId";
    $conn->query($sql);
}

function getProductAttributesByID($id) {
    global $conn;
    $sql = "
        SELECT  
            c.name AS category_name, 
            a.name AS attribute_name
        FROM 
            categories c
        JOIN 
            attributes a ON c.category_id = a.category_id
        JOIN 
            product_attributes pa ON a.attribute_id = pa.attribute_id
        JOIN 
            products p ON pa.product_id = p.product_id
        WHERE 
            p.product_id = $id
    ";
    $result = $conn->query($sql);
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categoryName = $row['category_name'];
        $attributeName = $row['attribute_name'];
        $categories[$categoryName] = $attributeName;
    }
    return $categories;
}


function getFilteredProducts($type, $filters) {
    global $conn;
    $formattedType = ucfirst($type);
    $sql = "
        SELECT DISTINCT 
            p.*,
            b.name AS brand 
        FROM products p
        INNER JOIN brands b ON p.brand_id = b.brand_id
        LEFT JOIN product_attributes pa ON p.product_id = pa.product_id
        LEFT JOIN attributes a ON pa.attribute_id = a.attribute_id
        LEFT JOIN categories c ON a.category_id = c.category_id
        WHERE p.type = '$formattedType'
    ";

    $conditions = [];

    foreach ($filters as $key => $value) {
        if($key == 'Brand') {
            $conditions[] = " b.name IN('" . implode("', '", $value) . "')";
        } else {
            $conditions[] = " c.name = '$key' AND a.name IN('" . implode("', '", $value) . "')";
        }
    }

    if (!empty($conditions)) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }

    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getSortedProducts($type, $direction) {
    global $conn;
    $formattedType = ucfirst($type);
    $sql = "
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        WHERE products.type = '$formattedType'
        ORDER BY products.price $direction
    ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}