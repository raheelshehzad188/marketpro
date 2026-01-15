<?php
$blogPosts = [
    [
        'image' => '../assets/images/thumbs/blog-img1.png',
        'category' => 'Gadget',
        'title' => 'Legal structure, can make profit buisness',
        'description' => 'Re-engagement — objectives. As developers, we rightfully obsess about the customer experience, relentlessly working to squeeze every millisecond out of the critical rendering path, optimize input latency, and eliminate...',
        'date' => 'July 12, 2025',
        'comments' => '0'
    ],
    [
        'image' => '../assets/images/thumbs/blog-img2.png',
        'category' => 'Gadget',
        'title' => 'Legal structure, can make profit buisness',
        'description' => 'Re-engagement — objectives. As developers, we rightfully obsess about the customer experience, relentlessly working to squeeze every millisecond out of the critical rendering path, optimize input latency, and eliminate...',
        'date' => 'July 12, 2025',
        'comments' => '0'
    ],
    [
        'image' => '../assets/images/thumbs/blog-img3.png',
        'category' => 'Gadget',
        'title' => 'Legal structure, can make profit buisness',
        'description' => 'Re-engagement — objectives. As developers, we rightfully obsess about the customer experience, relentlessly working to squeeze every millisecond out of the critical rendering path, optimize input latency, and eliminate...',
        'date' => 'July 12, 2025',
        'comments' => '0'
    ]
];

$recentPosts = [
    [
        'image' => '../assets/images/thumbs/recent-post1.png',
        'title' => 'Once determined you need to come up with a name',
        'date' => 'July 12, 2025'
    ],
    [
        'image' => '../assets/images/thumbs/recent-post2.png',
        'title' => 'Once determined you need to come up with a name',
        'date' => 'July 12, 2025'
    ],
    [
        'image' => '../assets/images/thumbs/recent-post3.png',
        'title' => 'Once determined you need to come up with a name',
        'date' => 'July 12, 2025'
    ],
    [
        'image' => '../assets/images/thumbs/recent-post4.png',
        'title' => 'Once determined you need to come up with a name',
        'date' => 'July 12, 2025'
    ]
];

$tags = [
    ['name' => 'Gaming', 'count' => '12'],
    ['name' => 'Smart Gadget', 'count' => '05'],
    ['name' => 'Software', 'count' => '29'],
    ['name' => 'Electronics', 'count' => '24'],
    ['name' => 'Laptop', 'count' => '08'],
    ['name' => 'Mobile & Accessories', 'count' => '16'],
    ['name' => 'Apliance', 'count' => '24']
];

$pagination = range(1, 7);
?>
<!-- =============================== Blog Section Start =========================== -->
<section class="blog py-80">
    <div class="container container-lg">
        <div class="row gy-5">
            <div class="col-lg-8 pe-xl-4">
                <div class="blog-item-wrapper">
                    <?php foreach($blogPosts as $post): ?>
                    <div class="blog-item"> 
                        <a href="blog-detials.php" class="w-100 h-100 rounded-16 overflow-hidden">
                            <img src="<?php echo $post['image']; ?>" alt="" class="cover-img">
                        </a>
                        <div class="blog-item__content mt-24">
                            <span class="bg-main-50 text-main-600 py-4 px-24 rounded-8 mb-16"><?php echo $post['category']; ?></span>
                            <h6 class="text-2xl mb-24">
                                <a href="blog-details.php" class=""><?php echo $post['title']; ?></a>
                            </h6>
                            <p class="text-gray-700 text-line-2"><?php echo $post['description']; ?></p>

                            <div class="flex-align flex-wrap gap-24 pt-24 mt-24 border-top border-gray-100">
                                <div class="flex-align flex-wrap gap-8">
                                    <span class="text-lg text-main-600"><i class="ph ph-calendar-dots"></i></span>
                                    <span class="text-sm text-gray-500">
                                        <a href="blog-details.php" class="text-gray-500 hover-text-main-600"><?php echo $post['date']; ?></a>
                                    </span>
                                </div>
                                <div class="flex-align flex-wrap gap-8">
                                    <span class="text-lg text-main-600"><i class="ph ph-chats-circle"></i></span>
                                    <span class="text-sm text-gray-500">
                                        <a href="blog-details.php" class="text-gray-500 hover-text-main-600"><?php echo $post['comments']; ?> Comments</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination Start -->
                <ul class="pagination flex-align flex-wrap gap-16">
                    <li class="page-item">
                        <a class="page-link h-64 w-64 flex-center text-xxl rounded-8 fw-medium text-neutral-600 border border-gray-100" href="#">
                            <i class="ph-bold ph-arrow-left"></i>
                        </a>
                    </li>
                    <?php foreach($pagination as $page): ?>
                    <li class="page-item <?php echo $page === 1 ? 'active' : ''; ?>">
                        <a class="page-link h-64 w-64 flex-center text-md rounded-8 fw-medium text-neutral-600 border border-gray-100" href="#"><?php echo str_pad($page, 2, '0', STR_PAD_LEFT); ?></a>
                    </li>
                    <?php endforeach; ?>
                    <li class="page-item">
                        <a class="page-link h-64 w-64 flex-center text-xxl rounded-8 fw-medium text-neutral-600 border border-gray-100" href="#">
                            <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- Pagination End -->

            </div>
            <div class="col-lg-4 ps-xl-4">
                <!-- Search Start -->
                <div class="blog-sidebar border border-gray-100 rounded-8 p-32 mb-40">
                    <h6 class="text-xl mb-32 pb-32 border-bottom border-gray-100">Search Here</h6>
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control common-input bg-color-three" placeholder="Searching...">
                            <button type="submit" class="btn btn-main text-2xl h-56 w-56 flex-center text-2xl input-group-text"><i class="ph ph-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <!-- Search End -->
                
                <!-- Recent Post Start -->
                <div class="blog-sidebar border border-gray-100 rounded-8 p-32 mb-40">
                    <h6 class="text-xl mb-32 pb-32 border-bottom border-gray-100">Recent Posts</h6>
                    <?php foreach($recentPosts as $post): ?>
                    <div class="d-flex align-items-center flex-sm-nowrap flex-wrap gap-24 <?php echo $post === end($recentPosts) ? 'mb-0' : 'mb-16'; ?>">
                        <a href="blog-details.php" class="w-100 h-100 rounded-4 overflow-hidden w-120 h-120 flex-shrink-0">
                            <img src="<?php echo $post['image']; ?>" alt="" class="cover-img">
                        </a>
                        <div class="flex-grow-1">
                            <h6 class="text-lg">
                                <a href="blog-details.php" class="text-line-3"><?php echo $post['title']; ?></a>
                            </h6>
                            <div class="flex-align flex-wrap gap-8">
                                <span class="text-lg text-main-600"><i class="ph ph-calendar-dots"></i></span>
                                <span class="text-sm text-gray-500">
                                    <a href="blog-details.php" class="text-gray-500 hover-text-main-600"><?php echo $post['date']; ?></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- Recent Post End -->

                <!-- Tags Start -->
                <div class="blog-sidebar border border-gray-100 rounded-8 p-32 mb-40">
                    <h6 class="text-xl mb-32 pb-32 border-bottom border-gray-100">Recent Posts</h6>
                    <ul>
                        <?php foreach($tags as $tag): ?>
                        <li class="<?php echo $tag === end($tags) ? 'mb-0' : 'mb-16'; ?>">
                            <a href="blog-details.php" class="flex-between gap-8 text-gray-700 border border-gray-100 rounded-4 p-4 ps-16 hover-border-main-600 hover-text-main-600">
                                <span><?php echo $tag['name']; ?> (<?php echo $tag['count']; ?>)</span>
                                <span class="w-40 h-40 flex-center rounded-4 bg-main-50 text-main-600"><i class="ph ph-arrow-right"></i></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- Tags End -->

            </div>
        </div>
    </div>
 </section>
<!-- =============================== Blog Section End =========================== -->