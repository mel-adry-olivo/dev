<?php 

// TO REORDER

function createUser($conn, $user) {
    $sql = "INSERT INTO users (fname, lname, email, password) VALUES ('{$user['fname']}', '{$user['lname']}', '{$user['email']}', '{$user['password']}')";
    return mysqli_query($conn, $sql);
}

function getUserByEmail($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function getAllCategories($conn) {
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
    $result = mysqli_query($conn, $sql);
    $categories = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categoryName = $row['category_name'];
        $attributeName = $row['attribute_name'];
        $categories[$categoryName][] = $attributeName;
    }
    return $categories;
}

function addProduct($conn, $product) {
    $sql = "
    INSERT INTO 
        products (
            brand_id, 
            name, 
            type, 
            price, 
            lens_width, 
            bridge_width, 
            temple_length, 
            image_main, 
            image_alternate
            )
    VALUES (
        {$product['brand_id']}, 
        '{$product['name']}', 
        '{$product['type']}', 
        {$product['price']}, 
        {$product['lens_width']}, 
        {$product['bridge_width']}, 
        {$product['temple_length']}, 
        '{$product['image_main']}', 
        '{$product['image_alternate']}'
        )";
    mysqli_query($conn, $sql); 
    return mysqli_insert_id($conn);
}

function deleteProduct($conn, $id) {
    $sql = "DELETE FROM products WHERE product_id = $id";
    return mysqli_query($conn, $sql);
}

function deleteFromReservations($conn, $id) {
    $sql = "DELETE FROM reserved WHERE product_id = $id";
    return mysqli_query($conn, $sql);
}

function deleteFromBag($conn, $id) {
    $sql = "DELETE FROM bag WHERE product_id = $id";
    return mysqli_query($conn, $sql);
}

function deleteFromFavorites($conn, $id) {
    $sql = "DELETE FROM favorites WHERE product_id = $id";
    return mysqli_query($conn, $sql);
}

function deleteFromReviews($conn, $id) {
    $sql = "DELETE FROM reviews WHERE product_id = $id";
    return mysqli_query($conn, $sql);
}

function updateProduct($conn, $productId, $product) {
    $sql = "
    UPDATE 
        products 
    SET 
        brand_id = {$product['brand_id']}, 
        name = '{$product['name']}', 
        type = '{$product['type']}', 
        price = {$product['price']}, 
        lens_width = {$product['lens_width']}, 
        bridge_width = {$product['bridge_width']}, 
        temple_length = {$product['temple_length']}, 
        image_main = '{$product['image_main']}', 
        image_alternate = '{$product['image_alternate']}'
    WHERE 
        product_id = $productId";
    return mysqli_query($conn, $sql);
}

function getProductAttributesByID($conn, $id) {
    $sql = "
        SELECT  
            p.product_id,
            pa.product_attribute_id,
            c.name AS category_name, 
            a.name AS attribute_name
        FROM categories c
        JOIN attributes a ON c.category_id = a.category_id
        JOIN product_attributes pa ON a.attribute_id = pa.attribute_id
        JOIN products p ON pa.product_id = p.product_id
        WHERE p.product_id = $id
    ";

    $result = mysqli_query($conn, $sql);
    $categories = [];

    while ($row = mysqli_fetch_assoc($result)) {

        $categoryName = $row['category_name'];
        $attributeName = $row['attribute_name'];
        $productAttributeId = $row['product_attribute_id'];

        $categories[$categoryName] = [
            'name' => $attributeName,
            'pa_id' => $productAttributeId
        ];
    }
    return $categories;
}

function getProductAttribute ($conn, $id) {
    $sql = "SELECT * FROM product_attributes WHERE product_attribute_id = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function updateProductAttribute($conn, $product_attribute_id, $attributeId) {
    $sql = "UPDATE product_attributes SET attribute_id = $attributeId WHERE product_attribute_id = $product_attribute_id";
    return mysqli_query($conn, $sql);
}

function addProductAttriute($conn, $productId, $attributeId) {
    $sql = "INSERT INTO product_attributes (product_id, attribute_id) VALUES ($productId, $attributeId)";
    mysqli_query($conn, $sql);
}

function deleteProductAttributes($conn, $productId) {
    $sql = "DELETE FROM product_attributes WHERE product_id = $productId";
    return mysqli_query($conn, $sql);
}

function getAllProducts($conn) {
    $sql = "     
        SELECT 
            products.*,
            brands.brand_id,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
    ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function getPopularProducts($conn) {
    $sql = "     
        SELECT 
            p.*,
            b.name AS brand,
            AVG(r.rating) AS average_rating,
            COUNT(r.review_id) AS review_count
        FROM products p
        JOIN brands b ON p.brand_id = b.brand_id
        LEFT JOIN reviews r ON p.product_id = r.product_id
        GROUP BY p.product_id
        HAVING review_count > 0 
        ORDER BY 
            average_rating DESC, 
            review_count DESC
        LIMIT 8
        ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getProductsByBrand($conn, $brand) {
    $sql = "     
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        WHERE brands.name = '$brand'
        ORDER BY RAND()
    ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getProductsByShape($conn, $shape) {
    $sql = "     
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        JOIN product_attributes pa ON products.product_id = pa.product_id
        JOIN attributes a ON pa.attribute_id = a.attribute_id
        JOIN categories c ON a.category_id = c.category_id
        WHERE c.name = 'Shape' AND a.name = '$shape'
        ORDER BY RAND()
    ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getProductBrands($conn) {
    $sql = "SELECT * FROM brands";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function addProductBrand($conn, $brand) {
    $sql = "INSERT INTO brands (name) VALUES ('$brand')";
    mysqli_query($conn, $sql);
    return getProductBrandById($conn, $conn->insert_id);
}


function getProductBrandById($conn, $id) {
    $sql = "SELECT * FROM brands WHERE brand_id = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}


function addProductAttribute($conn, $productId, $attributeId) {
    $sql = "INSERT INTO product_attributes (product_id, attribute_id) VALUES ($productId, $attributeId)";
    mysqli_query($conn, $sql);
    return mysqli_insert_id($conn);
}


function getProductShapes($conn) {
    $sql = "
        SELECT 
            attributes.attribute_id, 
            attributes.name AS shape_name
        FROM attributes 
        JOIN categories ON attributes.category_id = categories.category_id
        WHERE categories.name = 'Shape'
    ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getProductMaterials($conn) {
    $sql = "
        SELECT 
            attributes.attribute_id, 
            attributes.name AS material_name
        FROM attributes 
        JOIN categories ON attributes.category_id = categories.category_id
        WHERE categories.name = 'Material'
    ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getProductColors($conn) {
    $sql = "
        SELECT 
            attributes.attribute_id, 
            attributes.name AS color_name
        FROM attributes 
        JOIN categories ON attributes.category_id = categories.category_id
        WHERE categories.name = 'Color'
    ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function getProductsbyType($conn, $type) {
    $formattedType = ucfirst($type);
    if($formattedType == 'All') return getAllProducts($conn);
    $sql = "
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        WHERE products.type = '$formattedType'
    ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function getProductById($conn, $id) {
    $sql = "     
        SELECT 
            products.*,
            brands.name AS brand 
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        WHERE products.product_id = $id
    ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}


function reserveBagProducts($conn, $userId) {
    if(!$userId) return [];

    $sql = "SELECT * FROM bag WHERE user_id = $userId";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {

        $bagProducts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach($bagProducts as $product) {
            $productId = $product['product_id'];
            $sql = "INSERT INTO reserved (user_id, product_id) VALUES ($userId, $productId)";
            mysqli_query($conn, $sql);
        }

        $sql = "DELETE FROM bag WHERE user_id = $userId";
        mysqli_query($conn, $sql);
    }
}

function getReservedProducts($conn, $userId) {
    if(!$userId) return [];
    
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

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function removeProductFromReservations($conn, $productId, $userId) {
    if(!$userId) return [];

    $sql = "DELETE FROM reserved WHERE user_id = $userId AND product_id = $productId";
    mysqli_query($conn, $sql);
}

function getBagProducts($conn, $userId) {
    if(!$userId) return [];

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

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function isProductInBag($conn, $productId, $userId) {
    if(!$userId) return false;

    $sql = "SELECT * FROM bag WHERE user_id = $userId AND product_id = $productId";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function isProductReserved($conn, $productId, $userId) {
    if(!$userId) return false;

    $sql = "SELECT * FROM reserved WHERE user_id = $userId AND product_id = $productId";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function addProductToBag($conn, $productId, $userId) {
    if(!$userId) return [];

    $sql = "INSERT INTO bag (user_id, product_id) VALUES ($userId, $productId)";
    mysqli_query($conn, $sql);
}


function removeProductFromBag($conn, $productId, $userId) {
    if(!$userId) return [];

    $sql = "DELETE FROM bag WHERE user_id = $userId AND product_id = $productId";
    mysqli_query($conn, $sql);
}

function getFavoritedProducts($conn, $userId) {
    if(!$userId) return [];

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

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function isProductFavorite($conn, $productId, $userId) {
    if(!$userId) return false;

    $sql = "SELECT * FROM favorites WHERE user_id = $userId AND product_id = $productId";
    $result = mysqli_query($conn, $sql);

    return mysqli_num_rows($result) > 0;
}

function addProductFavorite($conn, $productId, $userId) {
    if(!$userId) return [];

    $sql = "INSERT INTO favorites (user_id, product_id) VALUES ($userId, $productId)";
    mysqli_query($conn, $sql);
}

function removeProductFavorite($conn, $productId, $userId) {
    if(!$userId) return [];

    $sql = "DELETE FROM favorites WHERE user_id = $userId AND product_id = $productId";
    mysqli_query($conn, $sql);
}


function getFilteredProducts($conn, $type, $filters) {

    $formattedType = ucfirst($type);

    // if the type is 'All', fetch all products. 
    // if not, filter by the specified product type
    $where = $formattedType == 'All' ? 'WHERE 1 = 1' : " WHERE p.type = '$formattedType'";

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
            // separate clause because brand is another table
            $conditions[] = " b.name IN('" . implode("', '", $value) . "')";
        } else {
            // c is categories, a is attributes
            $conditions[] = " c.name = '$key' AND a.name IN('" . implode("', '", $value) . "')";
        }
    }

    
    // example: AND c.name = 'Shape' AND a.name IN('Square', 'Rectangle')
    if (!empty($conditions)) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }


    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function getSortedProducts($conn, $type, $direction) {
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

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getProductReviews($conn, $id) {
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

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function createProductReview($conn, $review) {
    $sql = "
        INSERT INTO reviews (product_id, user_id, rating, review_text) 
        VALUES ({$review['product_id']}, {$review['user_id']}, {$review['rating']}, '{$review['review_text']}')
    ";
    mysqli_query($conn, $sql);
}

function removeProductReview($conn, $id) {
    $sql = "DELETE FROM reviews WHERE review_id = $id";
    mysqli_query($conn, $sql);
}

function getProductReviewsByDate($conn, $id) {
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
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getLimitedProductReviews($conn, $id, $limit) {
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

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}   

function getAverageRating($conn, $id) {
    $reviews = getProductReviews($conn, $id);
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

function getProductReviewCount($conn, $id) {
    $reviews = getProductReviews($conn, $id);
    return count($reviews);
}

function getProductReserveCount($conn, $id) {
    $sql = "SELECT COUNT(*) as count FROM reserved WHERE product_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

function getOrCreateBrand($conn, $brandId, $brandInput) {
    if($brandId !== 'new' && empty($brandInput)) {
        $brand = getProductBrandById($conn, $brandId);
        return $brand;
    }

    // return id of new brand
    return addProductBrand($conn, $brandInput);
}
function getOrCreateAttribute($conn, $categoryId, $attributeId, $attributeIdInput) {
    if($attributeId !== 'new' && empty($attributeIdInput)) {
        return $attributeId;
    }

    return addProductAttribute($conn, $categoryId, $attributeIdInput);
}

