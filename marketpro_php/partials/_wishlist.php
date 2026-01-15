<?php
require_once 'config/database.php';
$conn = getDBConnection();
$sessionId = $_SESSION['cart_session_id'] ?? session_id();

$wishlistItems = [];

$query = "SELECT w.id as wishlist_id, w.product_id, p.name as title, p.price, p.image, p.rating, p.reviews 
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
        'wishlist_id' => $row['wishlist_id'],
        'product_id' => $row['product_id'],
        'image' => $row['image'] ?? '../assets/images/thumbs/product-two-img1.png',
        'title' => $row['title'],
        'rating' => number_format($row['rating'] ?? 4.5, 1),
        'reviews' => $row['reviews'] ?? 0,
        'price' => number_format($row['price'], 2),
        'stock_status' => 'In Stock'
    ];
}

$stmt->close();
$conn->close();
?>
<!-- ================================ Cart Section Start ================================ -->
<section class="cart py-80">
    <div class="container container-lg">
        <div class="row gy-4">
            <div class="col-lg-11">
                <div class="cart-table border border-gray-100 rounded-8">
                    <div class="overflow-x-auto scroll-sm scroll-sm-horizontal">
                        <table class="table rounded-8 overflow-hidden">
                            <thead>
                                <tr class="border-bottom border-neutral-100">
                                    <th class="h6 mb-0 text-lg fw-bold px-40 py-32 border-end border-neutral-100">Delete</th>
                                    <th class="h6 mb-0 text-lg fw-bold px-40 py-32 border-end border-neutral-100">Product Name</th>
                                    <th class="h6 mb-0 text-lg fw-bold px-40 py-32 border-end border-neutral-100">Unit Price</th>
                                    <th class="h6 mb-0 text-lg fw-bold px-40 py-32 border-end border-neutral-100">Stock Status</th>
                                    <th class="h6 mb-0 text-lg fw-bold px-40 py-32"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($wishlistItems) > 0): ?>
                                    <?php foreach($wishlistItems as $item): ?>
                                    <tr class="wishlist-item-row" data-wishlist-id="<?php echo $item['wishlist_id']; ?>">
                                        <td class="px-40 py-32 border-end border-neutral-100">
                                            <button type="button" class="remove-tr-btn flex-align gap-12 hover-text-danger-600 remove-wishlist-item" data-wishlist-id="<?php echo $item['wishlist_id']; ?>">
                                                <i class="ph ph-x-circle text-2xl d-flex"></i>
                                                Remove
                                            </button>
                                        </td>
                                        <td class="px-40 py-32 border-end border-neutral-100">
                                            <div class="table-product d-flex align-items-center gap-24">
                                                <a href="product-details-two.php?id=<?php echo $item['product_id']; ?>" class="table-product__thumb border border-gray-100 rounded-8 flex-center ">
                                                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                                                </a>
                                                <div class="table-product__content text-start">
        
                                                    <h6 class="title text-lg fw-semibold mb-8">
                                                        <a href="product-details.php?id=<?php echo $item['product_id']; ?>" class="link text-line-2" tabindex="0"><?php echo htmlspecialchars($item['title']); ?></a>
                                                    </h6>
        
                                                    <div class="flex-align gap-16 mb-16">
                                                        <div class="flex-align gap-6">
                                                            <span class="text-md fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                            <span class="text-md fw-semibold text-gray-900"><?php echo $item['rating']; ?></span>
                                                        </div>
                                                        <span class="text-sm fw-medium text-gray-200">|</span>
                                                        <span class="text-neutral-600 text-sm"><?php echo $item['reviews']; ?> Reviews</span>
                                                    </div>
        
                                                    <div class="flex-align gap-16">
                                                        <a href="product-details-two.php?id=<?php echo $item['product_id']; ?>" class="product-card__cart btn bg-gray-50 text-heading text-sm hover-bg-main-600 hover-text-white py-7 px-8 rounded-8 flex-center gap-8 fw-medium">
                                                            View Details
                                                        </a>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-40 py-32 border-end border-neutral-100">
                                            <span class="text-lg h6 mb-0 fw-semibold">$<?php echo $item['price']; ?></span>
                                        </td>
                                        <td class="px-40 py-32 border-end border-neutral-100">
                                            <span class="text-lg h6 mb-0 fw-semibold"><?php echo $item['stock_status']; ?></span>
                                        </td>
                                        <td class="px-40 py-32">
                                            <a href="cart.php?add_product=<?php echo $item['product_id']; ?>" class="btn btn-main-two rounded-8 px-64">
                                                Add To Cart <i class="ph ph-shopping-cart"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="px-40 py-32 text-center">
                                            <p class="text-lg text-gray-500">Your wishlist is empty.</p>
                                            <a href="shop.php" class="btn btn-main-two rounded-8 px-64 mt-16">
                                                Continue Shopping
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>
<!-- ================================ Cart Section End ================================ -->