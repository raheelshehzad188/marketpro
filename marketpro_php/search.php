<?php
require_once 'config/database.php';
require_once 'config/functions.php';

$conn = getDBConnection();

// Get search term from URL
$searchTerm = $_GET['q'] ?? $_GET['search'] ?? '';

if (empty($searchTerm)) {
    header('Location: shop.php');
    exit;
}

// Search products
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$result = searchProducts($conn, $searchTerm, $page, 20);

$products = $result['products'];
$totalProducts = $result['total'];

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
$pageTitle = "Search Results: " . htmlspecialchars($searchTerm);
$pageText = "Search: " . htmlspecialchars($searchTerm);
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
