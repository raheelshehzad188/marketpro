<?php
require_once 'config/database.php';
require_once 'config/functions.php';

$conn = getDBConnection();

// Get brand slug from URL
$brandSlug = $_GET['slug'] ?? '';

if (empty($brandSlug)) {
    header('Location: shop.php');
    exit;
}

// Get products by brand
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$result = getProductsByBrand($conn, $brandSlug, $page, 20);

$brand = $result['brand'];
$products = $result['products'];
$totalProducts = $result['total'];

if (!$brand) {
    header('HTTP/1.0 404 Not Found');
    include '404.php';
    exit;
}

// Get all categories for sidebar
$allCategories = getAllCategories($conn);
$allBrands = getAllBrands($conn);

$conn->close();

// ==================
// Page Variables
// ==================
$htmlClass = 'color-two font-exo header-style-two'; 
$categoryStable = 'd-none';
$categoryHover = 'd-block';
$breadcrumbClass = 'bg-main-two-50';
$pageTitle = $brand['name'] ?? "Brand";
$pageText = $brand['name'] ?? "Brand";
$itemClass = 'bg-main-50';
$iconClass = 'bg-main-600';
$section_margin = 'mb-24';

// Include Partials
include 'partials/_template-top.php';
include 'partials/_header-middle-two.php';
include 'partials/_header-two.php';
include 'partials/_breadcrumb-two.php';
include 'partials/_shop.php';
include 'partials/_shipping.php';
include 'partials/_footer-two.php';
include 'partials/_template-bottom.php';
?>

</body>
</html>
