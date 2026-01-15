<?php
$blogDetails = [
    'image' => '../assets/images/thumbs/blog-img1.png',
    'category' => 'Gadget',
    'title' => 'Nice decoration make be distilled to a single house',
    'content' => 'A great commerce experience cannot be distilled to a single number. Its not a Lighthouse score, or a set of Core Web Vitals figures, although both are important inputs. A great commerce experience is a trilemma that carefully balances competing needs of delivering great customer experience, dynamic storefront capabilities, and long-term business — conversion, retention, re-engagement — objectives. As developers, we rightfully obsess about the customer experience, relentlessly working to squeeze every millisecond out of the critical rendering path, optimize input latency, and eliminate jank. At the limit, statically generated, edge delivered, and HTML-first pages look like the optimal strategy. That is until you are confronted with the realization that the next step function in improving conversion rates and business.',
    'excerpt' => 'Re-engagement — objectives. As developers, we rightfully obsess about the customer experience, relentlessly working to squeeze every millisecond out of the critical rendering path, optimize input latency, and eliminate...',
    'date' => 'July 12, 2025',
    'comments_count' => '0',
    'gallery_images' => [
        '../assets/images/thumbs/blog-details-img1.png',
        '../assets/images/thumbs/blog-details-img2.png'
    ],
    'features' => [
        'A great commerce experience cannot be distilled to a single number.',
        'A great commerce experience cannot be distilled to a single number.',
        'A great commerce experience cannot be distilled to a single number.',
        'A great commerce experience cannot be distilled to a single number.',
        'A great commerce experience cannot be distilled to a single number.',
        'A great commerce experience cannot be distilled to a single number.'
    ],
    'quote' => 'A great commerce experience cannot be distilled to a single number. Its not a Lighthouse score, or a set of Core Web Vitals figures, although both are important inputs. A great commerce experience is a trilemma that carefully balances competing needs of delivering great customer experience, dynamic storefront capabilities, and long-term business.',
    'tags' => ['Mobile', 'Laptop', 'Gadget'],
    'navigation' => [
        'previous' => 'A great commerce experience cannot be distilled to a single number.',
        'next' => 'A great commerce experience cannot be distilled to a single number.'
    ]
];

$comments = [
    [
        'image' => '../assets/images/thumbs/comment-img1.png',
        'name' => 'Marvin McKinney',
        'date' => '26 Apr, 2024',
        'content' => 'In a nisi commodo, porttitor ligula consequat, tincidunt dui. Nulla volutpat, metus eu aliquam malesuada, elit libero venenatis urna, consequat maximus arcu diam non diam.'
    ],
    [
        'image' => '../assets/images/thumbs/comment-img2.png',
        'name' => 'Kristin Watson',
        'date' => '24 Apr, 2024',
        'content' => 'Quisque eget tortor lobortis, facilisis metus eu, elementum est. Nunc sit amet erat quis ex convallis suscipit. Nam hendrerit, velit ut aliquam euismod, nibh tortor rutrum nisi, ac sodales nunc eros porta nisi. Sed scelerisque, est eget aliquam venenatis, est sem tempor eros.'
    ],
    [
        'image' => '../assets/images/thumbs/comment-img3.png',
        'name' => 'Jenny Wilson',
        'date' => '20 Apr, 2024',
        'content' => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.'
    ],
    [
        'image' => '../assets/images/thumbs/comment-img4.png',
        'name' => 'Robert Fox',
        'date' => '18 Apr, 2024',
        'content' => 'Pellentesque feugiat, nibh vel vehicula pretium, nibh nibh bibendum elit, a volutpat arcu dui nec orci. Aenean dui odio, ullamcorper quis turpis ac, volutpat imperdiet ex.'
    ],
    [
        'image' => '../assets/images/thumbs/comment-img5.png',
        'name' => 'Eleanor Pena',
        'date' => '7 Apr, 2024',
        'content' => 'Nulla molestie interdum ultricies.'
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
?>
<!-- =============================== Blog Details Section Start =========================== -->
<section class="blog-details py-80">
    <div class="container container-lg">
        <div class="row gy-5">
            <div class="col-lg-8 pe-xl-4">
                <div class="blog-item-wrapper">
                    <div class="blog-item"> 
                        <img src="<?php echo $blogDetails['image']; ?>" alt="" class="cover-img rounded-16">
                        <div class="blog-item__content mt-24">
                            <span class="bg-main-50 text-main-600 py-4 px-24 rounded-8 mb-16"><?php echo $blogDetails['category']; ?></span>
                            <h4 class="mb-24"><?php echo $blogDetails['title']; ?></h4>
                            <p class="text-gray-700 mb-24"><?php echo $blogDetails['content']; ?></p>
                            <p class="text-gray-700 pb-24 mb-24 border-bottom border-gray-100"><?php echo $blogDetails['excerpt']; ?></p>

                            <div class="flex-align flex-wrap gap-24">
                                <div class="flex-align flex-wrap gap-8">
                                    <span class="text-lg text-main-600"><i class="ph ph-calendar-dots"></i></span>
                                    <span class="text-sm text-gray-500">
                                        <a href="blog-details.php" class="text-gray-500 hover-text-main-600"><?php echo $blogDetails['date']; ?></a>
                                    </span>
                                </div>
                                <div class="flex-align flex-wrap gap-8">
                                    <span class="text-lg text-main-600"><i class="ph ph-chats-circle"></i></span>
                                    <span class="text-sm text-gray-500">
                                        <a href="blog-details.php" class="text-gray-500 hover-text-main-600"><?php echo $blogDetails['comments_count']; ?> Comments</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-48">
                    <div class="row gy-4">
                        <?php foreach($blogDetails['gallery_images'] as $image): ?>
                        <div class="col-sm-6 col-xs-6">
                            <img src="<?php echo $image; ?>" alt="" class="rounded-16">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mt-48">
                    <p class="text-gray-700 mb-24"><?php echo $blogDetails['content']; ?></p>
                </div>

                <div class="mt-48">
                    <h6 class="mb-32">The following are the four main market segments in which e-commerce is present. These are the following:</h6>
                    <div class="row gy-4">
                        <?php 
                        $features = array_chunk($blogDetails['features'], ceil(count($blogDetails['features']) / 2));
                        foreach($features as $column): 
                        ?>
                        <div class="col-sm-6">
                            <ul>
                                <?php foreach($column as $index => $feature): ?>
                                <li class="d-flex align-items-start gap-8 <?php echo $index === count($column) - 1 ? 'mb-0' : 'mb-20'; ?>">
                                    <span class="text-xl d-flex flex-shrink-0"><i class="ph ph-check"></i></span>
                                    <span class="text-gray-700 flex-grow-1"><?php echo $feature; ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mt-48">
                    <div class="rounded-16 bg-main-50 p-24">
                        <span class="w-48 h-48 bg-main-600 text-white flex-center rounded-circle mb-24 text-2xl"><i class="ph ph-quotes"></i></span>
                        <p class="text-gray-700 mb-24"><?php echo $blogDetails['quote']; ?></p>
                        <div class="flex-align gap-8">
                            <?php for($i = 0; $i < 5; $i++): ?>
                            <span class="text-15 fw-medium text-neutral-600 d-flex"><i class="ph-fill ph-star"></i></span>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <div class="mt-48">
                    <div class="flex-align gap-8">
                        <h6 class="mb-0">Tag:</h6>
                        <?php foreach($blogDetails['tags'] as $tag): ?>
                        <a href="shop.php" class="border border-gray-100 rounded-4 py-6 px-8 hover-bg-gray-100 text-gray-900"><?php echo $tag; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="my-48">
                    <span class="border-bottom border-gray-100 d-block"></span>
                </div>

                <div class="my-48 flex-between flex-sm-nowrap flex-wrap gap-24">
                    <div class="">
                        <button type="button" class="mb-20 h6 text-gray-500 text-lg fw-normal hover-text-main-600">Previous Post</button>
                        <h6 class="text-lg mb-0">
                            <a href="blog-details.php" class=""><?php echo $blogDetails['navigation']['previous']; ?></a>
                        </h6>
                    </div>
                    <div class="text-end">
                        <button type="button" class="mb-20 h6 text-gray-500 text-lg fw-normal hover-text-main-600">Next</button>
                        <h6 class="text-lg mb-0">
                            <a href="blog-details.php" class=""><?php echo $blogDetails['navigation']['next']; ?></a>
                        </h6>
                    </div>
                </div>

                <div class="my-48">
                    <span class="border-bottom border-gray-100 d-block"></span>
                </div>

                <div class="my-48">
                    <form action="#">
                        <h6 class="mb-24">Leave a Comment</h6>
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xs-6">
                                <label for="name" class="text-sm font-heading-two text-gray-900 fw-semibold mb-4">Full Name</label>
                                <input type="text" class="common-input px-16" id="name" placeholder="Full name">
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="email" class="text-sm font-heading-two text-gray-900 fw-semibold mb-4">Email Address</label>
                                <input type="email" class="common-input px-16" id="email" placeholder="Email address">
                            </div>
                            <div class="col-sm-12">
                                <label for="message" class="text-sm font-heading-two text-gray-900 fw-semibold mb-4">Message</label>
                                <textarea class="common-input px-16" id="message" placeholder="What's your thought about this blog..."></textarea>
                            </div>
                            <div class="col-sm-12 mt-32">
                                <button type="submit" class="btn btn-main py-18 px-32 rounded-8">Post Comment</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="my-48">
                    <form action="#">
                        <h6 class="mb-48">Comments</h6>
                        <?php foreach($comments as $index => $comment): ?>
                        <div class="d-flex align-items-start gap-16 <?php echo $index === count($comments) - 1 ? '' : 'mb-32 pb-32 border-bottom border-gray-100'; ?>">
                            <img src="<?php echo $comment['image']; ?>" alt="" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                            <div class="flex-grow-1">
                                <div class="flex-align gap-8">
                                    <h6 class="text-md fw-bold mb-0"><?php echo $comment['name']; ?></h6>
                                    <span class="w-6 h-6 bg-gray-500 rounded-circle"></span>
                                    <span class="text-sm fw-medium text-gray-700"><?php echo $comment['date']; ?></span>
                                </div>
                                <p class="mt-16 text-gray-700"><?php echo $comment['content']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="mt-48">
                            <button type="submit" class="btn btn-main py-13 flex-align gap-8">
                                Load More <i class="ph ph-spinner-gap text-2xl"></i> 
                            </button>
                        </div>
                    </form>
                </div>

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
                    <?php foreach($recentPosts as $index => $post): ?>
                    <div class="d-flex align-items-center flex-sm-nowrap flex-wrap gap-24 <?php echo $index === count($recentPosts) - 1 ? 'mb-0' : 'mb-16'; ?>">
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
                        <?php foreach($tags as $index => $tag): ?>
                        <li class="<?php echo $index === count($tags) - 1 ? 'mb-0' : 'mb-16'; ?>">
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
<!-- =============================== Blog Details Section End =========================== -->