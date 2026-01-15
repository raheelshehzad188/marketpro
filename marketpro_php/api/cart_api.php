<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$conn = getDBConnection();
$action = $_POST['action'] ?? $_GET['action'] ?? '';
$sessionId = $_SESSION['cart_session_id'] ?? session_id();

switch ($action) {
    case 'get_cart':
        getCart($conn, $sessionId);
        break;
    
    case 'update_quantity':
        updateQuantity($conn, $sessionId);
        break;
    
    case 'remove_item':
        removeItem($conn, $sessionId);
        break;
    
    case 'add_to_cart':
        addToCart($conn, $sessionId);
        break;
    
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

function getCart($conn, $sessionId) {
    $cartItems = [];
    $subtotal = 0;
    
    $query = "SELECT ci.*, p.name, p.price, p.image 
              FROM cart_items ci 
              INNER JOIN products p ON ci.product_id = p.id 
              WHERE ci.session_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $sessionId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Dummy tags and reviews data
    $dummyTags = [
        ['Organic', 'Fresh', 'Healthy'],
        ['Fresh', 'Natural', 'Premium'],
        ['Organic', 'Farm Fresh', 'Quality'],
        ['Premium', 'Fresh', 'Best'],
        ['Natural', 'Organic', 'Healthy']
    ];
    
    $dummyReviews = [
        ['name' => 'John Doe', 'rating' => 5, 'comment' => 'Excellent quality product!', 'date' => '2 days ago'],
        ['name' => 'Sarah Smith', 'rating' => 4, 'comment' => 'Very fresh and good value.', 'date' => '5 days ago'],
        ['name' => 'Mike Johnson', 'rating' => 5, 'comment' => 'Highly recommended!', 'date' => '1 week ago'],
        ['name' => 'Emily Brown', 'rating' => 4, 'comment' => 'Great product, will order again.', 'date' => '3 days ago'],
        ['name' => 'David Wilson', 'rating' => 5, 'comment' => 'Perfect quality and fast delivery.', 'date' => '1 week ago']
    ];
    
    $index = 0;
    while ($row = $result->fetch_assoc()) {
        $itemTotal = $row['price'] * $row['quantity'];
        $subtotal += $itemTotal;
        
        // Get dummy data based on product index
        $tags = $dummyTags[$index % count($dummyTags)];
        $reviews = array_slice($dummyReviews, 0, 3); // Get first 3 reviews
        
        $cartItems[] = [
            'id' => $row['id'],
            'product_id' => $row['product_id'],
            'name' => $row['name'],
            'price' => floatval($row['price']),
            'quantity' => intval($row['quantity']),
            'image' => $row['image'] ?? 'assets/images/thumbs/product-two-img1.png',
            'subtotal' => $itemTotal,
            'tags' => $tags,
            'reviews' => $reviews,
            'rating' => 4.5 + (rand(0, 10) / 10), // Random rating between 4.5-5.5
            'total_reviews' => rand(50, 200) // Random total reviews count
        ];
        $index++;
    }
    
    $tax = $subtotal * 0.04;
    $shipping = 0;
    $total = $subtotal + $tax + $shipping;
    
    echo json_encode([
        'success' => true,
        'items' => $cartItems,
        'totals' => [
            'subtotal' => round($subtotal, 2),
            'tax' => round($tax, 2),
            'shipping' => $shipping,
            'total' => round($total, 2)
        ]
    ]);
    
    $stmt->close();
}

function updateQuantity($conn, $sessionId) {
    $cartItemId = intval($_POST['cart_item_id'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 1);
    
    if ($cartItemId <= 0 || $quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
        return;
    }
    
    $query = "UPDATE cart_items SET quantity = ? WHERE id = ? AND session_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $quantity, $cartItemId, $sessionId);
    
    if ($stmt->execute()) {
        getCart($conn, $sessionId);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update']);
    }
    
    $stmt->close();
}

function removeItem($conn, $sessionId) {
    $cartItemId = intval($_POST['cart_item_id'] ?? 0);
    
    if ($cartItemId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid ID']);
        return;
    }
    
    $query = "DELETE FROM cart_items WHERE id = ? AND session_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $cartItemId, $sessionId);
    
    if ($stmt->execute()) {
        getCart($conn, $sessionId);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove']);
    }
    
    $stmt->close();
}

function addToCart($conn, $sessionId) {
    $productId = intval($_POST['product_id'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 1);
    
    if ($productId <= 0 || $quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
        return;
    }
    
    $checkQuery = "SELECT id, quantity FROM cart_items WHERE session_id = ? AND product_id = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("si", $sessionId, $productId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $newQuantity = $row['quantity'] + $quantity;
        $updateQuery = "UPDATE cart_items SET quantity = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ii", $newQuantity, $row['id']);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
        $insertQuery = "INSERT INTO cart_items (session_id, product_id, quantity) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sii", $sessionId, $productId, $quantity);
        $insertStmt->execute();
        $insertStmt->close();
    }
    
    $checkStmt->close();
    getCart($conn, $sessionId);
}

$conn->close();
?>
