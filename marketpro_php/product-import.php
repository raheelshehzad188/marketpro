<?php
// ==================
// Page Variables
// ==================
$htmlClass        = 'color-two font-exo header-style-two';
$categoryStable   = 'd-none';
$categoryHover    = 'd-block';
$breadcrumbClass  = 'bg-main-two-50';
$pageTitle        = 'Product Import';
$pageText         = 'Import Products';
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
?>

<!-- ================================ Product Import Section Start ================================ -->
<section class="product-import py-80">
    <div class="container container-lg">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="card border border-gray-100 rounded-8 p-40">
                    <h4 class="text-2xl fw-bold mb-24">Product Import</h4>
                    
                    <div class="alert alert-info mb-32" style="background-color: #e3f2fd; border: 1px solid #90caf9; padding: 16px; border-radius: 8px;">
                        <h6 class="fw-bold mb-16">Instructions:</h6>
                        <ol style="margin-left: 20px; line-height: 1.8;">
                            <li>Download the sample CSV file to understand the format</li>
                            <li>Fill in the CSV file with your product data</li>
                            <li>Required columns: <code>name</code>, <code>price</code>, <code>category</code>, <code>brand</code></li>
                            <li>Optional columns: <code>slug</code>, <code>image_url</code>, <code>description</code>, <code>tags</code>, <code>rating</code>, <code>reviews</code>, <code>status</code></li>
                            <li>Upload the CSV file using the form below</li>
                        </ol>
                    </div>

                    <div class="mb-32">
                        <a href="api/download-sample.php" class="btn btn-main-two" download>
                            <i class="ph ph-download"></i> Download Sample CSV
                        </a>
                    </div>

                    <form action="api/product_import.php" method="POST" enctype="multipart/form-data" id="importForm">
                        <div class="mb-24">
                            <label for="csv_file" class="text-lg fw-semibold mb-8 d-block">Select CSV File</label>
                            <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv" required>
                            <small class="text-gray-600 d-block mt-8">Only CSV files are supported</small>
                        </div>

                        <div class="mb-24">
                            <button type="submit" class="btn btn-main-two">
                                <i class="ph ph-upload"></i> Import Products
                            </button>
                        </div>

                        <div id="importResult" class="mt-24 d-none"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================================ Product Import Section End ================================ -->

<?php
include 'partials/_shipping.php';
include 'partials/_footer-two.php';
include 'partials/_template-bottom.php';
?>

<script>
document.getElementById('importForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const resultDiv = document.getElementById('importResult');
    resultDiv.classList.remove('d-none');
    resultDiv.innerHTML = '<div class="alert alert-info">Importing products, please wait...</div>';
    
    fetch('api/product_import.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            resultDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
            document.getElementById('importForm').reset();
        } else {
            resultDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    })
    .catch(error => {
        resultDiv.innerHTML = '<div class="alert alert-danger">Error: ' + error.message + '</div>';
    });
});
</script>

</body>
</html>
