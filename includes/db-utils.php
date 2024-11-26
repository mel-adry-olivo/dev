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

function reserveBagProducts($userId) {
    if(!$userId) return [];
    global $conn;
    $sql = "SELECT * FROM bag WHERE user_id = $userId";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {

        $bagProducts = $result->fetch_all(MYSQLI_ASSOC);

        foreach($bagProducts as $product) {
            $productId = $product['product_id'];
            $sql = "INSERT INTO reserved (user_id, product_id) VALUES ($userId, $productId)";
            $conn->query($sql);
        }

        $sql = "DELETE FROM bag WHERE user_id = $userId";
        $conn->query($sql);
    }
}

function getReservedProducts($userId) {
    if(!$userId) return [];
    global $conn;
    $sql = "
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN reserved ON products.product_id = reserved.product_id
        JOIN brands ON products.brand_id = brands.brand_id
        WHERE user_id = $userId
        ORDER BY reserved.reserved_on DESC
        ";

    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function removeProductFromReservations($productId, $userId) {
    if(!$userId) return [];
    global $conn;
    $userId = $_SESSION['user_id'];
    $sql = "DELETE FROM reserved WHERE user_id = $userId AND product_id = $productId";
    $conn->query($sql);
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
    $sql = "INSERT INTO bag (user_id, product_id) VALUES ($userId, $productId)";
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
    $where = $formattedType == 'All' ? 'WHERE 1=1' : " WHERE p.type = '$formattedType'";
    $sql = "
        SELECT DISTINCT 
            p.*,
            b.name AS brand 
        FROM products p
        INNER JOIN brands b ON p.brand_id = b.brand_id
        LEFT JOIN product_attributes pa ON p.product_id = pa.product_id
        LEFT JOIN attributes a ON pa.attribute_id = a.attribute_id
        LEFT JOIN categories c ON a.category_id = c.category_id
        $where
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
    $where = $formattedType == 'All' ? '' : " WHERE products.type = '$formattedType'";

    $sql = "
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        $where
        ORDER BY products.price $direction
        ";

    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getProductReviews($id) {
    global $conn;
    $sql = "
        SELECT 
            reviews.*,
            users.user_id,
            users.fname,
            users.lname
        FROM reviews 
        JOIN users ON reviews.user_id = users.user_id
        WHERE product_id = $id
        ORDER BY RAND()
        ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function createProductReview($review) {
    global $conn;
    $sql = "
        INSERT INTO reviews (product_id, user_id, rating, review_text) 
        VALUES ({$review['product_id']}, {$review['user_id']}, {$review['rating']}, '{$review['review_text']}')
    ";
    $conn->query($sql);
}

function getProductReviewsByDate($id) {
    global $conn;
    $sql = "
        SELECT 
            reviews.*,
            users.user_id,
            users.fname,
            users.lname
        FROM reviews 
        JOIN users ON reviews.user_id = users.user_id
        WHERE product_id = $id
        ORDER BY reviews.created_at DESC
        ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getLimitedProductReviews($id, $limit) {
    global $conn;
    $sql = "
        SELECT 
            reviews.*,
            users.user_id,
            users.fname,
            users.lname
        FROM reviews 
        JOIN users ON reviews.user_id = users.user_id
        WHERE product_id = $id
        ORDER BY RAND()
        LIMIT $limit
        ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}   

function getAverageRating($id) {
    $reviews = getProductReviews($id);
    $total = 0;
    
    if (count($reviews) === 0) {
        return 0; 
    }

    foreach ($reviews as $review) {
        $total += $review['rating'];
    }

    $avg = (float)($total / count($reviews));
    $formattedAvg = number_format($avg, 1);

    return $formattedAvg;
}

function getProductReviewCount($id) {
    $reviews = getProductReviews($id);
    return count($reviews);
}