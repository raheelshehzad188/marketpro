<?php
// Get cart and wishlist counts
require_once 'config/database.php';
$conn = getDBConnection();
$sessionId = $_SESSION['cart_session_id'] ?? session_id();

// Get cart count
$cartCount = 0;
$cartQuery = "SELECT COUNT(*) as count FROM cart_items WHERE session_id = ?";
$cartStmt = $conn->prepare($cartQuery);
$cartStmt->bind_param("s", $sessionId);
$cartStmt->execute();
$cartResult = $cartStmt->get_result();
if ($cartRow = $cartResult->fetch_assoc()) {
    $cartCount = (int)$cartRow['count'];
}
$cartStmt->close();

// Get wishlist count
$wishlistCount = 0;
$wishlistQuery = "SELECT COUNT(*) as count FROM wishlist WHERE session_id = ?";
$wishlistStmt = $conn->prepare($wishlistQuery);
$wishlistStmt->bind_param("s", $sessionId);
$wishlistStmt->execute();
$wishlistResult = $wishlistStmt->get_result();
if ($wishlistRow = $wishlistResult->fetch_assoc()) {
    $wishlistCount = (int)$wishlistRow['count'];
}
$wishlistStmt->close();
$conn->close();
?>
<div class="flex-align gap-20">
    <button type="button" class="search-icon flex-align d-lg-none d-flex gap-4 item-hover">
        <span class="text-2xl text-gray-700 d-flex position-relative item-hover__text">
            <i class="ph ph-magnifying-glass"></i>
        </span>
    </button>
    <a href="javascript:void(0)" class="flex-align gap-4 item-hover">
        <span class="text-xl text-gray-700 d-flex position-relative item-hover__text">
            <i class="ph ph-user"></i>
        </span>
        <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Profile</span>
    </a>
    <a href="wishlist.php" class="flex-align gap-4 item-hover">
        <span class="text-xl text-gray-700 d-flex position-relative me-6 mt-6 item-hover__text">
            <i class="ph ph-heart"></i>
            <?php if($wishlistCount > 0): ?>
            <span class="w-16 h-16 flex-center rounded-circle bg-main-600 text-white text-xs position-absolute top-n6 end-n4 wishlist-count"><?php echo $wishlistCount; ?></span>
            <?php endif; ?>
        </span>
        <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Wishlist</span>
    </a>
    <a href="cart.php" class="flex-align gap-4 item-hover">
        <span class="text-xl text-gray-700 d-flex position-relative me-6 mt-6 item-hover__text">
            <i class="ph ph-shopping-cart-simple"></i>
            <?php if($cartCount > 0): ?>
            <span class="w-16 h-16 flex-center rounded-circle bg-main-600 text-white text-xs position-absolute top-n6 end-n4 cart-qty"><?php echo $cartCount; ?></span>
            <?php endif; ?>
        </span>
        <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Cart</span>
    </a>
</div>