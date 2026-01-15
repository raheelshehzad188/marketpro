<?php
// Helper Functions

/**
 * Generate slug from string
 */
function generateSlug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9-]+/', '-', $string);
    $string = trim($string, '-');
    return $string;
}

/**
 * Get products by category
 */
function getProductsByCategory($conn, $categorySlug, $page = 1, $limit = 20) {
    $offset = ($page - 1) * $limit;
    
    // Get category
    $categoryQuery = "SELECT * FROM categories WHERE slug = ? AND status = 'active' LIMIT 1";
    $categoryStmt = $conn->prepare($categoryQuery);
    $categoryStmt->bind_param("s", $categorySlug);
    $categoryStmt->execute();
    $categoryResult = $categoryStmt->get_result();
    $category = $categoryResult->fetch_assoc();
    $categoryStmt->close();
    
    if (!$category) {
        return ['products' => [], 'category' => null, 'total' => 0];
    }
    
    // Get products count
    $countQuery = "SELECT COUNT(*) as total FROM products WHERE category_id = ? AND status = 'active'";
    $countStmt = $conn->prepare($countQuery);
    $countStmt->bind_param("i", $category['id']);
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $total = $countResult->fetch_assoc()['total'];
    $countStmt->close();
    
    // Get products
    $limit = (int)$limit;
    $offset = (int)$offset;
    $productsQuery = "SELECT * FROM products WHERE category_id = ? AND status = 'active' ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $productsStmt = $conn->prepare($productsQuery);
    $productsStmt->bind_param("i", $category['id']);
    $productsStmt->execute();
    $productsResult = $productsStmt->get_result();
    
    $products = [];
    while ($row = $productsResult->fetch_assoc()) {
        $products[] = $row;
    }
    $productsStmt->close();
    
    return ['products' => $products, 'category' => $category, 'total' => $total];
}

/**
 * Get products by brand
 */
function getProductsByBrand($conn, $brandSlug, $page = 1, $limit = 20) {
    $offset = ($page - 1) * $limit;
    
    // Get brand
    $brandQuery = "SELECT * FROM brands WHERE slug = ? AND status = 'active' LIMIT 1";
    $brandStmt = $conn->prepare($brandQuery);
    $brandStmt->bind_param("s", $brandSlug);
    $brandStmt->execute();
    $brandResult = $brandStmt->get_result();
    $brand = $brandResult->fetch_assoc();
    $brandStmt->close();
    
    if (!$brand) {
        return ['products' => [], 'brand' => null, 'total' => 0];
    }
    
    // Get products count
    $countQuery = "SELECT COUNT(*) as total FROM products WHERE brand_id = ? AND status = 'active'";
    $countStmt = $conn->prepare($countQuery);
    $countStmt->bind_param("i", $brand['id']);
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $total = $countResult->fetch_assoc()['total'];
    $countStmt->close();
    
    // Get products
    $limit = (int)$limit;
    $offset = (int)$offset;
    $productsQuery = "SELECT * FROM products WHERE brand_id = ? AND status = 'active' ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $productsStmt = $conn->prepare($productsQuery);
    $productsStmt->bind_param("i", $brand['id']);
    $productsStmt->execute();
    $productsResult = $productsStmt->get_result();
    
    $products = [];
    while ($row = $productsResult->fetch_assoc()) {
        $products[] = $row;
    }
    $productsStmt->close();
    
    return ['products' => $products, 'brand' => $brand, 'total' => $total];
}

/**
 * Search products
 */
function searchProducts($conn, $searchTerm, $page = 1, $limit = 20) {
    $offset = ($page - 1) * $limit;
    $search = "%{$searchTerm}%";
    
    // Get products count
    $countQuery = "SELECT COUNT(*) as total FROM products WHERE (name LIKE ? OR description LIKE ?) AND status = 'active'";
    $countStmt = $conn->prepare($countQuery);
    $countStmt->bind_param("ss", $search, $search);
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $total = $countResult->fetch_assoc()['total'];
    $countStmt->close();
    
    // Get products
    $limit = (int)$limit;
    $offset = (int)$offset;
    $productsQuery = "SELECT * FROM products WHERE (name LIKE ? OR description LIKE ?) AND status = 'active' ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $productsStmt = $conn->prepare($productsQuery);
    $productsStmt->bind_param("ss", $search, $search);
    $productsStmt->execute();
    $productsResult = $productsStmt->get_result();
    
    $products = [];
    while ($row = $productsResult->fetch_assoc()) {
        $products[] = $row;
    }
    $productsStmt->close();
    
    return ['products' => $products, 'total' => $total];
}

/**
 * Get all categories for sidebar
 */
function getAllCategories($conn) {
    $query = "SELECT c.*, COUNT(p.id) as product_count 
              FROM categories c 
              LEFT JOIN products p ON c.id = p.category_id AND p.status = 'active'
              WHERE c.status = 'active'
              GROUP BY c.id
              ORDER BY c.name ASC";
    $result = $conn->query($query);
    
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    
    return $categories;
}

/**
 * Get all brands for sidebar
 */
function getAllBrands($conn) {
    $query = "SELECT b.*, COUNT(p.id) as product_count 
              FROM brands b 
              LEFT JOIN products p ON b.id = p.brand_id AND p.status = 'active'
              WHERE b.status = 'active'
              GROUP BY b.id
              ORDER BY b.name ASC";
    $result = $conn->query($query);
    
    $brands = [];
    while ($row = $result->fetch_assoc()) {
        $brands[] = $row;
    }
    
    return $brands;
}
?>
