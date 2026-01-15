<?php
// ==================
// Include Database Config
// ==================
require_once 'config/database.php';

// ==================
// Page Variables
// ==================
$htmlClass        = 'color-two font-exo header-style-two';
$categoryStable   = 'd-none';
$categoryHover    = 'd-block';
$breadcrumbClass  = 'bg-main-two-50';
$pageTitle        = 'Cart';
$pageText         = 'Product Cart';
$section_margin   = 'mb-24';
$itemClass        = 'bg-main-50';
$iconClass        = 'bg-main-600';

// ==================
// Include Partials
// ==================
include 'partials/_template-top.php';
include 'partials/_header-middle-two.php';
include 'partials/_header-two.php';
include 'partials/_breadcrumb-two.php';
include 'partials/_cart.php';
include 'partials/_shipping.php';
include 'partials/_footer-two.php';
include 'partials/_template-bottom.php';
?>

</body>
</html>
