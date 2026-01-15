<?php
// Example data for counters
$counters = [
    [
        'number' => '185+',
        'description' => 'Store around the world',
    ],
    [
        'number' => '152K',
        'description' => 'Product Sold',
    ],
    [
        'number' => '15K+',
        'description' => 'Registered Users',
    ],
    [
        'number' => '2K+',
        'description' => 'Top Brands Available in store',
    ]
];
?>
<!-- ========================== Counter Section Start ========================== -->
<section class="counter">
    <div class="container container-lg">
        <div class="row justify-content-center">
            <div class="col-xxl-11">
                <div class="bg-neutral-600 rounded-16 px-xxl-5 px-xl-4">
                    <div class="row gy-lg-0 gy-4 line-wrapper">
                        <?php foreach ($counters as $counter): ?>
                            <div class="col-lg-3 col-sm-6 col-xs-6">
                                <div class="counter-item text-center py-100 px-8">
                                    <h3 class="text-main-600 counter mb-8 fw-semibold"><?php echo $counter['number']; ?></h3>
                                    <p class="text-white text-xl font-heading-two fw-semibold"><?php echo $counter['description']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================== Counter Section End ========================== -->