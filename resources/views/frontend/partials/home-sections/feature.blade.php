@php
// Get featured categories from database
$featuredCategories = \App\Category::where('featured', 1)
    ->where('published', 1)
    ->orderBy('order_level', 'asc')
    ->limit(12)
    ->get();

$categories = [];
$duration = 400;
foreach ($featuredCategories as $category) {
    $categories[] = [
        'id' => $category->id,
        'title' => $category->name,
        'slug' => $category->slug,
        'image' => $category->icon ?: 'feature-img1.png',
        'duration' => $duration
    ];
    $duration += 200;
}

// Fallback to dummy data if no featured categories
if (empty($categories)) {
    $categories = [
        ['id' => 0, 'title' => 'Vegetables', 'slug' => 'vegetables', 'image' => 'feature-img1.png', 'duration' => 400],
        ['id' => 0, 'title' => 'Fish & Meats', 'slug' => 'fish-meats', 'image' => 'feature-img2.png', 'duration' => 600],
        ['id' => 0, 'title' => 'Desserts', 'slug' => 'desserts', 'image' => 'feature-img3.png', 'duration' => 800],
        ['id' => 0, 'title' => 'Drinks & Juice', 'slug' => 'drinks-juice', 'image' => 'feature-img4.png', 'duration' => 1000],
        ['id' => 0, 'title' => 'Animals Food', 'slug' => 'animals-food', 'image' => 'feature-img5.png', 'duration' => 1200],
        ['id' => 0, 'title' => 'Fresh Fruits', 'slug' => 'fresh-fruits', 'image' => 'feature-img6.png', 'duration' => 1400],
        ['id' => 0, 'title' => 'Yummy Candy', 'slug' => 'yummy-candy', 'image' => 'feature-img7.png', 'duration' => 1600],
        ['id' => 0, 'title' => 'Dairy & Eggs', 'slug' => 'dairy-eggs', 'image' => 'feature-img8.png', 'duration' => 1800],
    ];
}
@endphp
<!-- ============================ Feature Section start =============================== -->
<div class="feature" id="featureSection">
    <div class="container container-lg">
        <div class="position-relative arrow-center gradient-shadow">
            <div class="flex-align">
                <button type="button" id="feature-item-wrapper-prev" class="slick-prev slick-arrow flex-center rounded-circle bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-left"></i>
                </button>
                <button type="button" id="feature-item-wrapper-next" class="slick-next slick-arrow flex-center rounded-circle bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-right"></i>
                </button>
            </div>
            <div class="feature-item-wrapper">
                @foreach($categories as $category)
                    <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="{{ $category['duration'] }}">
                        <div class="feature-item__thumb rounded-circle">
                            <a href="{{ $category['id'] > 0 ? route('products.listing', ['category' => $category['slug']]) : route('products.listing') }}" class="w-100 h-100 flex-center">
                                @if($category['id'] > 0 && strpos($category['image'], 'http') === false && strpos($category['image'], '/') === false)
                                    <img src="{{ uploaded_asset($category['image']) ?: static_asset('frontend/img/thumbs/' . $category['image']) }}" alt="{{ $category['title'] }}">
                                @else
                                    <img src="{{ static_asset('frontend/img/thumbs/' . $category['image']) }}" alt="{{ $category['title'] }}">
                                @endif
                            </a>
                        </div>
                        <div class="feature-item__content mt-16">
                            <h6 class="text-lg mb-8">
                                <a href="{{ $category['id'] > 0 ? route('products.listing', ['category' => $category['slug']]) : route('products.listing') }}" class="text-inherit">{{ $category['title'] }}</a>
                            </h6>
                            @php
                                $productCount = $category['id'] > 0 ? \App\Product::where('category_id', $category['id'])->where('published', 1)->count() : 125;
                            @endphp
                            <span class="text-sm text-gray-400">{{ $productCount }}+ Products</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- ============================ Feature Section End =============================== -->

