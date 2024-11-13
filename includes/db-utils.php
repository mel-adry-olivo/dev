<?php 
function retrieveAllFrom($tableName) {
    global $conn;
    $sql = "SELECT * FROM $tableName ";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

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
