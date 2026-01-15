<!-- ========================= Recommended Start ================================ -->
<section class="recommended overflow-hidden pt-80">
    <div class="container container-lg">
        <div class="section-heading flex-between flex-wrap gap-16">
            <h5 class="mb-0 wow fadeInLeft">Recommended for you</h5>
            <ul class="nav common-tab nav-pills wow fadeInRight" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link fw-medium text-sm border border-white hover-border-main-600 active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fw-medium text-sm border border-white hover-border-main-600" id="pills-grocery-tab" data-bs-toggle="pill" data-bs-target="#pills-grocery" type="button" role="tab" aria-controls="pills-grocery" aria-selected="false">Grocery</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fw-medium text-sm border border-white hover-border-main-600" id="pills-fruits-tab" data-bs-toggle="pill" data-bs-target="#pills-fruits" type="button" role="tab" aria-controls="pills-fruits" aria-selected="false">Fruits</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fw-medium text-sm border border-white hover-border-main-600" id="pills-juices-tab" data-bs-toggle="pill" data-bs-target="#pills-juices" type="button" role="tab" aria-controls="pills-juices" aria-selected="false">Juices</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fw-medium text-sm border border-white hover-border-main-600" id="pills-vegetables-tab" data-bs-toggle="pill" data-bs-target="#pills-vegetables" type="button" role="tab" aria-controls="pills-vegetables" aria-selected="false">Vegetables</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fw-medium text-sm border border-white hover-border-main-600" id="pills-snacks-tab" data-bs-toggle="pill" data-bs-target="#pills-snacks" type="button" role="tab" aria-controls="pills-snacks" aria-selected="false">Snacks</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fw-medium text-sm border border-white hover-border-main-600" id="pills-organic-tab" data-bs-toggle="pill" data-bs-target="#pills-organic" type="button" role="tab" aria-controls="pills-organic" aria-selected="false">Organic Foods</button>
                </li>
            </ul>
        </div>
        
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
                <?php include 'partials/_tabs-product.php'; ?>
            </div>
            <div class="tab-pane fade" id="pills-grocery" role="tabpanel" aria-labelledby="pills-grocery-tab" tabindex="0">
                 <?php include 'partials/_tabs-product.php'; ?>
            </div>
            <div class="tab-pane fade" id="pills-fruits" role="tabpanel" aria-labelledby="pills-fruits-tab" tabindex="0">
                 <?php include 'partials/_tabs-product.php'; ?>
            </div>
            <div class="tab-pane fade" id="pills-juices" role="tabpanel" aria-labelledby="pills-juices-tab" tabindex="0">
                 <?php include 'partials/_tabs-product.php'; ?>
            </div>
            <div class="tab-pane fade" id="pills-vegetables" role="tabpanel" aria-labelledby="pills-vegetables-tab" tabindex="0">
                 <?php include 'partials/_tabs-product.php'; ?>
            </div>
            <div class="tab-pane fade" id="pills-snacks" role="tabpanel" aria-labelledby="pills-snacks-tab" tabindex="0">
                 <?php include 'partials/_tabs-product.php'; ?>
            </div>
            <div class="tab-pane fade" id="pills-organic" role="tabpanel" aria-labelledby="pills-organic-tab" tabindex="0">
                 <?php include 'partials/_tabs-product.php'; ?>
            </div>
        </div>
    </div>
</section>
<!-- ========================= Recommended End ================================ -->
