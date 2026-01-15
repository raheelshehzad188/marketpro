<?php
// Testimonials Data Array
$testimonials = [
    [
        'name' => 'ROBIUL HASAN',
        'position' => 'Business Owner',
        'rating' => 5,
        'description' => 'Customers expressed that shopping at Asiana Fashion was a "delightful experience," highlighting the vibrant colors and unique designs that made them feel special at events',
        'image' => '../assets/images/thumbs/testimonials-img1.png'
    ],
    [
        'name' => 'SAMIYA AKTER',
        'position' => 'Front End Developer',
        'rating' => 5,
        'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia',
        'image' => '../assets/images/thumbs/testimonials-img2.png'
    ],
    [
        'name' => 'JOHN DOE',
        'position' => 'Max Model',
        'rating' => 5,
        'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\'',
        'image' => '../assets/images/thumbs/testimonials-img3.png'
    ],
    [
        'name' => 'MICHEL SMITH',
        'position' => 'Former Model',
        'rating' => 5,
        'description' => 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.',
        'image' => '../assets/images/thumbs/testimonials-img4.png'
    ],
    [
        'name' => 'ALEX',
        'position' => 'Back End Developer',
        'rating' => 5,
        'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.',
        'image' => '../assets/images/thumbs/testimonials-img2.png'
    ]
];

$sectionInfo = [
    'description' => 'Share information about your brand with your customers.',
    'title' => 'Customers Feedback'
];
?>

<!-- ============================== Testimonial section start ======================= -->
<section class="testimonials py-120 bg-neutral-600 bg-img overflow-hidden" data-background-image="../assets/images/bg/pattern-two.png">
    <div class="container container-lg">
        <div class="row gy-4 align-items-center">
            <div class="col-xl-1">
                <div class="section-heading mb-0 d-flex flex-column align-items-center writing-mode wow fadeInLeft">
                    <p class="text-white"><?php echo $sectionInfo['description']; ?></p>
                    <h5 class="text-white mb-0 text-uppercase"><?php echo $sectionInfo['title']; ?></h5>
                </div>
            </div>
            <div class="col-xl-11">
                <div class="position-relative">
                    <div class="testimonials-slider mb-60">
                        <?php foreach($testimonials as $testimonial): ?>
                        <div class="testimonials-item">
                            <h6 class="text-white text-uppercase mb-8 fw-medium"><?php echo $testimonial['name']; ?></h6>
                            <span class="text-md text-white fw-normal"><?php echo $testimonial['position']; ?></span>
                            <div class="flex-align gap-8 mt-24">
                                <?php for($i = 0; $i < $testimonial['rating']; $i++): ?>
                                <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                <?php endfor; ?>
                            </div>
                            <p class="testimonials-item__desc text-white text-2xl fw-normal mt-40 max-w-990"><?php echo $testimonial['description']; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="testimonials-thumbs-slider">
                        <?php foreach($testimonials as $testimonial): ?>
                        <div class="testimonials-thumbs d-flex position-relative align-items-end justify-content-end">
                            <div class="testimonials-thumbs__img">
                                <img src="<?php echo $testimonial['image']; ?>" alt="" class="cover-img">
                            </div>
                            <div class="testimonials-thumbs__content position-absolute transition-2 bottom-0 start-50 translate-middle-x mb-16 text-center hidden opacity-0">  
                                <h6 class="text-white text-uppercase mb-8 fw-medium"><?php echo $testimonial['name']; ?></h6>
                                <span class="text-md text-white fw-normal"><?php echo $testimonial['position']; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-center gap-8 mt-48">
            <button type="button" id="testi-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 text-white transition-1">
                <i class="ph ph-caret-left"></i>
            </button>
            <button type="button" id="testi-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 text-white transition-1">
                <i class="ph ph-caret-right"></i>
            </button>
        </div>
    </div>
</section>
<!-- ============================== Testimonial section start ======================= -->