<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$conn = getDBConnection();
$action = $_POST['action'] ?? $_GET['action'] ?? '';
$sessionId = $_SESSION['cart_session_id'] ?? session_id();

switch ($action) {
    case 'get_wishlist':
        getWishlist($conn, $sessionId);
        break;
    
    case 'add_to_wishlist':
        addToWishlist($conn, $sessionId);
        break;
    
    case 'remove_from_wishlist':
        removeFromWishlist($conn, $sessionId);
        break;
    
    case 'get_wishlist_count':
        getWishlistCount($conn, $sessionId);
        break;
    
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

function getWishlist($conn, $sessionId) {
    $wishlistItems = [];
    
    $query = "SELECT w.*, p.name, p.price, p.image, p.rating, p.reviews 
              FROM wishlist w 
              INNER JOIN products p ON w.product_id = p.id 
              WHERE w.session_id = ?
              ORDER BY w.created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $sessionId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $wishlistItems[] = [
            'id' => $row['id'],
            'product_id' => $row['product_id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'image' => $row['image'],
            'rating' => $row['rating'] ?? 4.5,
            'reviews' => $row['reviews'] ?? 0,
            'stock_status' => 'In Stock'
        ];
    }
    
    echo json_encode([
        'success' => true,
        'items' => $wishlistItems,
        'count' => count($wishlistItems)
    ]);
    
    $stmt->close();
}

function getWishlistCount($conn, $sessionId) {
    $query = "SELECT COUNT(*) as count FROM wishlist WHERE session_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $sessionId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    echo json_encode([
        'success' => true,
        'count' => (int)$row['count']
    ]);
    
    $stmt->close();
}

function addToWishlist($conn, $sessionId) {
    $productId = intval($_POST['product_id'] ?? 0);
    
    if ($productId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
        return;
    }
    
    // Check if already in wishlist
    $checkQuery = "SELECT id FROM wishlist WHERE session_id = ? AND product_id = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("si", $sessionId, $productId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Product already in wishlist']);
        $checkStmt->close();
        return;
    }
    
    // Add to wishlist
    $insertQuery = "INSERT INTO wishlist (session_id, product_id) VALUES (?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("si", $sessionId, $productId);
    
    if ($insertStmt->execute()) {
        getWishlistCount($conn, $sessionId);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add to wishlist']);
    }
    
    $checkStmt->close();
    $insertStmt->close();
}

function removeFromWishlist($conn, $sessionId) {
    $wishlistId = intval($_POST['wishlist_id'] ?? 0);
    $productId = intval($_POST['product_id'] ?? 0);
    
    if ($wishlistId > 0) {
        $query = "DELETE FROM wishlist WHERE id = ? AND session_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $wishlistId, $sessionId);
    } else if ($productId > 0) {
        $query = "DELETE FROM wishlist WHERE product_id = ? AND session_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $productId, $sessionId);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
        return;
    }
    
    if ($stmt->execute()) {
        getWishlist($conn, $sessionId);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove']);
    }
    
    $stmt->close();
}

$conn->close();
?>
